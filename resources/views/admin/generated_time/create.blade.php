@extends('admin.layouts.main')
@section('title', 'Добавление времени для '.$city->translate('title', 'ru'))
@section('content')

    <form action="{{ route('admin.shahars.time.generate', $city) }}" method="post">
        @csrf
        <div class="mb-3">
            <label for="data" class="form-label">Введите данные</label>
            <p><b>Формат:</b> Sana	Tong	Quyosh	Peshin	Asr	Shom	Xufton </p>
            <textarea class="form-control" id="data" rows="10" name="data"></textarea>
        </div>
        
        <input type="submit" value="Обработать" class="btn btn-success form-control">

    </form>

@endsection
