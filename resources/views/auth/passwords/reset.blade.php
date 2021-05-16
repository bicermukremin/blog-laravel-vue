@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row  mt-5">
        <div class="col-md-4 offset-4 card card-primary p-3 border"
             :class="{'border-primary' : isUser, 'border-success' : !isUser }">
            <h3
                    :class="{'text-primary' : isUser, 'text-success' : !isUser }"
                    class="text-center mb-3 mt-3">MB Developer | Şifre Değişim</h3>
            <hr>
            <form action="{{ route('password.update') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label>E-posta Adresiniz</label>
                    <input type="email" name="email" class="form-control"
                            value="{{ $email }}"
                           placeholder="E-posta adresinizi giriniz">
                </div>
                <div class="form-group">
                    <label>Şifre</label>
                    <input name="password" type="password" class="form-control" placeholder="Şifreniz...">
                    <input type="hidden" value="<?php echo $token; ?>" name="token" class="form-control" placeholder="Şifreniz...">
                </div>
                <div class="form-group">
                    <label>Şifre Tekrarı</label>
                    <input name="password_confirmation" type="password" class="form-control" placeholder="Şifreniz...">
                </div>
                <div class="button-container d-flex  flex-column align-items-center">
                    <button type="submit" class="btn-primary"
                            class="btn btn-block mb-2">
                       Onayla
                    </button>
                    
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
