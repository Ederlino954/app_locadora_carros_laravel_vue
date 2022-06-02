@extends('layouts.app')

@section('content')
    {{-- <login-component xyz="teste 1" abc="teste 2" aBcDe="padrão camel case" numero-parcelas="parcelas camel case " ></login-component> --}}

    <login-component csrf_token="{{ @csrf_token() }}"></login-component>

@endsection
