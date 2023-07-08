@extends('layout')

@section('content')

    <div class="container-fluid">
        <h1 style="font-family: Bangers"> products</h1>

        <a href="{{route('products.create')}}" class="btn btn-dark mb-5 float-right"> create</a>

        <table class="table table-striped">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>image</th>
                <th>Brand</th>
                <th>Categories</th>
                <th>Price</th>
                <th>created by</th>
                <th>Description</th>
                <th>status</th>
                @if($deleted)

                    <th>deleted by</th>
                    <th>deleted at</th>
                @endif
                <th>actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($products as $product)
                <tr>
                    <td>{{$product->id}}</td>
                    <td>{{$product->name}}</td>
                    <td><img width="60" src="{{url('storage/'.$product->image)}}"></td>
                    <td>{{$product->brand?->name??"Not Found"}}</td>
                    <td>{{$product->user?->name??"Not Found"}}</td>
                    <td>
                        @foreach($product->categories as $category)
                            <span>
                                {{ $loop->iteration." - ".$category->name}}
                            </span><br>
                        @endforeach
                    </td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->user?->name}}</td>
                    <td>{{$product->description}}</td>
                    <td>{{$product->status}}</td>
                    @if($deleted)
                        <td>{{$product->userWhoDelete->name}}</td>
                        <td>{{$product->deleted_at}}</td>
                    @endif
                    <td style="width: 180px;">
                        @if(!$deleted)
                            <a href="{{route('products.edit',$product)}}">
							<span class="btn  btn-outline-success btn-sm font-1 mx-1">
								<span class="fas fa-wrench "></span> تحكم
							</span>
                            </a>

                            <form method="POST" action="{{route('products.destroy',$product)}}"
                                  class="d-inline-block">
                                @csrf
                                @method("DELETE")
                                <button class="btn  btn-outline-danger btn-sm font-1 mx-1"
                                        onclick="var result = confirm('هل أنت متأكد من عملية الحذف ؟');
                         if(result){}else{event.preventDefault()}">
                                    <span class="fas fa-trash "></span> حذف
                                </button>
                            </form>

                        @endif


                        @if($deleted)
                            <a href="{{route('products.restore',$product->id)}}">
							<span class="btn  btn-outline-success btn-sm font-1 mx-1">
								<span class="fas fa-wrench "></span> استعادة
							</span>
                            </a>

                            <form method="POST" action="{{route('products.forceDelete',$product->id)}}"
                                  class="d-inline-block">
                                @csrf
                                @method("DELETE")
                                <button class="btn  btn-outline-danger btn-sm font-1 mx-1"
                                        onclick="var result = confirm('هل أنت متأكد من عملية الحذف ؟');
                         if(result){}else{event.preventDefault()}">
                                    <span class="fas fa-trash "></span> حذف
                                </button>
                            </form>

                        @endif


                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        {{$products->render()}}
    </div>>
@endsection
