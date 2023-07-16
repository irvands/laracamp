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
                                <td>{{$checkout->created_at->format('Y-m-d')}}</td>
                                <td>
                                    @if(!$checkout->is_paid)
                                   false
                                    @else
                                   true
                                    @endif
                                </td>
                                <td>
                                    <form action="" method="POST">
                                        @csrf
                                        <button class="btn btn-primary btn-sm"></button>
                                    </form>
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