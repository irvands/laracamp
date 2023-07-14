<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Checkout;
use Illuminate\Http\Request;
use App\Models\Camp;
use Auth;

class CheckoutController extends Controller
{
    
    public function index()
    {
        return view ('checkout.create');
    }

    
    public function create(Camp $camp)
    {
    //    return $camp;
        $userEmail = Auth::user()->email;

        return view ('checkout.create',[
            'camp'  => $camp,
            'userEmail'    => $userEmail
        ]);
    }

    
    public function store(Request $request, Camp $camp)
    {
        // return $camp;
        // return $request->all();

        //mapping request data
        $data               =   $request->all();
        $data['user_id']    =   Auth::id();
        $data['camp_id']    =   $camp->id;

        //update data  user
        $user = Auth::user();
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->occupation = $data['occupation'];
        $user->save();

        //store data checkout
        $checkout  = Checkout::create($data);


        return redirect(route('checkout.success'));
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

    public function successCheckout(){
        return view('checkout.success');
    }
}
