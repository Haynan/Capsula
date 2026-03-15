@extends('layouts.admin')
@section('title', 'Nova renovação')
@section('page-title', 'Cadastrar renovação')
@section('content')
    <div class="capsula-card"><form method="POST" action="{{ route('admin.renewals.store') }}">@include('admin.renovacoes._form', ['submitLabel' => 'Salvar renovação'])</form></div>
@endsection
