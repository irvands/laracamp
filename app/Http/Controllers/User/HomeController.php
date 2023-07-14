<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkout;
use Auth;

class HomeController extends Controller
{
    public function dashboard(){

        //cara pertama
        $checkouts = Checkout::with('Camp')->where('user_id', Auth::id())->get();
       
        //cara kedua
        // $checkouts = Checkout::with('Camp')->whereUserId(Auth::id())->get();

        // return $checkouts;


        return view('user.dashboard',[
            'checkouts' => $checkouts
        ]);
    }
}
