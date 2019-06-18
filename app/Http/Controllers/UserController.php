<?php

namespace App\Http\Controllers;
//use App\Http\Controllers\HttpClient;
use GuzzleHttp\Client as HttpClient;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Connection;

class UserController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    //
    public function profile() {
        
        $user = Auth::user();
        $connection = Connection::where('user_id', $user->id)->first();
        $isConnected = $connection != null;
        $kdUser = null;
        $schools = [];
        
        if ($isConnected) {
            $kd = new KidDiary;
            $kdUser = $kd->getUserProfile($connection->access_token);
            $schools = [$kd->getSchools($connection->access_token)];
        }

        return view('profile',['user' => $user, 'isConnected' => $isConnected, 'kdUser' => $kdUser, 'schools' => $schools]);
    }

    public function ConnectKD(){
        $query = http_build_query([
            'client_id' => 12,
            'redirect_uri' => 'http://localhost/auth/callback',
            'response_type' => 'code',
            'scope' => ''
        ]);
        $url = 'http://kdtest-parents.ptitu.de/oauth/authorize?'.$query;
        return redirect($url);
        
    }

    function callback(Request $request) {

        $client = new HttpClient();
        $url = 'http://kdtest-parents.ptitu.de/oauth/token';
        $response = $client->post($url, [
          'form_params' => [
             'grant_type' => 'authorization_code',
             'client_id' => '12',
             'client_secret' => 'V10tSLWobRXcf5TN6SFxcUAUgLScqIcqlROoRBUF',
             'redirect_uri' => route('callback'),
             'code' => $request->input('code'),
           ]
        ]);
        $token = json_decode((string) $response->getBody(), true);
        //dd($token);

        $userId = Auth::user()->id;

        // Save to the database
        $connection = new Connection;
        $connection->user_id = $userId;
        $connection->access_token = $token['access_token'];
        $connection->refresh_token = $token['refresh_token'];
        $connection->expires = $token['expires_in'];
        $connection->save();
    
        // Redirect to profile page
        return redirect(route('profile'));
    
     }

}
