@extends('mails.layouts.common')

@section('content')
    Ваш пароль: <b>{{ $password }}</b><br /><br />
    {{ $text }}
@endsection