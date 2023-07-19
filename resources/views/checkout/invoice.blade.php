@extends('layouts.app')

@section('content')
<section class="checkout">
        <div class="container">
            <div class="card" style="width: 18rem;">
                <img class="card-img-top" src="{{asset ('/images/item_bootcamp.png')}}" alt="Card image cap">

                <div class="card-body">
                    <ul>
                        <li>Nama : {{$checkout->User->name}}</li>
                        <li>email : {{$checkout->User->email}}</li>
                        <li>Camp : {{$checkout->Camp->title}}</li>
                        <li>Harga : {{$checkout->Camp->price}}</li>
                        <li>Status : {{$checkout->payment_status}}</li>
                    </ul>
                </div>
            </div>
        </div>
    </section>
@endsection