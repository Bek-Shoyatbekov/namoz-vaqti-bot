@extends('admin.layouts.main')
@section('title', 'Изменение времени отсчёта на: ' . $maintime->greg_date)
@section('content')
    <form action="{{ route('admin.maintimes.update', $maintime) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row">
            
            <div class="col-12">
                <div class="input-group mb-3">
                    <span class="input-group-text">Qamar sana</span>
                    <input type="text" class="form-control time" name="qamar_date" value="{{$maintime->qamar_date}}">
                </div>
            </div>

            <div class="col-4">
                <div class="input-group mb-3">
                    <span class="input-group-text">Bomdod</span>
                    <input type="text" class="form-control time" name="tong" value="{{$maintime->tong}}">
                </div>
            </div>

            <div class="col-4">
                <div class="input-group mb-3">
                    <span class="input-group-text">Quyosh</span>
                    <input type="text" class="form-control time" name="quyosh" value="{{$maintime->quyosh}}">
                </div>
            </div>

            <div class="col-4">
                <div class="input-group mb-3">
                    <span class="input-group-text">Peshin</span>
                    <input type="text" class="form-control time" name="peshin" value="{{$maintime->peshin}}">
                </div>
            </div>

            <div class="col-4">
                <div class="input-group mb-3">
                    <span class="input-group-text">Asr</span>
                    <input type="text" class="form-control time" name="asr" value="{{$maintime->asr}}">
                </div>
            </div>

            <div class="col-4">
                <div class="input-group mb-3">
                    <span class="input-group-text">Shom</span>
                    <input type="text" class="form-control time" name="shom" value="{{$maintime->shom}}">
                </div>
            </div>

            <div class="col-4">
                <div class="input-group mb-3">
                    <span class="input-group-text">Xufton</span>
                    <input type="text" class="form-control time" name="hufton" value="{{$maintime->hufton}}">
                </div>
            </div>

        </div>

        <input type="submit" value="Изменить" class="btn btn-success form-control">


    </form>


@endsection
