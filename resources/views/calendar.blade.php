@php
    $city = session()->get("city")
@endphp
<!DOCTYPE html>
<html lang="uz">
<head>
    @include("block/head_content")
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @php 
        $months = __("public.months");
        $months_qamar = __("public.months_qamar");

        $year = $times->first()->gregorian_date->year;
        $month = $months[ $times->first()->gregorian_date->month -1 ];
        $start_q_month = $months_qamar[$times->first()->qamar_date->month - 1];
        $end_q_month = $months_qamar[$times->last()->qamar_date->month - 1];

        $start_q_year = $times->first()->qamar_date->year;
        $end_q_year = $times->last()->qamar_date->year;


    @endphp
    <title>{{ __("meta.titles.oylik", ["city"=>$city->title, "month" => $month, "year" => $year]) }}</title>
    <meta name="description" content="{{ __("meta.description.oylik", ["city"=>$city->title, "month" => $month, "year" => $year]) }}">
</head>
<body>
<header>
    @include("block/topnav")
</header>

<div class="table-responsive" style="width: 100%; margin: auto">
    @php $currentDate = date("d") - 1; @endphp
    <x-middle-navigation :city="$city"/>

    <h4 class="text-center mt-3">{{ "$month $year" }}</h4>
    <h4 class="text-center">{{ "$start_q_month $start_q_year - $end_q_month $end_q_year"}}</h4>
    <table class="table table-sm table_calendar">
        <tr class="table-info">
            <td>@lang('public.day')</td>
            <td>@lang("public.bomdod")</td>
            <td>@lang("public.quyosh")</td>
            <td>@lang("public.peshin")</td>
            <td>@lang("public.asr")</td>
            <td>@lang("public.shom")</td>
            <td>@lang("public.hufton")</td>
            <td>@lang("public.qamar")</td>

        </tr>
        @foreach($times as $time)
            @if(date("d") == substr($time->gregorian_date, 8) && date("m") == substr($time->gregorian_date, 5, 2))
                <tr class="table-success">
            @else
                <tr>
            @endif
                    <td style="text-align: start">{{$time->gregorian_date->day." ". $weekdays[$time->gregorian_date->dayOfWeekIso - 1].""}} </td>
                    <td>{{$time->tong}}</td>
                    <td>{{$time->quyosh}}</td>
                    <td>{{$time->peshin}}</td>
                    <td>{{$time->asr}}</td>
                    <td>{{$time->shom}}</td>
                    <td>{{$time->hufton}}</td>
                    <td>{{$time->qamar_date->day}}</td>

                </tr>
        @endforeach
    </table>
</div>
@include("block/footer")

</body>
</html>
