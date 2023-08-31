@extends('admin.layouts.main')
@section('title', 'Генерация для сервера')
@section('additional_assets')
    <script src="https://cdn.jsdelivr.net/npm/pikaday/pikaday.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/pikaday/css/pikaday.css">
@endsection
@section('content')

    <form action="{{ route('admin.generatedForServer') }}" method="post">
        @csrf
        <div class="col-9">
            <div class="mb-3">
                <label for="city_id" class="form-label">Город</label>
                <select name="city_id" id="city_id" class="form-control" required>
                    <option disabled selected>Выберите город</option>
                    @foreach ($cities as $city)
                        <option value="{{ $city->id }}">{{ $city->getTranslation('title', 'ru') }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3 ">
                <label for="in_remote_server_id" class="form-label">ID в базе данных</label>
                <input id="in_remote_server_id" type="number" name="in_remote_server_id" class="form-control" min="1"
                    required>
            </div>

            <div class="row">
                <div class="mb-3 col-6">
                    <label for="datepicker_from" class="form-label">Начиная с какой даты</label>
                    <input type="text" name="date_started" class="form-control" id="datepicker_from" required>
                </div>


                <div class="mb-3 col-6">
                    <label for="datepicker_end" class="form-label">Заканчивая какой даты</label>
                    <input type="text" name="date_end" class="form-control" id="datepicker_end" required>
                </div>
            </div>

            <div>
                <input type="submit" value="Получить" class="btn btn-primary">
            </div>
        </div>
    </form>

    @isset($result)
        <div class="mt-3 px-3 py-2 bg-light">
            <button class="btn btn-success btn-sm" style="float: right" id="btn-copy">Копировать</button>
            <code id="sql_query">
                {!! $result !!}
            </code>
        </div>

        <script>
            document.getElementById("btn-copy").addEventListener("click", function(event){
                let text_to_copy = document.getElementById("sql_query").innerText
                navigator.clipboard.writeText(text_to_copy)
                alert("Скопировано!!!")
            });    
        </script>
    @endisset


    <script>
        var picker = new Pikaday({
            field: document.getElementById('datepicker_from'),
            format: "YYYY-MM-DD",
            toString(date, format) {
                // you should do formatting based on the passed format,
                // but we will just return 'D/M/YYYY' for simplicity
                const day = date.getDate() > 9 ? date.getDate() : '0' + date.getDate();
                const month = date.getMonth() + 1 > 9 ? date.getMonth() + 1 : '0' + (date.getMonth() + 1);
                const year = date.getFullYear();
                return `${year}-${month}-${day}`;
            },
            parse(dateString, format) {
                // dateString is the result of `toString` method
                const parts = dateString.split('/');
                const day = parseInt(parts[0], 10);
                const month = parseInt(parts[1], 10) - 1;
                const year = parseInt(parts[2], 10);
                return new Date(year, month, day);
            }
        });

        var picker = new Pikaday({
            field: document.getElementById('datepicker_end'),
            format: "YYYY-MM-DD",
            toString(date, format) {
                // you should do formatting based on the passed format,
                // but we will just return 'D/M/YYYY' for simplicity
                const day = date.getDate() > 9 ? date.getDate() : '0' + date.getDate();
                const month = date.getMonth() + 1 > 9 ? date.getMonth() + 1 : '0' + (date.getMonth() + 1);
                const year = date.getFullYear();
                return `${year}-${month}-${day}`;
            },
            parse(dateString, format) {
                // dateString is the result of `toString` method
                const parts = dateString.split('/');
                const day = parseInt(parts[0], 10);
                const month = parseInt(parts[1], 10) - 1;
                const year = parseInt(parts[2], 10);
                return new Date(year, month, day);
            }
        });
    </script>

@endsection
