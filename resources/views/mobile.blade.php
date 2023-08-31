@php
    $city = session()->get("city");
    $months = __("public.months");
@endphp
<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="" type="image/x-icon">
    <link rel="stylesheet" type="text/css" href="{{asset("css/bootstrap.min.css")}}">
    <link rel="stylesheet" href="{{asset("css/mobile.css")}}">
    @php $months = __("public.months") @endphp


    @if(url()->current() == route("index"))
        <title>{{ __("meta.titles.index", ["month" => $months[date("n") - 1], "year" => date("Y")]) }}</title>
        <meta name="description" content="{{ __("meta.description.index", ["month" => $months[date("n") - 1]] ) }}">
    @else
        <title>{{ __("meta.titles.index-city", ["city" => $city->title, "month" => $months[date("n") - 1], "year" => date("Y")]) }}</title>
        <meta name="description" content="{{ __("meta.description.index-city", ["city" => $city->title, "month" => $months[date("n") - 1], "year" => date("Y")] ) }}">
    @endif
    <meta name="keywords" content="{{ __("meta.keywords.index") }}"/>


</head>
<body style="background-color: #00645c;">

@include("block/topnav")
<x-middle-navigation :city="$city"/>



<div class="text-center" style="font-weight: bold; font-size: 18px">@lang('public.current-time'): <span id="current_time">{{date("H:i:s")}}</span></div>
@if($ramazon != null && $ramazon->is_published)
    <div class=" text-center">
        <a href="{{route('ramazon', $city->slug)}}" class="btn btn-outline-light btn-sm" style="font-size: 22px; font-weight: bold">{{date("Y")}} @lang('public.ramazon-calendar')</a>
    </div>
@endif
{{--<div class="reklam"></div>--}}
<div class="vryema">
    <p class="vryema_t">
        <span id="remaining_period"></span>
        <span id="remaining_time"></span>
    </p>
</div>

<div class="time">
    <div class="blok">
        <p class="time-name">@lang("public.bomdod"): <span class="ot1">{{$city->today->first()->tong}}</span> <span>(Saharlik)</span>
        </p>
    </div>
    <div class="blok">
        <p class="time-name">@lang("public.quyosh"): <span class="ot2">{{$city->today->first()->quyosh}}</span></p>
    </div>
    <div class="blok">
        <p class="time-name">@lang("public.peshin"): <span class="ot3">{{$city->today->first()->peshin}}</span></p>
    </div>
    <div class="blok">
        <p class="time-name">@lang("public.asr"): <span class="ot4">{{$city->today->first()->asr}}</span></p>
    </div>
    <div class="blok">
        <p class="time-name">@lang("public.shom"): <span class="ot5">{{$city->today->first()->shom}}</span> <span>(Iftorlik)</span></p>
    </div>
    <div class="blok">
        <p class="time-name">@lang("public.hufton"): <span class="ot6">{{$city->today->first()->hufton}}</span></p>
    </div>
</div>


<div class="reklam"></div>

@include("block/footer")

<script src="{{asset("js/moment.js")}}"></script>

<script>
    const times = [
        '{{$city->today->first()->tong}}',
        '{{$city->today->first()->quyosh}}',
        '{{$city->today->first()->peshin}}',
        '{{$city->today->first()->asr}}',
        '{{$city->today->first()->shom}}',
        '{{$city->today->first()->hufton}}',
        '{{$city->tomorrow->first()->tong}}'
    ];
    const timeBlocks = ['@lang("public.til-bomdod")', '@lang("public.til-quyosh")', '@lang("public.til-peshin")', '@lang("public.til-asr")', '@lang("public.til-shom")', '@lang("public.til-hufton")', `@lang("public.tom-bomdod")` ];
    
    function msToTime(s) {
        if (s < 0) s = -s;
        var ms = s % 1000;
        s = (s - ms) / 1000;
        var secs = s % 60;
        s = (s - secs) / 60;
        var mins = s % 60;
        var hrs = (s - mins) / 60;
        hrs = hrs < 10 ? "0" + hrs : hrs;
        mins = mins < 10 ? "0" + mins : mins;
        secs = secs < 10 ? "0" + secs : secs;
        return hrs + ':' + mins + ':' + secs;
    }

    var currentTime = moment($("#current_time").text(), "HH:mm:ss");
    var period = 0;
    for (var i = 0; i < 6; i++) {
        if (currentTime.diff(moment(times[i], "HH:mm")) > 0) {
            period = i;
        }
        if (currentTime.diff(moment(times[5], "HH:mm")) > 0) {
            period++
        }
    }

    setInterval(() => {
        $("#current_time").text(currentTime.format("HH:mm:ss"));

        if (period === 6) {
            // difference = moment(times[period], "DD-MM-YYYY HH:mm").diff(currentTime)\
            difference = moment(times[period], "HH:mm").add(1, 'days').diff(currentTime)

        } else {
            difference = currentTime.diff(moment(times[period], "HH:mm"))
        }
        
        currentTime = currentTime.add(1, "seconds");
        
        if (period > 0) {
            $(".blok").eq(period - 1).addClass(" blok-inner ");
        } else {
            $(".blok").eq(period).addClass(" blok-inner ");
        }

        if (currentTime.diff(moment(times[period], "HH:mm")) > 0) {
            if (period > 0) {
                if(period ===6){
                    $(".blok").eq(period - 2).removeClass(" blok-inner ");
                } else{
                    $(".blok").eq(period - 1).removeClass(" blok-inner ");
                }
            } else {
                $(".blok").eq(period).removeClass(" blok-inner ");
            }
            period++
            period = period > 6 ? 6 : period;
        }
        $("#remaining_time").text(msToTime(difference))
        $("#remaining_period").text(timeBlocks[period] + ": ")
    }, 1000);

</script>


</body>
</html>
