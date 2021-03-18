<?php


namespace App\Http\Controllers\OAuth;


use App\Models\User;
use Faker\Factory;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;

class YahooController
{

    public function __invoke(){

        $link = "https://api.login.yahoo.com/oauth2/get_token";

        $parametrsYahoo=[
            'client_id'    => env('OAUTH_YAHOO_CLIENT_ID'),
            'client_secret'=>  env('OAUTH_YAHOO_CLIENT_SECRET'),
            'redirect_uri' => env('OAUTH_YAHOO_REDIRECT_URI'),
            'code'         => request()->get('code'),
            'grant_type'   => 'authorization_code',
        ] ;


        $response = Http::withHeaders(['Authorization' => 'Basic ' . base64_encode(env('OAUTH_YAHOO_CLIENT_ID') . ':' . env('OAUTH_YAHOO_CLIENT_SECRET')), 'Content-Type' => 'application/x-www-form-urlencoded'])->
        asForm()->post($link, [

            'grant_type' => 'authorization_code',
            'client_id' => env('OAUTH_YAHOO_CLIENT_ID'),
            'client_secret' => env('OAUTH_YAHOO_CLIENT_SECRET'),
            'code' => request()->get('code'),
            'redirect_uri' => env('OAUTH_YAHOO_REDIRECT_URI'),


        ]);

        $data = $response->json();
        $response = Http::withHeaders(['Authorization' => 'Bearer ' . $data['access_token']])->get('https://api.login.yahoo.com/openid/v1/userinfo');
        $userInfo = $response->json();


        if (($user = User::where('email', $userInfo['email'])->first()) === NULL) {

            $faker = Factory::create();

            $data = [
                'name' => $userInfo['name'],
                'email' => $userInfo['email'],
                'password' => Hash::make($faker->password)
            ];
            $user = User::create($data);


        }

        Auth::login($user);
        return redirect()->route('index');
    }

}
