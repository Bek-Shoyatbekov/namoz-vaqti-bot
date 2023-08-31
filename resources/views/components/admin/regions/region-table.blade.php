<table class="table table-hover table-sm table-responsive">
    <thead>
        <tr>
            <th scope="col">#</th>
            <th scope="col">Вилоят (количество городов)</th>
            <th scope="col">Ссылка на сайт</th>
            <th scope="col">Добавлен(Изменен)</th>
            <th scope="col">Действия</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($regions as $region)
            <tr>
                <td scope="row">{{ $region->id }}</td>
                <td>{{ $region->getTranslation('title', 'uz') }} ({{$region->cities->count()}})</td>
                <td><a
                        href="{{ route('viloyat.cities', $region) }}">{{ route('viloyat.cities', $region) }}</a>
                </td>
                <td>{{ $region->created_at->format("d-m-Y") ?? ""}} ({{ $region->updated_at->format("d-m-Y") ?? "" }})</td>
                <td>
                    <a href="{{route('admin.viloyats.show', $region)}}" class="btn btn-sm btn-info">Смотреть</a>
                    <a href="{{ route('admin.viloyats.edit', $region) }}"
                        class="btn btn-sm btn-warning">Редактировать</a>
                    <form action="{{ route('admin.viloyats.destroy', $region) }}" method="post" class="d-inline">
                        @csrf
                        @method("DELETE")
                        <input type="submit" value="Удалить" class="btn btn-sm btn-danger">
                    </form>
                </td>
            </tr>
        @empty
            <p class="my-1">
                Ни один вилоят еще не добавлен
            </p>
        @endforelse
    </tbody>
</table>

@if ($regions->count() > 0)
    {{ $regions->links() }}
@endif