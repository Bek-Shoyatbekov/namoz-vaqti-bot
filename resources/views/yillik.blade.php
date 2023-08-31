@php $city = session()->get("city"); $months = __("public.months"); @endphp

<!DOCTYPE html>
<html lang="uz">
<head>
    @include("block/head_content")
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __("meta.titles.yillik", ["city" => $city->title, "year" => date("Y")]) }}</title>
    <meta name="description" content="{{ __('meta.description.yillik', ['city' => $city->title]) }}">

</head>
<body>
<header>
    @include("block/topnav")
</header>

<div class="table-responsive" style="width: 100%; margin: auto">
    <x-middle-navigation :city="$city"/>
</div>

<div class="row p-3">
    <div class="d-grid gap-2 col-9 mx-auto">
        @for ($i = 0; $i < 12; $i++)
            <a href="{{route("calendar", [$i + 1, $city->slug])}}" class="btn btn-block btn-success">@lang("public.months.$i")</a>        
        @endfor
    </div>
</div>

@include("block/footer")

</body>
</html>