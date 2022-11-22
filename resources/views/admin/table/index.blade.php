@extends('adminlte::page')

@section('title', 'Masalar')
@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title bg-dark p-2 rounded rounded-2">Masalar</h3>
        <div class="card-tools">
            <a href="{{ route('admin.delete.table.show') }}" class="btn btn-danger">Masaları Sil</a>
            <a href="{{ route('admin.table.create') }}" class="btn btn-success">Masa Oluştur</a>
   
        </div>
    </div>
    <div class="card-body">
        @if(session()->has('status'))
        <div class="col-12">
            <div class="alert alert-success" role="alert">{{ session('status') }}</div>
        </div>
         @endif
        <x-adminlte-datatable id="table1" :heads="$heads">
            @foreach ($tables as $table)
                <tr>
                    <td>{{$table->table_location->title}}</td>
                    <td>{{$table->table_no}}</td>
                    <td>{{$table->created_at->diffForHumans()}}</td>
                </tr>
            @endforeach
        </x-adminlte-datatable>
    </div>
</div>
@endsection