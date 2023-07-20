@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-8 offset-2">
            <div class="card mt-3">
                <div class="card-header">
                    Create a New Discount
                </div>

                <div class="card-body">
                   <form action="{{route('admin.discount.store')}}" method="POST">
                        @csrf

                        <div class="form-group mb-4">
                            <label class="form-label">Name</label>
                            <input type="text" name="name" class="form-control {{$errors->has('name') ? 'is-invalid' : ''}}" value="{{old('name')}}" />
                            @if($errors->has('name'))
                            <p class="text-danger">{{$errors->first('name')}}</p>
                            @endif
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label">Code</label>
                            <input type="text" name="code" class="form-control {{$errors->has('code') ? 'is-invalid'  : ''}}" value="{{old('code')}}" />
                            @if($errors->has('code'))
                            <p class="text-danger">{{$errors->first('code')}}</p>
                            @endif
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label">Description</label>
                            <textarea cols="0" rows="2" name="description" class="form-control {{$errors->has('description') ? 'is-invalid'  : ''}}">{{old('description')}}</textarea>
                            @if($errors->has('description'))
                            <p class="text-danger">{{$errors->first('description')}}</p>
                            @endif
                        </div>

                        <div class="form-group mb-4">
                            <label class="form-label">Discount Percentage</label>
                            <input type="number" name="percentage" class="form-control {{$errors->has('percentage') ? 'is-invalid' : ''  }}" value="{{old('percentage')}}"/>
                            @if($errors->has('percentage'))
                            <p class="text-danger">{{$errors->first('percentage')}}</p>
                            @endif
                        </div>

                        <button type="submit" class="btn btn-primary btn-sm">Add Discount</button>
                        
                    </form>
                       
                </div>
            </div>
        </div>
    </div>
</div>
@endsection