@extends('layouts.admin')
@section('title', 'Editar produto')
@section('page-title', 'Editar produto')
@section('content')
    <div class="capsula-card"><form method="POST" action="{{ route('admin.products.update', $product) }}">@include('admin.produtos._form', ['submitLabel' => 'Salvar alterações', 'method' => 'PUT'])</form></div>
@endsection
