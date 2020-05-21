@extends('templates.default')

@section('title', 'Добро пожаловать')

@section('content')
        <h3>Добро пожаловать @if(\Illuminate\Support\Facades\Auth::user()) {{\Illuminate\Support\Facades\Auth::user()->getNameorUsername()}} @endif</h3>
@endsection
