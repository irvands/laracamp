@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <div class="card mt-3">
                <div class="card-header">
                    All registered Camp
                </div>

                <div class="card-body">
                    @include('components.alert')

                    <table class="table table-responsive">
                        @include('components.alert')
                        <thead>
                            <tr>
                                <th>User</th>
                                <th>Camp</th>
                                <th>Price</th>
                                <th>Register Data</th>
                                <th>Paid Status</th>
                               
                            </tr>
                        </thead>

                        <tbody>
                            @forelse($checkouts as $checkout)
                            <tr>
                                <td>{{$checkout->User->name}}</td>
                                <td>{{$checkout->Camp->title}}</td>
                                <td>{{$checkout->Camp->price}}K</td>
                                <td>{{$checkout->created_at->format('M d Y')}}</td>
                                <td>
                                    @if($checkout->payment_status == 'paid')
                                    <span class="badge bg-success">Paid</span>
                                    @else
                                   <span class="badge bg-warning">Waiting</span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td collspan="3">No camps registered</td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection