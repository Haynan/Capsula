@extends('layouts.admin')

@section('title', 'Perfil')
@section('page-title', 'Perfil do administrador')

@section('content')
    <div class="space-y-6">
        <div class="capsula-card">
            <div class="max-w-2xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="capsula-card">
            <div class="max-w-2xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

    </div>
@endsection
