@extends('adminlte::page')

@section('title', 'Kullanıcıyı Düzenle')
@section('content')
    <div class="card">
        <div class="card-header">
            Kullanıcıyı Düzenle
        </div>
        <div class="card-body">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{route('admin.user.update',$user->id)}}" method="POST">
                @method('PUT')
                @csrf
                <div class="form-group  d-flex">
                    <input class="form-control" type="text" name="name" placeholder="Adı Ve Soyadı"
                        value="{{ $user->name }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-user "></span>
                        </div>
                    </div>
                </div>
                <div class="form-group d-flex">
                    <input class="form-control" type="email" name="email" placeholder="E-posta Adresi"
                        value="{{ $user->email }}">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-envelope "></span>
                        </div>
                    </div>
                </div>
                <div class="form-group d-flex">
                    <input class="form-control" type="password" name="password" placeholder="Yeni Parola">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock "></span>
                        </div>
                    </div>
                </div>
                <div class="form-group d-flex">
                    <input class="form-control" type="password" name="password_confirmation" placeholder="Yeniden Parola">
                    <div class="input-group-append">
                        <div class="input-group-text">
                            <span class="fas fa-lock"></span>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary form-control">Güncelle</button>
                </div>
            </form>
        </div>
    </div>
@endsection
