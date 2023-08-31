@extends('admin.layouts.main')
@section('title', $region->translate('title', 'ru'))
@section('content')

    <div class="row">
        <div class="col-12">
            <a href="{{ route('viloyat.cities', $region) }}">{{ route('viloyat.cities', $region) }}</a>
        </div>
    </div>

    <h3>Подробности</h3>

    <table class="table table-hover table-sm">
        <tr>
            <td><strong>Название на узбекском(латиница)</strong></td>
            <td>{{ $region->translate('title', 'uz') }}</td>
        </tr>
        <tr>
            <td><strong>Название на узбекском(кириллица)</strong></td>
            <td>{{ $region->translate('title', 'oz') }}</td>
        </tr>
        <tr>
            <td><strong>Название на английском</strong></td>
            <td>{{ $region->translate('title', 'en') }}</td>
        </tr>
        <tr>
            <td><strong>Название на русском</strong></td>
            <td>{{ $region->translate('title', 'ru') }}</td>
        </tr>
        <tr>
            <td><strong>Добавлен</strong></td>
            <td>{{ $region->created_at->format('d-m-Y, H:i:s') }}</td>
        </tr>
        <tr>
            <td><strong>Последнее изменение</strong></td>
            <td>{{ $region->updated_at->format('d-m-Y, H:i:s') }}</td>
        </tr>
    </table>

    <h3>Города ({{ $region->cities->count() }})</h3>

    
    <table class="table table-hover table-sm table-responsive">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Город</th>
                <th scope="col">Ссылка на сайт</th>
                <th scope="col">Добавлен(Изменен)</th>
                <th scope="col">Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($region->cities as $city)
                <tr>
                    <td scope="row">{{$city->id}}</td>
                    <td>{{$city->translate('title', 'ru')}}</td>
                    <td><a href="{{ route('shahar.time', $city) }}">{{ route('shahar.time', $city) }}</a></td>
                    <td>{{ $city->created_at->format('d-m-Y')}} ({{$city->updated_at->format('d-m-Y')}})</td>
                    <td>
                        <a href="{{route('admin.shahars.show', $city)}}" class="btn btn-sm btn-info">Смотреть</a>
                        <a href="{{route('admin.shahars.edit', $city)}}" class="btn btn-sm btn-warning">Редактировать</a>
                        <form action="{{route('admin.shahars.destroy', $city)}}" method="post" class="d-inline">
                            @csrf
                            @method("DELETE")
                            <input type="submit" value="Удалить" class="btn btn-sm btn-danger">
                        </form>
                    </td>
                </tr>
            @empty
                <p class="my-1">
                    Ни один город еще не добавлен
                </p>
            @endforelse
        </tbody>
    </table>

@endsection
