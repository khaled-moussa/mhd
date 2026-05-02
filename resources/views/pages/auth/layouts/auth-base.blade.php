{{-- Use main layout --}}
@extends('layouts.guest')

{{-- Page assets --}}
@push('head')
    @vite(['resources/css/pages/auth/_auth.css'])
@endpush

{{-- Content --}}
@section('content')
    @include('pages.auth.partials.auth-wrapper')
@endsection
