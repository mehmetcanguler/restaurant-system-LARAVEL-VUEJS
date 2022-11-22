@extends('adminlte::page')

@section('title', 'Adisyon Detay')
@section('content')
    <div class="card">
        <div class="card-header">
            <h3 class="card-title bg-dark p-2 rounded rounded-2">Adisyon Detay</h3>
           
        </div>
        <div class="card-body">
            @if (session()->has('status'))
                <div class="col-12">
                    <div class="alert alert-success" role="alert">{{ session('status') }}</div>
                </div>
            @endif
            <x-adminlte-datatable id="table1" :heads="$heads">
              @if ($order)
              @foreach ($order->order_detail as $order_detail)
              <tr>
                  <td> {{ $order_detail->product->title }} </td>
                  <td> {{ $order_detail->title }} </td>
                  <td> {{ $order_detail->qty }} </td>
                  <td> {{ $order_detail->product->price }} TL </td>
                  <td> {{ $order_detail->product->price *  $order_detail->qty}}.00 TL  </td>
                  <td>{{ $order_detail->created_at->diffForHumans() }}</td>
              </tr>
          @endforeach
              @endif
                </x-adminlte-dataorder>
        </div>
    </div>
@endsection
