<?php

namespace App\Http\Controllers;

use App\Http\Requests\MainAddOrderDetailRequest;
use App\Http\Requests\MainCompleteOrderRequest;
use App\Http\Requests\MainEditOrderDetailQtyRequest;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Table;
use App\Models\TableLocation;

class MainController extends Controller
{
    public function index()
    {
        $data['tables']  = TableLocation::with('table.order.order_detail.product')->get();
        return view('index', $data);
    }
    public function tables()
    {
        $data['tables']  = TableLocation::with('table.order.order_detail.product')->get();
        return response()->json($data);
    }
    public function order($table_id)
    {
        $table = Table::find($table_id) ?? abort(404);
        $data['categories'] = Category::with('products')->get();

        if ($table->status == 1) {
            $data['order'] = Order::with('order_detail.product')->where('table_id', $table_id)->where('status', 1)->first();
        }
        return response()->json($data);
    }
    public function addOrderDetail(MainAddOrderDetailRequest $request)
    {
        $table = Table::find($request->table_id) ?? abort(404);
        if ($table->status == 1) {
            $order =  Order::with('order_detail.product')->where('table_id', $table->id)->where('status', 1)->first();
        } else {
            $order = Order::create([
                'table_id' => $table->id
            ]);
        }
        $product = Product::find($request->product_id);

        if (OrderDetail::where('product_id', $product->id)->where('order_id', $order->id)->first()) {
            $order_detail = OrderDetail::where('product_id', $product->id)->where('order_id', $order->id)->first();
            $order_detail->qty = $order_detail->qty + $request->qty;
            if($request->title != null){
                $order_detail->title = $order_detail->title ."-". $request->title . "*" . $request->qty;
            }else{
                $order_detail->title = $request->title;
            }
           
            $order_detail->save();
        } else {
            $title = null;
            if($request->title != null){
                $title = $request->title . "*" . $request->qty;
            }
            $order_detail = OrderDetail::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'title' => $title,
                'qty' => $request->qty,

            ]);
        }

        if ($table->status == 0) {
            $table->status = 1;
            $table->save();
        }
        $data['tables']  = TableLocation::with('table.order.order_detail.product')->get();
        $data['order'] = Order::with('order_detail.product')->find($order_detail->order_id);
        return response()->json($data);
    }
    public function editOrderDetailQty(MainEditOrderDetailQtyRequest $request, $id)
    {
        $order_detail =  OrderDetail::find($id) ?? abort(404);
        $order_detail->qty = $request->qty;
        $order_detail->save();
        
        $data['tables']  = TableLocation::with('table.order.order_detail.product')->get();
        $data['order'] = Order::with('order_detail.product')->find($order_detail->order_id);
        return response()->json($data);
    }

    public function deleteOrderDetail($id)
    {
        $order_detail = OrderDetail::find($id);
        $order_id = $order_detail->order_id;
        $order_detail->delete();

        $data['tables']  = TableLocation::with('table.order.order_detail.product')->get();
        $data['order'] = Order::with('order_detail.product')->find($order_id);
        return response()->json($data);
    }
    public function completeOrder(MainCompleteOrderRequest $request)
    {
        $order = Order::with('order_detail.product')->find($request->order_id) ?? abort(404);

        $totalOrder = 0;

        foreach ($order->order_detail as $value) {
            if ($value->status == 1) {
                $totalOrderDetailPrice = 0;
                $totalOrderDetailPrice = $value->qty * $value->product->price;
                $totalOrder = $totalOrder + $totalOrderDetailPrice;
            }
        }
        $order->payment_type = $request->payment_type;
        $order->total = $totalOrder;
        $order->status = 0;
        $order->save();

        $table = Table::find($order->table_id);
        $table->status = 0;
        $table->save();

        $tables = TableLocation::with('table.order.order_detail.product')->get();
        return response()->json($tables);
    }
    public function getProduct($id)
    {
        $products = Product::where('category_id', $id)->get() ?? abort(404);
        return response()->json($products);
    }
    public function deleteOrder($id)
    {
        $order = Order::find($id);
        $table_id = $order->table->id;
        $table = Table::find($table_id);
        $table->status = 0;
        $table->save();
        $order->delete();
        $data['tables']  = TableLocation::with('table.order.order_detail.product')->get();
        $data['order'] = null;

        return response()->json($data);
    }
}
