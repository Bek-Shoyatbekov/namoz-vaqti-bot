@extends('admin.layouts.main')
@section('title', "Добавление вилоята")
@section('content')
    <form action="{{ route('admin.viloyats.store') }}" method="POST">
        @csrf

        <label for="slug">Ссылка: </label><label id="slugResult"></label>
        <div class="mb-3 input-group">
            <span class="input-group-text">{{env('APP_URL')}}/viloyat/</span>
            <input type="text" name="slug" id="slug" class="form-control" required>
            <a class="btn btn-info" id="check_slug_btn">Проверить</a>
        </div>



        <div class="mb-3">
            <label for="t_uz">Название на узбекском языке (латиница)</label>
            <input type="text" name="title_uz" id="t_uz" class="form-control" required>
        </div>
        
        <div class="mb-3">
            <label for="t_en">Название на английском языке (латиница)</label>
            <input type="text" name="title_en" id="t_en" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="t_oz">Название на узбекском языке (кириллица)</label>
            <input type="text" name="title_oz" id="t_oz" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="t_ru">Название на русском языке (кириллица)</label>
            <input type="text" name="title_ru" id="t_ru" class="form-control" required>
        </div>

        <div class="mb-3">
            <input type="submit" value="Добавить" class="btn btn-success form-control" disabled="true" id="submitBtn">
        </div>
    </form>


    <script>
        document.getElementById('check_slug_btn')
                .addEventListener('click', () => {
                    const slug = document.getElementById('slug').value
                    fetch("{{ route('admin.viloyats.check-slug') }}" + `?slug=${slug}`, )
                    .then((response) => response.json())
                    .then(data => {
                        if(data.isUnique){
                            document.getElementById('slugResult').className = ""
                            document.getElementById('slugResult').classList.add('text-success')
                            document.getElementById('slugResult').innerText = "Вы можете использовать это значение"
                        } else {
                            document.getElementById('slugResult').className = ""
                            document.getElementById('slugResult').classList.add('text-danger')
                            document.getElementById('slugResult').innerText = "Вы не можете использовать это значение"
                        }
                        document.getElementById('submitBtn').disabled = !data.isUnique 
                    })
                })
        document.getElementById('slug')
                .addEventListener('keydown', () => {
                    document.getElementById('submitBtn').disabled = true
                    document.getElementById('slugResult').innerText = ""
                })

    </script>
@endsection