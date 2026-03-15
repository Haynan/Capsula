@extends('layouts.admin')
@section('title', 'Novo parceiro')
@section('page-title', 'Cadastrar parceiro')
@section('content')
    <div class="capsula-card"><form method="POST" enctype="multipart/form-data" action="{{ route('admin.partners.store') }}">@include('admin.parceiros._form', ['submitLabel' => 'Salvar parceiro'])</form></div>
@endsection
