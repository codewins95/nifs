@extends('layouts.master')
@section('title', 'Flight-filter')
@section('content')


    <!-- Breadcrumbs S t a r t -->
    <section class="breadcrumbs-area breadcrumb-bg">
        <div class="container">
            <h1 class="title wow fadeInUp" data-wow-delay="0.0s">Booking</h1>
            <div class="breadcrumb-text">
                <nav aria-label="breadcrumb" class="breadcrumb-nav wow fadeInUp" data-wow-delay="0.1s">
                    <ul class="breadcrumb listing">
                        <li class="breadcrumb-item single-list"><a href="" class="single">Home</a></li>
                        <li class="breadcrumb-item single-list" aria-current="page">
                            <a href="javascript:void(0)" class="single active">Booking</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </section>
    <!--/ End-of Breadcrumbs-->
    <section class="tour-list-section section-padding2">
        <div class="container">
            <div class="row ten-columns mobile">
                <div class="col-sm-2">Airline</div>
                <div class="col-sm-2">Departure</div>
                <div class="col-sm-2">Departure</div>
                <div class="col-sm-2">Arrival</div>
                <div class="col-sm-2">Price</div>
            </div>
        </div>

        <form action="{{ route('flight.pricing') }}" method="POST" id="flightSubmit">
            @csrf
            <input type="hidden" name="BaseOrigin" value="{{ $BaseOrigin }}">
            <input type="hidden" name="BaseDestination" value="{{ $BaseDestination }}">
            <input type="hidden" name="TripType" value="{{ $TripType }}">
            <input type="hidden" name="AdultCount" value="{{ $AdultCount }}">
            <input type="hidden" name="ChildCount" value="{{ $ChildCount }}">
            <input type="hidden" name="InfantCount" value="{{ $InfantCount }}">
            <input type="hidden" name="Trackid" value="{{ $Trackid }}">

            <input type="hidden" name="FlightID" id="FlightID">
            <input type="hidden" name="FlightNumber" id="FlightNumber">
            <input type="hidden" name="FlightOrigin" id="FlightOrigin">
            <input type="hidden" name="FlightDestination" id="FlightDestination">
            <input type="hidden" name="DepartureDateTime" id="DepartureDateTime">
            <input type="hidden" name="ArrivalDateTime" id="ArrivalDateTime">
            <input type="hidden" name="BaseAmount" id="BaseAmount">
            <input type="hidden" name="GrossAmount" id="GrossAmount">

        </form>
        <div class="container mt-4">
            @isset($itineraryFlightList)
                @foreach ($itineraryFlightList as $key => $row)
                    <div class="row ten-columns bg-white mobile mt-2">
                        <div class="col-sm-2">
                            <img src="{{ findFlag(@$row['FlightDetails'][0]['FlightNumber']) }}" width="25%">
                            <p class="p-3">{{ @$row['FlightDetails'][0]['FlightNumber'] }}</p>

                        </div>
                        <div class="col-sm-2">
                            <div class="timimg">
                                <div class="">
                                    <p><b>{{ @$row['FlightDetails'][0]['Origin'] }}
                                            (T{{ $row['FlightDetails'][0]['DepartureTerminal'] }})
                                        </b></p>
                                </div>
                                {{-- <div class="">18:35</div> --}}
                                <div class="">
                                    <p><b>{{ @$row['FlightDetails'][0]['DepartureDateTime'] }}</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="timimg">
                                <div class="">
                                    <p><b>{{ @$row['FlightDetails'][0]['Stops'] == 0 ? 'Non stop' : $row['FlightDetails'][0]['Stops'] . ' - Change' }}
                                        </b></p>
                                </div>
                                <div class="">
                                    <hr class="arrow">
                                </div>
                                <div class="">{{ convertToHoursAndMinutes(@$row['FlightDetails'][0]['JourneyTime']) }}
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="timimg">
                                <div class="">
                                    <p><b>{{ @$row['FlightDetails'][0]['Destination'] }}
                                            (T{{ @$row['FlightDetails'][0]['ArrivalTerminal'] }})</b></p>
                                </div>
                                {{-- <div class="">19:45</div> --}}
                                <div class="">
                                    <p><b>{{ @$row['FlightDetails'][0]['ArrivalDateTime'] }}</b></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-2">
                            <div class="timimg">
                                {{-- <input type="radio" name="3427" value="3427"> --}}
                                {{ $row['Fares'][0]['Currency'] }}
                                {{ $row['Fares'][0]['Faredescription'][0]['GrossAmount'] }}
                                <sup class="sub">
                                    @if (@$row['Fares'][0]['FareType'] == 'N')
                                        Normal
                                    @elseif (@$row['Fares'][0]['FareType'] == 'C')
                                        Corporate
                                    @elseif (@$row['Fares'][0]['FareType'] == 'R')
                                        Retail Fare
                                    @endif
                                </sup>
                                <br>
                                AvailSeat: {{ @$row['FlightDetails'][0]['AvailSeat'] }}
                                {{-- <br>
                            <input type="radio" name="3427" value="3427"> ₹ 3500 <sup class="sub">Special</sup>
                            <br>
                            <input type="radio" name="3427" value="3427"> ₹ 4500 <sup class="sub">Flexi</sup> --}}
                            </div>
                            <div class="section-button mt-27 d-inline-block">
                                <input type="hidden" id="getFlightID{{ $key }}"
                                    value="{{ @$row['FlightDetails'][0]['FlightID'] }}">
                                <input type="hidden" id="getFlightNumber{{ $key }}"
                                    value="{{ @$row['FlightDetails'][0]['FlightNumber'] }}">
                                <input type="hidden" id="getFlightOrigin{{ $key }}"
                                    value="{{ @$row['FlightDetails'][0]['Origin'] }}">
                                <input type="hidden" id="getFlightDestination{{ $key }}"
                                    value="{{ @$row['FlightDetails'][0]['Destination'] }}">
                                <input type="hidden" id="getDepartureDateTime{{ $key }}"
                                    value="{{ @$row['FlightDetails'][0]['DepartureDateTime'] }}">
                                <input type="hidden" id="getArrivalDateTime{{ $key }}"
                                    value="{{ @$row['FlightDetails'][0]['ArrivalDateTime'] }}">
                                <input type="hidden" id="getBaseAmount{{ $key }}"
                                    value="{{ $row['Fares'][0]['Faredescription'][0]['BaseAmount'] }}">
                                <input type="hidden" id="getGrossAmount{{ $key }}"
                                    value="{{ $row['Fares'][0]['Faredescription'][0]['GrossAmount'] }}">

                                <a href="javascript:void(0);" onclick="bookFlight({{ $key }})"
                                    class="btn-primary-icon-sm radius-20">
                                    <p class="pera mt-0">Book Now</p>
                                    <i class="ri-arrow-right-up-line"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endisset
        </div>
    </section>


    @push('custom_css')
        <style>
            li.air-list {
                width: 20%;
                float: left;
            }

            .flgt-sort {
                width: 100%;
                margin-bottom: 0px;
                margin-top: 2px;
                padding: 8px 15px;
                border-radius: 5px;
                background: #fff;
                box-shadow: 0 3px 13px rgb(39 79 117 / 10%);
                display: inline-block;
                font-size: 13px;
                color: #333;
                font-weight: 400;
            }

            .ten-columns {
                border-radius: 5px;
                box-shadow: 0 3px 13px rgb(39 79 117 / 10%);
            }

            @media (min-width: 768px) {
                .ten-columns>.col-sm-2 {
                    width: 20%;
                }

            }

            @media (min-width: 320px) {

                .mobile {
                    text-align: center;
                }

                .col-sm-2 {
                    font-size: 15px;
                    padding: 5px;
                }

                .arrow {
                    margin: 10px 90px;
                }
            }

            /* Decorations */
            .col-sm-2 {
                background: #fff;
                color: #000;
                font-size: 18px;
                font-weight: bold;
                padding: 10px;

            }

            .col-sm-2:nth-of-type(even) {
                background: #fff;
            }

            .timimg {
                margin-top: 5px;
            }

            .arrow {
                border-bottom: 3px solid #000;
                color: #000;

                margin: 10px 70px;
                padding: 0px;
                background-color: #2c323f !important;
            }

            .sub {
                border-radius: 4px;
                font-size: 10px;
                padding: 2px;
                background-color: #f7caca;
            }
        </style>
    @endpush

    @push('custom_js')
        <script>
            function bookFlight(id) {
                $('#FlightID').val($('#getFlightID' + id).val());
                $('#FlightNumber').val($('#getFlightNumber' + id).val());
                $('#FlightOrigin').val($('#getFlightOrigin' + id).val());
                $('#FlightDestination').val($('#getFlightDestination' + id).val());
                $('#DepartureDateTime').val($('#getDepartureDateTime' + id).val());
                $('#ArrivalDateTime').val($('#getArrivalDateTime' + id).val());
                $('#BaseAmount').val($('#getBaseAmount' + id).val());
                $('#GrossAmount').val($('#getGrossAmount' + id).val());
                $('#flightSubmit').submit();
            }
        </script>
    @endpush
@endsection
