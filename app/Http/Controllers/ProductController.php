<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['heads'] = [
            "Kategori Adı",
            "Ürün Adı",
            'Fiyat',
            'Oluşturulma Tarihi',
            ['label' => 'Düzenle', 'no-export' => true, 'width' => 5],
            ['label' => 'Sil', 'no-export' => true, 'width' => 5],
        ];

        $data['products'] = Product::with('category')->get();
        return view('admin.product.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['categories'] = Category::get();
        return view('admin.product.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Product::create([
            'category_id' => $request->category_id,
            'title' => $request->title,
            'price' => $request->price,
        ]);

        return redirect()->route('admin.product.index')->withStatus('Ürün Başarıyla Oluşturuldu');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {   
        $data['categories'] = Category::get();
        $data['product'] = $product;
        return view('admin.product.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
       $product->category_id =$request->category_id;
       $product->price =$request->price;
       $product->title =$request->title; 
       $product->save();
       return redirect()->route('admin.product.index')->withStatus('Ürün Başarıyla Güncellendi');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('admin.product.index')->withStatus('Ürün Başarıyla Silindi');
    }
}
