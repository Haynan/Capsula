@extends('layouts.admin')

@section('title', 'Novo lead')
@section('page-title', 'Cadastrar lead')

@section('content')
    <div class="capsula-card">
        <form method="POST" action="{{ route('admin.leads.store') }}">
            @include('admin.leads._form', ['submitLabel' => 'Salvar lead'])
        </form>
    </div>
@endsection
