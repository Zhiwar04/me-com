<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $notification = array(
            'message' => 'Login Successfully',
            'alert-type' => 'success'
        );
        $request->session()->regenerate();
   $url ='';
        if(Auth::user()->role == 'admin'){
            $url = route('admin.dashboard');
        }else if(Auth::user()->role == 'vendor'){
            $url = route('vendor.dashboard');
        }elseif(Auth::user()->role == 'user'){
            $url = "/dashboard";
        }
        //wtwmana agar role naw table user yaksan bw ba admin route bkatawa bo page admin.dashboard
        // agarosh role yaksan bw ba vendor awa brwata vendor wa gar user bw brwata dashboard
        return redirect()->intended($url)->with($notification);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

}