@extends('adminlte::page')

@section('title', 'Kategoriler')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title bg-dark p-2 rounded rounded-2">Kategoriler</h3>
        <div class="card-tools">
            <a href="{{ route('admin.category.create') }}" class="btn btn-success">Kategori Oluştur</a>
   
        </div>
    </div>
    <div class="card-body">
        @if(session()->has('status'))
        <div class="col-12">
            <div class="alert alert-success" role="alert">{{ session('status') }}</div>
        </div>
         @endif
        <x-adminlte-datatable id="table1" :heads="$heads">
            @foreach ($categories as $category)
                <tr>
                    <td>{{$category->title}}</td>
                    <td>{{$category->created_at->diffForHumans()}}</td>
                    <td><a href="{{route('admin.category.edit',$category->id)}}" class="btn  mx-1 text-warning shadow btn-md btn-default"><i class="fa fa-edit"></i></a></td>
                    <td>
                        <form action="{{route('admin.category.destroy',$category->id)}}" method="POST">
                            @csrf
                            @method('delete')
                           <button type="submit"  class="btn mx-1 text-danger shadow btn-md btn-default"><i class="fa fa-trash"></i></button>
                       </form>
                    </td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </div>
</div>
@endsection