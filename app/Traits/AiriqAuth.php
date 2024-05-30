<?php

namespace App\Traits;
use GuzzleHttp\Client;
use Brian2694\Toastr\Facades\Toastr;

trait AiriqAuth
{
    public static function authAir()
    {
        $client = new Client();

        try {
            $response = $client->post('http://testairiq.mywebcheck.in/TravelAPI.svc/Login', [
                'headers' => [
                    'Authorization' => env('AiriqAuthorization'),
                ],
            ]);

            $responseBody = (string) $response->getBody();
            $responseData = json_decode($responseBody, true);
            return $responseData;
        } catch (\GuzzleHttp\Exception\RequestException $e) {
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $statusCode = $response->getStatusCode();
                $errorMessage = $response->getBody()->getContents();
                Toastr::error($errorMessage, 'Oops');
                return redirect()->back();
            }
        }
    }
    public  static function token() {
        return 'bVFnTmVEKy1jNXdDSWRNZjMyVmFkU3pDZmFEdFE5aVI2cjhnQ0Rub3RtVGxuYUk4TE1HV3ZBUjNPbUlkZXEyL1Z6cHlGZHJCOEdqekxnTURmTlhCUy9MTHNQbk1aeHNyMGVEbnBJcHFXelhNRmo2cWNGS3lmL3EvZ0dPRjN4QTRsNnQ2WlFmNmhUTnJ0NVdrNlVRLzZDaVFldWZVeVZuUzhEYjdvcHBGbWhyQkVndHVHUjM5SDF1R1lxWElBU3ZDbHpjVjgzTjBqd2cvTmR4OXhUcTNoakErQUQwQVBRLQ==';
    }
    
}
 