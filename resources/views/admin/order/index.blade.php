@extends('adminlte::page')

@section('title', 'Adisyonlar')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title bg-dark p-2 rounded rounded-2">Adisyonlar</h3>
           
        </div>
        <div class="card-body">
            @if (session()->has('status'))
                <div class="col-12">
                    <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                </div>
            @endif
            <x-adminlte-datatable id="table1" :heads="$heads">
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->id }}</td>
                        <td>
                            @if ($order->payment_type == 0)
                                Nakit
                            @else
                                Kredi Kartı
                            @endif
                        </td>
                        <td>{{ $order->total }} TL</td>
                        <td>{{ $order->created_at->diffForHumans() }}</td>
                        <td><a href="{{ route('admin.order.show', $order->id) }}"
                                class="btn  mx-1 text-success shadow btn-md btn-default"><i class="fa fa-eye"></i></a></td>
                        <td>
                            <form action="{{ route('admin.order.destroy', $order->id) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn mx-1 text-danger shadow btn-md btn-default"><i
                                        class="fa fa-trash"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </x-adminlte-dataorder>
        </div>
    </div>
@endsection
