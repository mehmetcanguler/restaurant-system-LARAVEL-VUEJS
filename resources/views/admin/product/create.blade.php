@extends('adminlte::page')

@section('title', 'Ürün Oluştur')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Ürün Oluştur</h2>
        </div>
        <div class="card-content px-2">
            <form action="{{ route('admin.product.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-12 pt-2">
                        <label for="">Kategori Seçiniz</label>
                        <select name="category_id" class="form-control">
                            @foreach ($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->title }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-6">
                        <label for="">Ürün Adı Giriniz</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                    <div class="form-group col-6">
                        <label for="">Ürün Fiyat Giriniz</label>
                        <input type="number" class="form-control" name="price">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary form-control">Ürün oluştur</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
