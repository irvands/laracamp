<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Models\Camp;

class CheckoutController extends Controller
{
    
    public function index()
    {
        return view ('checkout');
    }

    
    public function create(Camp $camp)
    {
    //    return $camp;
        return view ('checkout',[
            'camp'  => $camp
        ]);
    }

    
    public function store(Request $request, Camp $camp)
    {
        return $camp;
        return $request->all();
    }

    public function show(Checkout $checkout)
    {
        
    }

    
    public function edit(Checkout $checkout)
    {
        
    }

    
    public function update(Request $request, Checkout $checkout)
    {
        
    }

    public function destroy(Checkout $checkout)
    {
        
    }

    public function  successCheckout(){
        return view('success_checkout');
    }
}
