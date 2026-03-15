@extends('layouts.admin')
@section('title', 'Novo produto')
@section('page-title', 'Cadastrar produto')
@section('content')
    <div class="capsula-card"><form method="POST" action="{{ route('admin.products.store') }}">@include('admin.produtos._form', ['submitLabel' => 'Salvar produto'])</form></div>
@endsection
