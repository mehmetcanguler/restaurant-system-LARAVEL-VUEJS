@extends('adminlte::page')

@section('title', 'Kategori Oluştur')
@section('content')
    <div class="card">
        <div class="card-header">
            <h2>Kategori Oluştur</h2>
        </div>
        <div class="card-content px-2">
            <form action="{{ route('admin.category.store') }}" method="POST">
                @csrf
                <div class="row">
                    <div class="form-group col-12">
                        <label for="">Kategori Adı Giriniz</label>
                        <input type="text" class="form-control" name="title">
                    </div>
                </div>
                <div class="row">
                    <div class="form-group col-12">
                        <button type="submit" class="btn btn-primary form-control">Kategori oluştur</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
@endsection
