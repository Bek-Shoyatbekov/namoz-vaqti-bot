@extends('admin.layouts.main')
@section('title', 'Список городов')
@section('content')
    <a href="{{ route('admin.shahars.create') }}" class="btn btn-sm btn-primary mb-1">Добавить город</a>
    <x-admin-city-table/>
@endsection
