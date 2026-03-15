@extends('layouts.admin')
@section('title', 'Editar oportunidade')
@section('page-title', 'Editar oportunidade')
@section('content')
    <div class="capsula-card"><form method="POST" action="{{ route('admin.opportunities.update', $opportunity) }}">@include('admin.oportunidades._form', ['submitLabel' => 'Salvar alterações', 'method' => 'PUT'])</form></div>
@endsection
