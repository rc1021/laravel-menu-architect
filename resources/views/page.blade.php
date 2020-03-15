@extends('menu_architect::master')

@push('css')
    @include('menu_architect::plugins', ['type' => 'css'])
@endpush

@push('js')
    @include('menu_architect::plugins', ['type' => 'js'])
@endpush