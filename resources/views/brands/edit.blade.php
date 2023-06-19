@extends('layout')

@section('content')
    <div class="container-fluid">
        <h2 style="font-family: Bangers"> update brand</h2>


        <form class="mx-5" method="post"
              enctype="multipart/form-data"
              action="{{route('brands.update',$brand)}}">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" value="{{old('name',$brand)}}" name="name"
                       class="form-control @error('name') is-invalid @enderror"
                       placeholder="Enter name" id="name">
            </div>
            @error('name')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
            <div class="form-group">
                <label for="image">image</label>
                <input type="file" accept="image/*" value="{{old('image',$brand)}}" name="image"
                       class="form-control @error('image') is-invalid @enderror"
                       id="image">

                @error('image')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <img width="100" src="{{url('storage/'.$brand->image)}}">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
            <a href="{{route('brands.index')}}" class="btn btn-danger">Cancel</a>
        </form>
    </div>R
@endsection
