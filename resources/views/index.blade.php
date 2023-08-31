@php $city = session()->get("city"); $months = __("public.months"); @endphp

<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include("block/head_content")
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    @if(url()->current() == route("index"))
        <title>{{ __("meta.titles.index", ["month" => $months[date("n") - 1], "year" => date("Y")]) }}</title>
        <meta name="description" content="{{ __("meta.description.index", ["month" => $months[date("n") - 1], "year" => date("Y")] ) }}">
    @else
        <title>{{ __("meta.titles.index-city", ["city" => $city->title, "year" => date("Y"), "month" => $months[date("n") - 1]]) }}</title>
        <meta name="description" content="{{ __("meta.description.index-city", ["city" => $city->title, "month" => $months[date("n") - 1], "year" => date("Y")] ) }}">
    @endif
    <meta name="keywords" content="{{ __("meta.keywords.index") }}"/>
    
    <style>
        select {
            -webkit-appearance: none;
            appearance: none;
            -moz-appearance: none;
        }
    </style>
</head>
<body>
<header>
    @include("block/topnav")

    <x-middle-navigation :city="$city"/>

    <div class="current_time">
        <span>@lang('public.current-time') </span>
        <span id="current_time">{{date("H:i:s")}}</span>
        @if($ramazon != null && $ramazon->is_published)
            <div>
                <a href="{{route('ramazon', $city->slug)}}" class="btn btn-link" style="font-size: 25px">{{date("Y")}} @lang('public.ramazon-calendar')</a>
            </div>
        @endif
    </div>
</header>
<div class="alert alert-warning text-center" style="font-size: 23px; font-weight: bold">
    <span id="remaining_period"></span><span id="remaining_time" class=""></span>
</div>
<main>
    <div class="ad__container">
        <div class="ad__in">
            <div class="ad__item bor">
                <div style="margin-top: -45px;font-size: 22px; font-weight: bold; ">
                    <p>@lang('public.saharlik')</p>
                </div>
                <div>
                    <p class="time" id="bomdod">{{$city->today->first()->tong}}</p>
                    <h2 class="nam">@lang('public.bomdod')</h2>
                </div>
            </div>
            <div class="ad__item bor">
                <div>
                    <p class="time" id="quyosh">{{$city->today->first()->quyosh}}</p>
                    <h2 class="nam">@lang('public.quyosh')</h2>
                </div>
            </div>
            <div class="ad__item bor">
                <div>
                    <p class="time" id="peshin">{{$city->today->first()->peshin}}</p>
                    <h2 class="nam">@lang('public.peshin')</h2>
                </div>
            </div>
            <div class="ad__item bor" data-content="">
                <div>
                    <p class="time" id="asr">{{$city->today->first()->asr}}</p>
                    <h2 class="nam">@lang('public.asr')</h2>
                </div>
            </div>
            <div class="ad__item bor">
                <div>
                    <div style="margin-top: -45px; font-size: 22px; font-weight: bold;">
                        <p>@lang('public.after')</p>
                    </div>
                    <p class="time" id="shom">{{$city->today->first()->shom}}</p>
                    <h2 class="nam">@lang('public.shom')</h2>
                </div>
            </div>
            <div class="ad__item bor">
                <div>
                    <p class="time" id="hufton">{{$city->today->first()->hufton}}</p>
                    <h2 class="nam">@lang('public.hufton')</h2>
                </div>
            </div>
        </div>
    </div>
</main>

@include("block/footer")

<script src={{asset("js/moment.js")}}></script>
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
        if (currentTime.diff(moment(times[i], "HH:mm")) > 0){
            period = i;
        }
        if(currentTime.diff(moment(times[5], "HH:mm")) > 0){
            period++
        }
    }

    var time = times[period]
    var difference = currentTime.diff(moment(times[period], "HH:mm"))

    setInterval(() => {
        $("#current_time").text(currentTime.format("HH:mm:ss"));

        if(period === 6){
            difference = moment(times[period], "HH:mm").add(1, 'days').diff(currentTime)
        } else {
            difference = currentTime.diff(moment(times[period], "HH:mm"))
        }

        currentTime = currentTime.add(1, "seconds");
        
        if(period > 0){
            $(".ad__item").eq(period-1).addClass(" active_time ");
        } else{
            $(".ad__item").eq(period).addClass(" active_time ");
        }
        if (currentTime.diff(moment(times[period], "HH:mm")) > 0) {
            if(period > 0){
                if(period === 6){
                    $(".ad__item").eq(period - 2).removeClass(" active_time ");
                } else {
                    $(".ad__item").eq(period - 1).removeClass(" active_time ");
                }
            } else{
                $(".ad__item").eq(period).removeClass(" active_time ");
            }
            period++
            period = period > 6 ? 6 : period;
        }
        $("#remaining_time").text(msToTime(difference))
        $("#remaining_period").text(`${timeBlocks[period]} : `)
    }, 1000);
</script>
</body>
</html>