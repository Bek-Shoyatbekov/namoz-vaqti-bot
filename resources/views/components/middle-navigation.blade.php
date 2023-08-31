<h1 class="text-center py-2" id="city_name" style="background: #f8f9fa  !important">
    <em>{{ $city->title }}</em>
    (<a href="{{route("viloyat.cities", $city->region->slug)}}">{{$city->region->title}}</a>) @lang("public.namaz-time")
</h1>

<div class="button">
    <div class="nav-but">
        <h5 class="vil">
            @php $qamar_date = get_qamar_date(); @endphp
            <strong>{{ date("d") . " " . $months[date("n") - 1] . " " . date("Y") }}</strong> - 
            <strong>{{ $qamar_date->day . " " . $months_qamar[$qamar_date->month - 1] . " " .$qamar_date->year }}</strong>
        </h5>
        <div class="btn-group btnmar" role="group" aria-label="Basic outlined example">
            <a href="{{route("index")}}" class="btn btn-light px-4 but1">@lang('public.daily')</a>
            <a href="{{route("calendar", [date("n"), $city->slug])}}" class="btn btn-light px-4 but1">@lang('public.monthly')</a>
            <a href="{{route("yillik", $city->slug)}}" class="btn btn-light px-4 but1">@lang('public.yearly')</a>
        </div>
    </div>
</div>
