@extends('layouts.admin')
@section('title', 'Nova oportunidade')
@section('page-title', 'Cadastrar oportunidade')
@section('content')
    <div class="capsula-card"><form method="POST" action="{{ route('admin.opportunities.store') }}">@include('admin.oportunidades._form', ['submitLabel' => 'Salvar oportunidade'])</form></div>
@endsection
