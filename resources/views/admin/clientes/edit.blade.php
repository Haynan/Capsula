@extends('layouts.admin')

@section('title', 'Editar cliente')
@section('page-title', 'Editar cliente')

@section('content')
    <div class="capsula-card">
        <form method="POST" action="{{ route('admin.clients.update', $client) }}">
            @include('admin.clientes._form', ['submitLabel' => 'Salvar alterações', 'method' => 'PUT'])
        </form>
    </div>
@endsection
