@extends('admin.layouts.main')
@section('title', "Основное время отсчёта (". $maintimes->count() .")")
@section('content')
    @php $qamar_months = __("public.months_qamar") @endphp
    <a href="{{ route('admin.maintimes.create') }}" class="btn btn-sm btn-primary mb-1">Добавить/Изменить время отсчёта</a>

    <table class="table table-hover table-sm table-responsive">
        <thead>
            <tr>
                <th scope="col">Дата</th>
                <th scope="col">Qamar(Месяц)</th>
                <th scope="col">Bomdod</th>
                <th scope="col">Quyosh</th>
                <th scope="col">Peshin</th>
                <th scope="col">Asr</th>
                <th scope="col">Shom</th>
                <th scope="col">Xufton</th>
                <th scope="col">Изменение</th>
                <th scope="col">Действия</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($maintimes as $maintime)
                @php
                    $qamar_month_number = date_format(date_create($maintime->qamar_date), "n");
                @endphp
                <tr>
                    <td>{{ $maintime->greg_date}}</td>
                    <td>{{ $maintime->qamar_date}} ({{$qamar_months[$qamar_month_number - 1]}}) </td> 
                    <td>{{ $maintime->tong }}</td>
                    <td>{{ $maintime->quyosh }}</td>
                    <td>{{ $maintime->peshin }}</td>
                    <td>{{ $maintime->asr }}</td>
                    <td>{{ $maintime->shom }}</td>
                    <td>{{ $maintime->hufton }}</td>
                    <td>{{ $maintime->updated_at->format('d-m-Y, H:i') }}</td>
                    <td>
                        {{-- <a href="{{route('admin.maintimes.show', $maintime)}}" class="btn btn-sm btn-info">Смотреть</a> --}}
                        <a href="{{ route('admin.maintimes.edit', $maintime) }}" class="btn btn-sm btn-warning">Редактировать</a>
                        <form action="{{ route('admin.maintimes.destroy', $maintime) }}" method="post" class="d-inline">
                            @csrf
                            @method("DELETE")
                            <input type="submit" value="Удалить" class="btn btn-sm btn-danger">
                        </form>
                    </td>
                </tr>
            @empty
                <p class="my-1">
                    Время еще не добавлено
                </p>
            @endforelse
        </tbody>
    </table>

    @if ($maintimes->count() > 0)
        {{ $maintimes->links() }}
    @endif

@endsection
