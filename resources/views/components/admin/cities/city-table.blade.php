<table class="table table-hover table-sm table-responsive">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Город (Вилоят)</th>
            <th scope="col">Время</th>
            <th scope="col">Ссылка на сайт</th>
            <th scope="col">Добавлен(Изменен)</th>
            <th scope="col">Действия</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($cities as $city)
            <tr>
                <td scope="row">{{$city->id}}</td>
                <td>{{$city->translate('title', 'uz')}} (<a href="{{route('admin.viloyats.show', $city->region)}}">{{$city->region->translate('title', 'uz')}}</a>)</td>
                <td>{{ $city->generated_times->count() }}</td>
                <td><a href="{{ route('shahar.time', $city) }}">{{ route('shahar.time', $city) }}</a></td>
                <td>{{ $city->created_at->format('d-m-Y')}} ({{$city->updated_at->format('d-m-Y')}})</td>
                <td>
                    <a href="{{route('admin.shahars.show', $city)}}" class="btn btn-sm btn-info">Смотреть</a>
                    <a href="{{route('admin.shahars.edit', $city)}}" class="btn btn-sm btn-warning">Редактировать</a>
                    <form action="{{route('admin.shahars.destroy', $city)}}" method="post" class="d-inline">
                        @csrf
                        @method("DELETE")
                        <input type="submit" value="Удалить" class="btn btn-sm btn-danger">
                    </form>
                </td>
            </tr>
        @empty
            <p class="my-1">
                Ни один город еще не добавлен
            </p>
        @endforelse
    </tbody>
</table>

@if ($cities->count() > 0)
    {{ $cities->links() }}
@endif