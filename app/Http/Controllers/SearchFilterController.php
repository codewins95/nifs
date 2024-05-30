<?php

namespace App\Http\Controllers;

use App\Traits\AiriqAuth;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use GuzzleHttp\Exception\RequestException;

class SearchFilterController extends Controller
{
    use AiriqAuth;

    public function  filter(Request $request)
    {


        $flightTrip = $request->flight_trip; //"flight_trip" => "O"


        if ($request->txtorigincity != '') {
            $origincity = filterAirportCode($request->txtorigincity); //"txtorigincity" => "Guwahati-(GAU)"
        }
        if ($request->txtdestinationcity != '') {
            $destinationcity = filterAirportCode($request->txtdestinationcity); //"txtdestinationcity" => "Kolkata-(CCU)"
        }
        if ($request->hdn_departure != '') {
            $departure = changeDateYmdFormet($request->hdn_departure); // "hdn_departure" => "Sat, 11 May"
        }
        if ($request->hdn_arrivaldate != '') {
            $arrivaldate = changeDateYmdFormet($request->hdn_arrivaldate); // "hdn_arrivaldate" => "Sun, 19 May"
        }



        $adults = $request->adults; // "adults" => "1"
        $child = $request->child; // "child" => "0"
        $infant = $request->infant; // "infant" => "0"
        $flight_class = $request->flight_class; // "flight_class" => "E" E- Economy, P- Premium Economy, B- Business and F- First

        if ($request->Faredivide != '') {
            $faredivide = $request->Faredivide;  // "Faredivide" => "StudentFare"
        }

        $token = $this->token();

        

        $client = new Client();

        try {
            $response = $client->post('http://testairiq.mywebcheck.in/TravelAPI.svc/Availability', [
                'json' => [
                    "TripType" => $flightTrip, //Trip Type shows the type of booking. It may be an O-Oneway or R-Roundtrip.
                    "AirlineID" => "",
                    "AgentInfo" => [
                        "AgentId" => env('AiriqAgentID'),
                        "UserName" => env('AiriqUserName'),
                        "AppType" => "API",
                        "Version" => "V1.0"
                    ],
                    "AvailInfo" => [
                        [
                            "DepartureStation" => $origincity,
                            "ArrivalStation" => $destinationcity,
                            "FlightDate" => $departure,
                            "FarecabinOption" => $flight_class,
                            "FareType" => "N",
                            "OnlyDirectFlight" => false
                        ]
                    ],
                    "PassengersInfo" => [
                        "AdultCount" => $adults,
                        "ChildCount" => $child,
                        "InfantCount" => $infant
                    ]
                ],
                'headers' => [
                    'TOKEN' => $token,
                    'Content-Type' => 'application/json'
                ]
            ]);


            $responseBody = $response->getBody()->getContents();

            $responseData = json_decode($responseBody, true);

            $trackId = $responseData['Trackid'];
            $itineraryFlightList = $responseData['ItineraryFlightList'][0]['Items'];
 
            $data = [
                'BaseOrigin'        => $origincity,
                'BaseDestination'   => $destinationcity,
                'TripType'          => $flightTrip,
                'AdultCount'        => $adults,
                'ChildCount'        => $child,
                'InfantCount'       => $infant,
                'Trackid'           => $trackId
            ];
            return view('frontend.flight.flight-filter', $data, compact('itineraryFlightList'));
        } catch (RequestException $e) {
            return $e->getMessage();

            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $statusCode = $response->getStatusCode();
                $errorMessage = $response->getBody()->getContents();
                dd($errorMessage);
            } 
        }
        
    }


    public function pricing(Request $request)
    {
        
        if($request->AdultCount != 1){
               $base = $request->BaseAmount*$request->AdultCount; 
               $gross = $request->GrossAmount*$request->AdultCount;
        }else{
            $base =$request->BaseAmount; 
            $gross = $request->GrossAmount;
        }

        $details = [
            'BaseOrigin' => $request->BaseOrigin,
            'BaseDestination' => $request->BaseDestination,
            'TripType' => $request->TripType,
            'AdultCount' => $request->AdultCount,
            'ChildCount' => $request->ChildCount,
            'InfantCount' => $request->InfantCount,
            'Trackid' => $request->Trackid,
            'FlightID' => $request->FlightID,
            'FlightNumber' => $request->FlightNumber,
            'FlightOrigin' => $request->FlightOrigin,
            'FlightDestination' => $request->FlightDestination,
            'DepartureDateTime' => $request->DepartureDateTime,
            'ArrivalDateTime' => $request->ArrivalDateTime,
            
            'BaseAmount' => $base,
            'GrossAmount' => $gross
        ];



        $client = new Client();

        try {
            $response = $client->post('http://testairiq.mywebcheck.in/TravelAPI.svc/Pricing', [
                'headers' => [
                    'TOKEN' => $this->token(),
                    'Content-Type' => 'application/json'
                ],
                'json' => [
                    "AgentInfo" => [
                        "AgentId" => env('AiriqAgentID'),
                        "UserName" => env('AiriqUserName'),
                        "AppType" => "API",
                        "Version" => "V1.0"
                    ],
                    "SegmentInfo" => [
                        "BaseOrigin" => $details['BaseOrigin'],
                        "BaseDestination" => $details['BaseDestination'],
                        "TripType" => $details['TripType'],
                        "AdultCount" => $details['AdultCount'],
                        "ChildCount" => $details['ChildCount'],
                        "InfantCount" => $details['InfantCount']
                    ],
                    "Trackid" => $details['Trackid'],
                    "ItineraryInfo" => [
                        [
                            "FlightDetails" => [
                                [
                                    "FlightID" => $details['FlightID'],
                                    "FlightNumber" => $details['FlightNumber'],
                                    "Origin" => $details['FlightOrigin'],
                                    "Destination" => $details['FlightDestination'],
                                    "DepartureDateTime" => $details['DepartureDateTime'],
                                    "ArrivalDateTime" => $details['ArrivalDateTime']
                                ]
                            ],
                            "BaseAmount" => $details['BaseAmount'],
                            "GrossAmount" => $details['GrossAmount']
                        ]
                    ]
                ]
            ]);


            $responseBody = $response->getBody()->getContents();
            $responseData = json_decode($responseBody, true);

            //dd($responseData);
            $responseData = $responseData['PriceItenaryInfo'][0];

            return view('frontend.flight.booking',$details,compact('responseData'));

        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $responseBody = $e->getResponse()->getBody()->getContents();
                return $responseBody;
            } else {
                return $e->getMessage();
            }
        }
    }


    public function  flightBooking()
    {
        return view('frontend.flight.booking');
    }
}
