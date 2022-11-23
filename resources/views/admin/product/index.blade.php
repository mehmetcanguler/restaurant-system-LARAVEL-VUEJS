@extends('adminlte::page')

@section('title', 'Ürünler')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title bg-dark p-2 rounded rounded-2">Ürünler</h3>
        <div class="card-tools">
            <a href="{{ route('admin.product.create') }}" class="btn btn-success">Ürün Oluştur</a>
   
        </div>
    </div>
    <div class="card-body">
        @if(session()->has('status'))
        <div class="col-12">
            <div class="alert alert-success" role="alert">{{ session('status') }}</div>
        </div>
         @endif
        <x-adminlte-datatable id="table1" :heads="$heads">
            @foreach ($products as $product)
                <tr>
                    <td>{{$product->category->title}}</td>
                    <td>{{$product->title}}</td>
                    <td>{{$product->price}}</td>
                    <td>{{$product->created_at->diffForHumans()}}</td>
                    <td><a href="{{route('admin.product.edit',$product->id)}}" class="btn  mx-1 text-warning shadow btn-md btn-default"><i class="fa fa-edit"></i></a></td>
                    <td>
                        <form action="{{route('admin.product.destroy',$product->id)}}" method="POST">
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