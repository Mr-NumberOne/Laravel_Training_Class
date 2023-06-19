@extends('layout')

@section('content')

    <div class="container-fluid">
        <h1 style="font-family: Bangers"> categories</h1>

        <a href="{{route('categories.create')}}" class="btn btn-dark mb-5 float-right"> create</a>

        <table class="table table-striped">
            <thead class="table table-dark">
            <tr>
                <th>Name</th>
                <th>Description</th>
                <th>Type</th>
                <th>status</th>
                <th>actions</th>
            </tr>
            </thead>
            <tbody>
            @foreach($categories as $category)
                <tr>
                    <td>{{$category->name}}</td>
                    <td>{{$category->description}}</td>
                    <td>{{$category->type}}</td>
                    <td>{{$category->status}}</td>


                    <td style="width: 180px;">
                        <a href="{{route('categories.edit',$category)}}">
							<span class="btn  btn-outline-success btn-sm font-1 mx-1">
								<span class="fas fa-wrench "></span> تحكم
							</span>
                        </a>

                        <form method="POST" action="{{route('categories.destroy',$category)}}"
                              class="d-inline-block">
                            @csrf
                            @method("DELETE")
                            <button class="btn  btn-outline-danger btn-sm font-1 mx-1"
                                    onclick="var result = confirm('هل أنت متأكد من عملية الحذف ؟');
                         if(result){}else{event.preventDefault()}">
                                <span class="fas fa-trash "></span> حذف
                            </button>
                        </form>


                    </td>

                </tr>
            @endforeach
            </tbody>
        </table>
        {{$categories->render()}}
    </div>>
@endsection
