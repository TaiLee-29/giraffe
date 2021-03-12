<?php


namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController
{
    public function login()
    {

      return view('login');
    }

    public function handleLogin(Request $request)
    {
        $credentials = $request->only('name', 'password');

        if (Auth::attempt($credentials)) {
            $user=Auth::user();
            $user->password = Hash::make($credentials['password']);
            $user->save();
            return redirect()->route('index');
        }
        if (User::where('name', '=', $request['name'])->get()->count() == 0 && $request['password'] != null) {

            $data = $request->validate([

                'name' => ['required', 'min:10', 'unique:users,name'],
                'password' => ['required', 'min:8'],


            ]);
            $user = new User;
            $user->name = $data['name'];
            $user->password = Hash::make($request['password']);
            $user->save();


            $credentials = $request->only('name', 'password');
            if (Auth::attempt($credentials)) {
                $request->session()->regenerate();
                return new RedirectResponse(route('index'));
            }
        }

        return back()->withErrors([
            'name' => 'The provided credentials do not match our records.',
        ]);

    }






    public function logout()
    {
       Auth::logout();


        return redirect()->route('index');
    }

}
