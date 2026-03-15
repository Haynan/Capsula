@extends('layouts.admin')
@section('title', 'Nova proposta')
@section('page-title', 'Cadastrar proposta')
@section('content')
    <div class="capsula-card"><form method="POST" action="{{ route('admin.proposals.store') }}">@include('admin.propostas._form', ['submitLabel' => 'Salvar proposta'])</form></div>
@endsection
