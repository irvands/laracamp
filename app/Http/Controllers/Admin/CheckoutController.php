<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Checkout;
use Mail;
use App\Mail\Checkout\Paid;
// use Auth;

class CheckoutController extends Controller
{
    public function setToPaid(Request $request, Checkout $checkout){

        $checkout->is_paid = true;
        $checkout->save();

        $request->session()->flash('success', "Checkout with ID {$checkout->id} has been updated");

        Mail::to($checkout->User->email)->send(new Paid($checkout));

        return redirect(route('admin.dashboard'));
    }
}
