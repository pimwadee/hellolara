<?php

namespace App;

use GuzzleHttp\Client as HttpClient;

class KidDiary {

    protected $baseUrl;
    protected $clientId;
    protected $clientSecret;

    function __construct() {
        $this->baseUrl = env('KIDDIARY_URL');
        $this->clientId = env('KIDDIARY_CLIENT_ID');
        $this->clientSecret = env('KIDDIARY_CLIENT_SECRET');
    }

    public function redirectAuthorize() {
        $query = http_build_query([
            'client_id' => $this->clientId,
            'redirect_uri' => route('callback'),
            'response_type' => 'code',
            'scope' => ''
        ]);

        return redirect($this->baseUrl.'/oauth/authorize?'.$query);
    }

    public function exchangeAccessToken($authCode) {
        try {
            $client = new HttpClient();
            $response = $client->post($this->baseUrl.'/oauth/token', [
                'form_params' => [
                    'grant_type' => 'authorization_code',
                    'client_id' => $this->clientId,
                    'client_secret' => $this->clientSecret,
                    'redirect_uri' => route('callback'),
                    'code' => $authCode,
                ]
            ]);
        }
        catch (\Exception $exception) {
            print_r($exception);
            return null;
        }
        return self::parseJson($response);
    }

    public function getUserProfile($accessToken) {
        $url = $this->baseUrl.'/api/v1/user';
        try {
            $client = new HttpClient();
            $response = $client->get($url, [
                'headers' => [
                    'Authorization' => "Bearer $accessToken"
                ]
            ]);
        }
        catch (\Exception $exception) {
            print_r($exception);
            return null;
        }
        return self::parseJson($response);
    }

    public function getSchools($accessToken) {
        $url = $this->baseUrl.'/api/v1/school';
        try {
            $client = new HttpClient();
            $response = $client->get($url, [
                'headers' => [
                    'Authorization' => "Bearer $accessToken"
                ]
            ]);
        }
        catch (\Exception $exception) {
            print_r($exception);
            return null;
        }
        return self::parseJson($response);
    }

    private function parseJson($response) {
        return json_decode((string) $response->getBody(), true);
    }
}