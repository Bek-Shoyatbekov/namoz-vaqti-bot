<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include("block/head_content")
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __("meta.titles.viloyat_list") }} </title>
    <meta name="description" content="{{ __("meta.description.viloyat_list") }}">
</head>
<body>
<header>
    @include("block/topnav")
</header>
<div class="container mt-3">
    <div class="row">
        <h1 class="mb-3">@lang("public.viloyat-list")</h1>
        @php $i=0 @endphp
        @foreach($regions as $region)
            <div class="col-xl-4 col-xs-12 py-1"><a class="btn btn-outline-success" href="{{route("viloyat.cities", $region->slug)}}">{{ $region->title }}</a></div>
        @endforeach
    </div>
</div>

@include("block/footer")

</body>
</html>

