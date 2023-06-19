@extends('layout')

@section('content')
    <div class="container-fluid">
    <h2 style="font-family: Bangers"> create product</h2>


    <form class="mx-5" method="post"
          enctype="multipart/form-data"
          action="{{route('products.store')}}">
        @csrf
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" value="{{old('name')}}" name="name" class="form-control @error('name') is-invalid @enderror"
                   placeholder="Enter name" id="name">
        </div>
        @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="brand_id">Select Brand:</label>
            <select class="form-control" id="brand_id" name="brand_id">
                <option value="">Select Brand</option>
                @foreach($brands as $brand)
                    <option value="{{$brand->id}}"
                    @if(old('brand_id')==$brand->id) selected @endif
                    >{{$brand->name}}</option>
                @endforeach

            </select>
        </div>
        <div class="form-group">
            <label for=" ">Select categories:</label>
            <select class="form-control select2" id="brand_id" multiple name="categories[]">
                <option value="">Select Brand</option>
                @foreach($categories as $category)
                    <option value="{{$category->id}}"

                    >{{$category->name}}</option>
                @endforeach

            </select>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" value="{{old('price')}}" name="price" class="form-control @error('price') is-invalid @enderror"
                   placeholder="Enter price" id="price">
        </div>
        @error('price')
        <div class="alert alert-danger">{{ $message }}</div>
        @enderror
        <div class="form-group">
            <label for="Description">Description:</label>
            <textarea  class="form-control @error('description') is-invalid @enderror" name="description" id="Description">{{old('description')}}</textarea>
        </div>

        <div class="form-group">
            <label for="image">image</label>
            <input type="file" accept="image/*" value="{{old('image')}}" name="image" class="form-control @error('image') is-invalid @enderror"
                   id="image">
            @error('image')
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group form-check">
            <label class="form-check-label">
                <input name="status"

                       @checked(old('status') )

                       class="form-check-input" type="checkbox"> Status
                {{old('name')}}
            </label>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        <a href="{{route('products.index')}}" class="btn btn-danger">Cancel</a>
    </form>
    </div>
@endsection
