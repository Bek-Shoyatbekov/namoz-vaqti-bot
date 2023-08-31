@php
    $city = session()->get("city");
    $months = __("public.months");
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include("block/head_content")
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ __("meta.titles.ramazon") }}</title>
    <meta name="keywords" content="{{ __("meta.description.ramazon") }}"/>
    <meta name="description" content="{{ __("meta.keywords.ramazon") }}">
</head>
<body>
@include("block/topnav")

<div class="table-responsive" style="width: 100%; margin: auto">
    @php
        $currentDate = 0;
        $weekdays = __('public.weekdays');
    @endphp
        <x-middle-navigation :city="$city"/>

    <div class="nav-out">
    </div>
    <h1 class="text-center">{{$city->ramazon->first()->gregorian_date->year}} @lang('public.ramazon-calendar')</h1>
    <table class="table table-sm table_calendar">
        <tr class="table-info">
            <th>@lang('public.day')</th>
            <th>@lang('public.day-week')</th>
            <th>@lang('public.date')</th>
            <th>@lang('public.sahar')</th>
            <th>@lang('public.iftar')</th>
        </tr>
        @foreach($city->ramazon as $t)
            @if(date("d") == $t->gregorian_date->day && date("m") == $t->gregorian_date->month)
                <tr class="table-success">
            @else
                <tr>@endif
                <td>{{$t->qamar_date->day}}</td>
                <td>{{$weekdays[$t->gregorian_date->dayOfWeekIso - 1]}}</td>
                <td>{{ $t->gregorian_date->day . " " . $months[$t->gregorian_date->month - 1] ." ".  $t->gregorian_date->year}}</td>
                <td>{{$t->tong}}</td>
                <td>{{$t->shom}}</td>
            </tr>
        @endforeach
    </table>
</div>


@include("block/footer")
</body>
</html>
