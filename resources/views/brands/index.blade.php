@extends('layout')

@section('content')

    <div class="container-fluid">
        <h1 style="font-family: Bangers"> brands</h1>

        @can('create-brands')
            <a href="{{route('brands.create')}}" class="btn btn-dark mb-5 float-right"> create</a>
        @endcan
        <table class="table table-striped">
            <thead class="table table-dark">
            <tr>
                <th>Name</th>
                <th>path</th>
                <th>image</th>
                <th>actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($brands as $brand)
                <tr>
                    <td>{{$brand->name}}</td>
                    <td>{{$brand->image}}</td>
                    <td><img width="100" src="{{url('storage/'.$brand->image)}}"></td>


                    <td style="width: 180px;">
                        @can('update-brands')
                            <a href="{{route('brands.edit',$brand)}}">
							<span class="btn  btn-outline-success btn-sm font-1 mx-1">
								<span class="fas fa-wrench "></span> تحكم
							</span>
                            </a>
                        @endcan
                        @can('delete-brands')

                            <form method="POST" action="{{route('brands.destroy',$brand)}}"
                                  class="d-inline-block">
                                @csrf
                                @method("DELETE")
                                <button class="btn  btn-outline-danger btn-sm font-1 mx-1"
                                        onclick="var result = confirm('هل أنت متأكد من عملية الحذف ؟');
                         if(result){}else{event.preventDefault()}">
                                    <span class="fas fa-trash "></span> حذف
                                </button>
                            </form>
                        @endcan


                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        {{$brands->render()}}
    </div>>
@endsection
