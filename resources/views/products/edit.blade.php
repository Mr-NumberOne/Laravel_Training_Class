@extends('layout')

@section('content')
    <div class="container-fluid">
        <h2 style="font-family: Bangers"> Update product</h2>


        <form class="mx-5" method="post" action="{{route('products.update',$product)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" value="{{old('name',$product)}}" name="name" class="form-control @error('name') is-invalid @enderror"
                       placeholder="Enter name" id="name">
            </div>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="Description">Description:</label>
                <textarea  class="form-control @error('description') is-invalid @enderror" name="description" id="Description">{{old('description',$product)}}</textarea>
            </div>

            <div class="">
                <input type="radio" class="" id="customRadio"
                       name="type"   @checked(old('type',$product)=='New' || old('type',$product)==null) value="New">
                <label class=" mr-5" for="customRadio">New</label>


                <input  type="radio" class=" " id="customRadio2"
                        name="type" @checked(old('type',$product)=="Old")   value="Old">
                <label class="" for="customRadio2">Old</label>
            </div>
            <div class="form-group form-check">
                <label class="form-check-label">
                    <input name="status"

                           @checked(old('status',$product) )

                           class="form-check-input" type="checkbox"> Status
                    {{old('name')}}
                </label>
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('products.index')}}" class="btn btn-danger">Cancel</a>
        </form>
    </div>
@endsection
