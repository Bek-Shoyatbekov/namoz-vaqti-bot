@extends('admin.layouts.main')
@section('title', 'Панель администратора')
@section('content')

    <div class="row row-cols-4 px-3">
        <div class="col">
            <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
                <div class="card-header">Города</div>
                <div class="card-body">
                    <h5 class="card-title">Всего городов: {{$cities->count() ?? 0}}</h5>
                    @if ($cities->count() > 0)
                        <p class="card-text">Последний добавленный город: 
                            <a href="{{ route('admin.shahars.show', $cities->sortByDesc('created_at')->first()) }}">
                                {{$cities->sortByDesc('created_at')->first()->translate('title', 'ru')}}
                            </a>
                        </p>    
                    @endif
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
                <div class="card-header">Вилояты</div>
                <div class="card-body">
                    <h5 class="card-title">Всего вилоятов: {{ $regions->count() ?? 0}}</h5>
                    @if ($regions->count() > 0)
                        <p class="card-text">Последний добавленный вилоят:
                            <a href="{{ route('admin.viloyats.show', $regions->sortByDesc('created_at')->first())}}">
                                {{$regions->sortByDesc('created_at')->first()->translate('title', 'ru')}}
                            </a>
                        </p>    
                    @endif
                </div>
            </div>
        </div>

        <div class="col">
            <div class="card text-dark bg-light mb-3" style="max-width: 18rem;">
                <div class="card-header">Время</div>
                <div class="card-body">
                    <h5 class="card-title">Всего времени: <a href="{{ route("admin.maintimes.index") }}">{{ $maintimes->count() }}</a></h5>
                    @if ($maintimes->count() > 0)
                        <p class="card-text">Последнее:
                            {{$maintimes->sortByDesc('greg_date')->first()->greg_date}}
                        </p>    
                    @endif
                </div>
            </div>
        </div>



    </div>
      
@endsection