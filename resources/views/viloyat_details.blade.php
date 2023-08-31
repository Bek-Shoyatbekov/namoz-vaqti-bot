@php $city = session()->get("city"); $months = __("public.months"); @endphp

<!DOCTYPE html>
<html lang="uz">
<head>
    @include('block/head_content')

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> {{ __("meta.titles.viloyat_details", ["region" => $region->title, "month" => $months[date("n") - 1], "year" => date("Y")]) }} </title>
    <meta name="description" content="{{ __("meta.description.viloyat_details", ["region" => $region->title]) }}">
</head>
<body>
<header>
    @include("block/topnav")
</header>
<div class="container mt-3">
    <div class="row">
        <p class="">
            <a href="{{route('viloyat.index')}}" class="btn btn-info">@lang("public.viloyat-list")</a>
        </p>
        <h1 class="mb-3">

            @lang('public.viloyat_cities', ["viloyat" => $region->title])</h1>
        @foreach($region->cities as $city)
            <div class="col-xl-4 col-xs-12 py-1">
                <a class="btn btn-outline-success" href="{{route("shahar.time", $city->slug)}}">{{ $city->title }}</a>
            </div>
        @endforeach
    </div>
</div>
@include("block/footer")

</body>
</html>
