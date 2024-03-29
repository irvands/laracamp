@extends('layouts.app')

@section('content')
<section class="dashboard my-5">
        <div class="container">
            <div class="row text-left">
                <div class=" col-lg-12 col-12 header-wrap mt-4">
                    <p class="story">
                        DASHBOARD
                    </p>
                    <h2 class="primary-header ">
                        My Bootcamps
                    </h2>
                </div>
            </div>
            <div class="row my-5">
                <table class="table">
                    @include('components.alert')
                    <tbody>
                        @forelse($checkouts as $checkout)
                        
                        <tr class="align-middle">
                            <td width="18%">
                                <img src="{{asset ('/images/item_bootcamp.png')}}" height="120" alt="">
                            </td>
                            <td>
                                <p class="mb-2">
                                    <strong>{{$checkout->Camp->title}}</strong>
                                </p>
                                <p>
                                    {{$checkout->created_at->format('M d, Y')}}
                                </p>
                            </td>
                            <td>
                                <strong>{{$checkout->total}}</strong>
                                @if($checkout->discount_id)
                                    <span class="badge bg-success">{{$checkout->discount_percentage}}%</span>
                                @endif
                            </td>
                            <td>
                                @if($checkout->payment_status == 'waiting')
                                <button onclick="getSnapToken(['{{$checkout->midtrans_snap_token}}'],['{{$checkout->id}}'])" class="btn btn-primary">
                                    pay here
                                </button>
                                @endif
                            </td>
                            <td>
                                @if($checkout->payment_status ==  'paid')
                                <strong class="text-success">Payment Success</strong>
                                @else
                                <strong>Waiting for Payment</strong>
                                @endif
                            </td>
                            <td>
                                <a href="https://wa.me/08XXXXXXXX?text=hi, saya ingin bertanya mengenai kelas {{$checkout->Camp->title}}" class="btn btn-primary">
                                    Contact Suppoort
                                </a>
                            </td>
                        </tr>
                        
                        @empty
                        <tr>
                            <td collspan="5">
                                <h3>No Data</h3>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    

    <script>

        function getSnapToken(snapToken, checkoutId) {

        window.snap.pay(snapToken.toString(), {
            onSuccess: function(result){
                   
            window.location.href = '/invoice/'+checkoutId; 
            console.log(result);
        },
        onPending: function(result){
            
            alert("wating your payment!");
            console.log(result);
        },
        onError: function(result){
            
            alert("payment failed!");
            console.log(result);
        },
        onClose: function(){
           
            alert('you closed the popup without finishing the payment');
        }
        })
        }
    </script>
@endsection