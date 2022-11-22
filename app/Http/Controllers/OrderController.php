<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['heads'] = [
            "Id",
            "Ödeme Tipi",
            'Tutar',
            'Tarih',
            ['label' => 'Düzenle', 'no-export' => true, 'width' => 5],
            ['label' => 'Sil', 'no-export' => true, 'width' => 5],
        ];
        $data['orders'] = Order::with('order_detail.product')->where('status',0)->get();
        return view('admin.order.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $data['heads'] = [
            "Ürün adı",
            "Not",
            'Adet',
            'Fiyat',
            'Toplam',
            'Tarih',
        ];
        $data['order'] = Order::with('order_detail.product')->find($id);
        return view('admin.order.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        foreach($order->order_detail as $order_detail)
        {
            $order_detail->delete();
        }
        $order->delete();

        return redirect()->route('admin.order.index')->withStatus('Adisyon Başarıyla Silindi');
    }
}
