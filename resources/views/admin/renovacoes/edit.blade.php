@extends('layouts.admin')
@section('title', 'Editar renovação')
@section('page-title', 'Editar renovação')
@section('content')
    <div class="capsula-card"><form method="POST" action="{{ route('admin.renewals.update', $renewal) }}">@include('admin.renovacoes._form', ['submitLabel' => 'Salvar alterações', 'method' => 'PUT'])</form></div>
@endsection
