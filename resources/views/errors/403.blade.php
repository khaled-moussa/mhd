@extends('layouts.errors')

{{-- Title --}}
@section('title', __($exception->getMessage() ?: 'Forbidden'))

{{-- Code --}}
@section('code', '403')

{{-- Message --}}
@section('message', __($exception->getMessage() ?: 'Forbidden'))

{{-- Button slot --}}
@section('button', true)
