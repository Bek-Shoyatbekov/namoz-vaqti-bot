@extends('admin.layouts.main')
@section('title', 'Сгенерированное время')
@section('content')

    <form action="{{ route('admin.maintimes.store') }}" method="post">
        @csrf

        <div class="row g-1 mb-1">
            <div class="col-2">
                <label>Дата</label>
            </div>
            <div class="col-2">
                <label>Qamar</label>
            </div>
            <div class="col-1">
                <label>Bomdod</label>
            </div>
            <div class="col-1">
                <label>Quyosh</label>
            </div>
            <div class="col-1">
                <label>Peshin</label>
            </div>
            <div class="col-1">
                <label>Asr</label>
            </div>
            <div class="col-1">
                <label>Shom</label>
            </div>
            <div class="col-1">
                <label>Xufton</label>
            </div>
        </div>

        @foreach ($formatted as $line)

            <div class="row g-1 mb-1">
                <div class="col-2">
                    <input type="text" class=" form-control" disabled value="{{$line['greg_date']}}">
                    <input type="hidden" class=" form-control" name="greg_date[]" value="{{$line['greg_date']}}">
                </div>
                <div class="col-2">
                    <input type="text" class=" form-control" required name="qamar_date[]" value="{{$line['qamar_date']}}">
                </div>
                <div class="col-1">
                    <input type="text" class=" form-control" required name="tong[]" value="{{$line['tong']}}">
                </div>
                <div class="col-1">
                    <input type="text" class=" form-control" required name="quyosh[]" value="{{$line['quyosh']}}">
                </div>
                <div class="col-1">
                    <input type="text" class=" form-control" required name="peshin[]" value="{{$line['peshin']}}">
                </div>
                <div class="col-1">
                    <input type="text" class=" form-control" required name="asr[]" value="{{$line['asr']}}">
                </div>
                <div class="col-1">
                    <input type="text" class=" form-control" required name="shom[]" value="{{$line['shom']}}">
                </div>
                <div class="col-1">
                    <input type="text" class=" form-control" required name="hufton[]" value="{{$line['hufton']}}">
                </div>
            </div>
            
            
        @endforeach
        
        <input type="submit" value="Обработать" class="btn btn-success form-control">
    </form>

@endsection
