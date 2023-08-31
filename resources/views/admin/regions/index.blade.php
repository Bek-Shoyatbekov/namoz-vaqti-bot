@extends('admin.layouts.main')
@section('title', 'Список вилоятов')
@section('content')
    <a href="{{ route('admin.viloyats.create') }}" class="btn btn-sm btn-primary mb-1">Добавить вилоят</a>
    <x-admin-regions-table :region="0"/>
@endsection
