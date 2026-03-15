@extends('layouts.admin')

@section('title', 'Editar lead')
@section('page-title', 'Editar lead')

@section('content')
    <div class="capsula-card">
        <form method="POST" action="{{ route('admin.leads.update', $lead) }}">
            @include('admin.leads._form', ['submitLabel' => 'Salvar alterações', 'method' => 'PUT'])
        </form>
    </div>
@endsection
