<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

/**
 *  session controller for Authenticated's
 * this class inherits from controller class 
 */
class AuthenticatedSessionController extends Controller
{
    /**
     * show the login view.
     *
     * @return \Illuminate\View\View view
     */
    public function create()
    {
        return view('auth.login');
    }

    /** 
     * this function is for handling and incoming authentication request.
     * 
     * @param  \App\Http\Requests\Auth\LoginRequest  $login request.
     * @return \Illuminate\Http\RedirectResponse response 
    */

     public function store(LoginRequest $request)
    {
        $request->authenticate();

        $request->session()->regenerate();

        return redirect()->intended(RouteServiceProvider::HOME);
    }

    /** 
     * this function is for destroying a session which is authenticated.
     * 
     * @param  \Illuminate\Http\Request  $request for the function
     * @return \Illuminate\Http\RedirectResponse response
    */

    public function destroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }
}
