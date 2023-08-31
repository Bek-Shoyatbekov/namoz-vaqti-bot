@extends('admin.layouts.main')
@section('title', $city->translate('title', 'ru'))
@section('content')

    <div class="row">
        <div class="col-12">
            <a href="{{ route('shahar.time', $city) }}">{{ route('shahar.time', $city) }}</a>
        </div>
    </div>

    <h3>Подробности</h3>

    <table class="table table-hover table-sm">
        <tr>
            <td><strong>Название на узбекском(латиница)</strong></td>
            <td>{{ $city->translate('title', 'uz') }}</td>
        </tr>
        <tr>
            <td><strong>Название на узбекском(кириллица)</strong></td>
            <td>{{ $city->translate('title', 'oz') }}</td>
        </tr>
        <tr>
            <td><strong>Название на английском</strong></td>
            <td>{{ $city->translate('title', 'en') }}</td>
        </tr>
        <tr>
            <td><strong>Название на русском</strong></td>
            <td>{{ $city->translate('title', 'ru') }}</td>
        </tr>
        <tr>
            <td><strong>Добавлен</strong></td>
            <td>{{ $city->created_at->format('d-m-Y, H:i:s') }}</td>
        </tr>
        <tr>
            <td><strong>Последнее изменение</strong></td>
            <td>{{ $city->updated_at->format('d-m-Y, H:i:s') }}</td>
        </tr>
    </table>

    <h3>Время ({{ $city->generated_times->count() }})</h3>
    <a href="{{ route('admin.shahars.time.create', $city) }}" class="btn btn-sm btn-primary my-2">Добавить время</a>
    @if ($city->generated_times->count() > 20)
        {{ $city->generated_times()->paginate(20)->links() }}
    @endif
    
    <table class="table table-hover table-sm table-responsive">
        <thead>
            <tr>
                <th scope="col">Дата</th>
                <th scope="col">Qamar</th>
                <th scope="col">Bomdod</th>
                <th scope="col">Quyosh</th>
                <th scope="col">Peshin</th>
                <th scope="col">Asr</th>
                <th scope="col">Shom</th>
                <th scope="col">Xufton</th>
                <th scope="col">Добавлен(Изменен)</th>
                <th scope="col">Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($city->generated_times()->paginate(20) as $time)
                <tr>
                    <td>{{ $time->gregorian_date->toDateString() }}</td>
                    <td>{{ $time->qamar_date->toDateString() }}</td>
                    <td>{{ $time->tong }}</td>
                    <td>{{ $time->quyosh }}</td>
                    <td>{{ $time->peshin }}</td>
                    <td>{{ $time->asr }}</td>
                    <td>{{ $time->shom }}</td>
                    <td>{{ $time->hufton }}</td>
                    <td>{{ $time->created_at->format('d-m-Y')}} ({{$time->updated_at->format('d-m-Y')}})</td>
                    <td>
                        <a href="{{route('admin.shahars.time.edit', [$city, $time])}}" class="btn btn-sm btn-warning">Редактировать</a>
                    </td>
                </tr>
            @empty
                <p class="my-1">
                    Время для этого города еще не добавлено
                </p>
            @endforelse
        </tbody>
    </table>

@endsection
