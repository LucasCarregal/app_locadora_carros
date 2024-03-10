@extends('layouts.app')

@section('content')
    <login-component url_login={{ route('auth.login') }} csrf_token={{ csrf_token() }} ></login-component>
@endsection
