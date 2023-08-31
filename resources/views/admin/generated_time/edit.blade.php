@extends('admin.layouts.main')
@section('title', 'Изменение времени: ' . $time->gregorian_date)
@section('content')

    <form action="{{ route('admin.shahars.time.update', [$city, $time]) }}" method="post">
        @method("PUT")
        @csrf
        <div class="col-4">
            <div class="mb-3">
                <label for="qamar" class="form-label">Qamar sanasi</label>
                <input type="text" value="{{ $time->qamar_date }}" class="form-control" id="qamar" name="qamar_date">
            </div>

            <div class="mb-3">
                <label for="bomdod" class="form-label">Bomdod</label>
                <input type="text" value="{{ $time->tong }}" class="form-control" id="bomdod" name="tong">
            </div>

            <div class="mb-3">
                <label for="quyosh" class="form-label">Quyosh</label>
                <input type="text" value="{{ $time->quyosh }}" class="form-control" id="quyosh" name="quyosh">
            </div>

            <div class="mb-3">
                <label for="peshin" class="form-label">Peshin</label>
                <input type="text" value="{{ $time->peshin }}" class="form-control" id="peshin" name="peshin">
            </div>

            <div class="mb-3">
                <label for="asr" class="form-label">Asr</label>
                <input type="text" value="{{ $time->asr }}" class="form-control" id="asr" name="asr">
            </div>

            <div class="mb-3">
                <label for="shom" class="form-label">Shom</label>
                <input type="text" value="{{ $time->shom }}" class="form-control" id="shom" name="shom">
            </div>

            <div class="mb-3">
                <label for="hufton" class="form-label">Xufton</label>
                <input type="text" value="{{ $time->hufton }}" class="form-control" id="hufton" name="hufton">
            </div>

            <button class="btn btn-warning">Изменить</button>
        </div>
    </form>

@endsection