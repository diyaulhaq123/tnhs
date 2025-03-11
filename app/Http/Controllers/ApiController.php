<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    

    public function login(Request $request)
    {
        $client = new Client();
        $response = $client->post('https://school.test/api/login', [
            'form_params' => [
                'email' => $request->email,
                'password' => $request->password,
            ],
        ]);

        $body = json_decode($response->getBody(), true);

        // Return the token or handle errors if the response doesn't include it
        if (isset($body['token'])) {
            return $body['token'];
        } else {
            return response()->json(['error' => 'Failed to get token'], 401);
        }
    }


    // public function updateClass($school_id, Request $request)
    // {
    //     // Call the login method to get the token
    //     $apiToken = $this->login($request);

    //     // Check if token is successfully retrieved
    //     if (is_array($apiToken) && isset($apiToken['error'])) {
    //         return response()->json($apiToken);
    //     }

    //     $client = new Client();
    //     try {
    //         $response = $client->put("https://school.test/api/class/{$school_id}", [
    //             'headers' => [
    //                 'Authorization' => 'Bearer ' . $apiToken,
    //             ],
    //             'form_params' => $request->all(), // Send data received from the request
    //         ]);

    //         return json_decode($response->getBody(), true);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }

    // public function updateClassWithLogin(Request $request, $class_id)
    // {
    //     $client = new Client();
        
    //     // Authenticate and get token
    //     $response = $client->post('https://school.test/api/login', [
    //         'form_params' => [
    //             'email' => $request->email,
    //             'password' => $request->password,
    //         ],
    //     ]);

    //     $body = json_decode($response->getBody(), true);

    //     if (!isset($body['token'])) {
    //         return response()->json(['error' => 'Failed to authenticate and get token'], 401);
    //     }

    //     $apiToken = $body['token'];

    //     // Update class with the token
    //     try {
    //         $response = $client->put("https://school.test/api/class/{$class_id}", [
    //             'headers' => [
    //                 'Authorization' => 'Bearer ' . $apiToken,
    //             ],
    //             'form_params' => $request->all(), // Data to update
    //         ]);

    //         return json_decode($response->getBody(), true);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }


}
