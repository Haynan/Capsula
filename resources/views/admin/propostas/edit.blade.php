@extends('layouts.admin')
@section('title', 'Editar proposta')
@section('page-title', 'Editar proposta')
@section('content')
    <div class="capsula-card"><form method="POST" action="{{ route('admin.proposals.update', $proposal) }}">@include('admin.propostas._form', ['submitLabel' => 'Salvar alterações', 'method' => 'PUT'])</form></div>
@endsection
