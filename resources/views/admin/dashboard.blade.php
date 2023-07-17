@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <div class="card">
                <div class="card-healer">
                    My Camps
                </div>

                <div class="card body">
                    @include('components.alert')

                    <table class="table table-responsive">
                        @include('components.alert')
                        <thead>
                            <tr>
                                <td>User</td>
                                <td>Camp</td>
                                <td>Price</td>
                                <td>Register Data</td>
                                <td>Paid Status</td>
                                <td>Action</td>
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
                                    @if(!$checkout->is_paid)
                                    <span class="badge bg-warning">Waiting</span>
                                    @else
                                   <span class="badge bg-success">Paid</span>
                                    @endif
                                </td>
                                <td>
                                    @if(!$checkout->is_paid)
                                    <form action="{{route('admin.checkout.setToPaid', $checkout->id)}}" method="POST">
                                        @csrf
                                        <button class="btn btn-primary btn-sm">Set to paid</button>
                                    </form>
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