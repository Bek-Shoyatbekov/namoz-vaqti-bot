@extends('admin.layouts.main')
@section('title', 'Состояние страницы Рамазан')
@section('content')

    @if($ramazon)
        <h4>{{ $ramazon->is_published ? "Включено" : "Отключено"}}
            @if ($ramazon->is_published)
                <a href="{{ route("admin.ramazon.change") }}" class="btn btn-danger">Отключить</a>
            @else
                <a href="{{ route("admin.ramazon.change") }}" class="btn btn-success">Включить</a>
            @endif
        </h4>

        <p>
            <form action="{{ route("admin.ramazon.edit") }}" method="post">
                @csrf
                @method("put")
                <div class="col-6 mb-3">
                    <input type="date" class="form-control" name="start_date" value="{{ $ramazon->start_date }}">
                </div>
                
                <div class="col-6 mb-3">
                    <input type="date" class="form-control" name="end_date" value="{{ $ramazon->end_date }}">
                </div>

                <div class="col-6 mb-3">
                    <button type="submit" class="btn btn-info">Изменить</button>
                </div>
            </form>
        </p>
    @else
        <h4>Время для Рамазона не добавлено</h4>
        <p>

            <form action="{{ route("admin.ramazon.create") }}" method="post">
                @csrf
                <div class="col-6 mb-3">
                    <input type="date" class="form-control" name="start_date" >
                </div>
                
                <div class="col-6 mb-3">
                    <input type="date" class="form-control" name="end_date" >
                </div>

                <div class="col-6 mb-3">
                    <button type="submit" class="btn btn-info">Добавить</button>
                </div>
            </form>

        </p>
    @endif

    
@endsection