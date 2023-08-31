@extends('admin.layouts.main')
@section('title', 'Добавление времени отсчета')
@section('content')

    <form action="{{ route('admin.maintimes.generate') }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="data" class="form-label">Введите данные</label>
            <p><b>Формат:</b> Qamar_oy Gregor_oy Qamar_sana Gregor_sana Tong Quyosh Peshin Asr Shom Xufton</p>
            <textarea class="form-control" id="data" rows="10" name="data"></textarea>
        </div>

        <input type="submit" value="Обработать" class="btn btn-success form-control">

    </form>

@endsection
