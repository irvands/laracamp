<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkout;
use Auth;


class DashboardController extends Controller
{
    public function index(){
        //cara pertama
        $checkouts = Checkout::with('Camp')->get();
        
        //cara kedua
        // $checkouts = Checkout::with('Camp')->whereUserId(Auth::id())->get();

        // return $checkouts;
        return view('admin.dashboard',[
            'checkouts' => $checkouts
        ]);
    }
}
