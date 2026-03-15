@extends('layouts.admin')

@section('title', 'Novo cliente')
@section('page-title', 'Cadastrar cliente')

@section('content')
    <div class="capsula-card">
        <form method="POST" action="{{ route('admin.clients.store') }}">
            @include('admin.clientes._form', ['submitLabel' => 'Salvar cliente'])
        </form>
    </div>
@endsection
