@extends('adminlte::page')

@section('title', 'Masaları Sil')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title bg-dark p-2 rounded rounded-2">Masaları Sil</h3>
    </div>
    <div class="card-body">
        <x-adminlte-datatable id="table1" :heads="$heads">
            @foreach ($table_locations as $location)
                <tr>
                    <td>{{$location->title}}</td>
                    <td>{{$location->table->count()}}</td>
                    <td> <form action="{{route('admin.delete.table.destroy',$location->id)}}" method="POST">
                        @csrf
                        @method('delete')
                       <button type="submit"  class="btn mx-1 text-danger shadow btn-md btn-default"><i class="fa fa-trash"></i></button>
                   </form></td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </div>
</div>
@endsection