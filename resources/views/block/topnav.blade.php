<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <div class="logo">
            <a href="{{route("index")}}" class="d-flex logo-wrap align-items-baseline">
                <img src="{{asset("img/logo_new.png")}}" alt="Bosh sahifa" width="35" height="35" title="Bosh sahifa">
            <span class="mt-1">Namozvaqti.uz</span>

        </a>
        </div>
        <!-- Button trigger modal -->
        <div>
            <div class="d-inline">
                <a class="btn btn-primary btn-sm" href="{{ url('/') }}">Uz</a>
                <a class="btn btn-primary btn-sm" href="{{ url('/') }}/oz">Ўз</a>
                <a class="btn btn-primary btn-sm" href="{{ url('/') }}/ru">Ру</a>
                <a class="btn btn-primary btn-sm" href="{{ url('/') }}/en">En</a>
            </div>

            <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
                @lang("public.nav-select")
            </button>    
        </div>

       
        <!-- Modal -->
        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">@lang("public.nav-select")</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="row">
                        <div class="col mx-3 mt-1"><a href="{{route("viloyat.index")}}" class="btn btn-info">@lang('public.viloyat-list')</a></div>
                    </div>
                    <div class="row mt-1" style="min-height: 400px">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 mx-3 py-2">
                            <div class="col-9 mx-2">
                                <input type="text" class="form-control" placeholder="@lang('public.type-city')"
                                       id="city_search">
                            </div>
                            <ul style="list-style: none;" id="cities_list">
                                @foreach($shahars as $shahar)
                                    <li>
                                        <a href="{{route("shahar.time", $shahar->slug)}}" class=" btn btn-outline-success">{{ $shahar->title }}</a>
                                        <a class="badge bg-secondary" href="{{route("viloyat.cities", $shahar->region->slug)}}">{{ $shahar->region->title }}</a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">@lang("public.close")</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</nav>
