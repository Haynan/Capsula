@extends('layouts.admin')
@section('title', 'Editar parceiro')
@section('page-title', 'Editar parceiro')
@section('content')
    <div class="capsula-card"><form method="POST" enctype="multipart/form-data" action="{{ route('admin.partners.update', $partner) }}">@include('admin.parceiros._form', ['submitLabel' => 'Salvar alterações', 'method' => 'PUT'])</form></div>
@endsection
