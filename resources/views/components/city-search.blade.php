<button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#exampleModal">
    @lang("public.nav-select")
</button>


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
                                        <a href="{{route("shahar.time", $shahar->slug)}}"
                                           class=" btn btn-outline-success"
                                           >@switch(app()->getLocale())
                                                @case("ru")
                                                    {{$shahar->name_ru}}
                                                @break
                                                @case("oz")
                                                    {{$shahar->name_oz}}
                                                @break
                                                @case("en")
                                                    {{$shahar->name_en}}
                                                @break
                                                @default
                                                    {{$shahar->name}}
                                                @break                                               
                                            @endswitch</a>
                                        <a class="badge bg-secondary"
                                           href="{{route("viloyat.cities", $shahar->viloyat->slug)}}">
                                           @switch(app()->getLocale())
                                               @case("ru")
                                                    {{$shahar->viloyat->name_ru}}
                                                   @break
                                               @case("oz")
                                                   {{$shahar->viloyat->name_oz}}
                                                  @break
                                               @case("en")
                                                  {{$shahar->viloyat->name_en}}
                                                 @break
                                                @default
                                                    {{$shahar->viloyat->name}}
                                                @break                                               
                                           @endswitch
                                        </a>
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


















    <script>
        const shahars = [
            @foreach($shahars as $shahar)
                {
                    "name": @switch(app()->getLocale())
                                    @case("uz")
                                        "{{$shahar->name}}"                                               
                                    @break
                                    @case("ru")
                                        "{{$shahar->name_ru}}"
                                    @break
                                    @case("oz")
                                        "{{$shahar->name_oz}}"
                                    @break
                                    @case("en")
                                        "{{$shahar->name_en}}"
                                    @break              
                                    @default
                                        "{{$shahar->name}}"                                     
                                @endswitch, 
                    "link": "{{$shahar->slug}}", 
                    "viloyat": {
                        "id": {{$shahar->viloyat->id}}, 
                        "name": @switch(app()->getLocale())
                                    @case("uz")
                                        "{{$shahar->viloyat->name}}"                                               
                                    @break
                                    @case("ru")
                                        "{{$shahar->viloyat->name_ru}}"
                                    @break
                                    @case("oz")
                                        "{{$shahar->viloyat->name_oz}}"
                                    @break
                                    @case("en")
                                        "{{$shahar->viloyat->name_en}}"
                                    @break
                                    @default
                                        "{{$shahar->viloyat->name}}"                                               
                                @endswitch, 
                        "link": "{{$shahar->viloyat->slug}}"
                    } 
                },
            @endforeach
        ];
    
        $("#city_search").on("keyup", () => {
            city_ul.html('')
            let val = escapeHtml($("#city_search").val()).toLowerCase();
            if (val.length > 0) {
                shahars.filter(shahar => {
                    if (shahar.name.toLowerCase().indexOf(val) === 0) city_ul.append(generateString(shahar))
                })
            } else if (val.length === 0) {
                shahars.forEach(item => city_ul.append(generateString(item)))
            }
        })
    </script>