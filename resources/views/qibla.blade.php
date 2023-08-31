<!DOCTYPE html>
<html lang="uz">
<head>
    @include("block/head_content")
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ __("meta.titles.qibla") }}</title>
    <meta name="description" content="{{ __("meta.description.qibla") }}">
    <meta name="keywords" content="{{ __("meta.keywords.qibla") }}" />
    <link rel="stylesheet" href="{{ asset("css/leaflet.css") }}" />
    <style type="text/css">
        html,body{
            height: 100%
        }
        #map{
            height: 600px;
            width: 100%;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-xl navbar-light bg-light">
    <div class="logo">
        <a href="{{route("index")}}">
            <img src="{{asset("img/logo_main.png")}}" height="80" width="80" alt="">
            <span>Namozvaqti.uz</span>
        </a>
    </div>
</nav>
<h1 style="display: none">Qiblani topish sahifasi</h1>
<div class="alert alert-warning center" role="alert">
    Ko'rsatilgan joy noto'g'ri bo'lsa, suratni turgan joyingizga qo'ying!
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col-6 mx-auto" >
            <button class="btn btn-info btn-lg btn-block " onclick="getQiblaDirection()">Qiblani topish</button>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col" >
            <div id="map"></div>
        </div>
    </div>
</div>
@include("block/footer")
<script src="{{asset("js/leaflet.js")}}"></script>
<script type="text/javascript">
    function getQiblaDirection(){
        navigator.geolocation.getCurrentPosition(
            function(position) {
                var currentPosition = [position.coords.latitude, position.coords.longitude];
                var qibla_coords = [21.42246980612687, 39.82614755630493];

                var map = L.map('map').setView(currentPosition, 14);
                L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                    maxZoom: 19,
                    attribution: '&copy; <a href="https://openstreetmap.org/copyright">OpenStreetMap contributors</a>'
                }).addTo(map);

                var qibla_icon = L.icon({
                    iconUrl: '/img/qibla_min.png',
                    iconSize: [45,45],
                    popupAnchor:  [0, -35]
                });
                var prayer_icon = L.icon({
                    iconUrl: '/img/prayer_min.png',
                    iconSize: [45,45],
                    popupAnchor:  [0, -35]
                });

                p_marker = L.marker(currentPosition, {icon: prayer_icon, draggable: true});
                p_marker.addTo(map).bindPopup('Siz turgan joy').openPopup();
                q_marker = L.marker(qibla_coords,  {title: 'Qibla', icon: qibla_icon});
                q_marker.addTo(map).bindPopup('Qibla');

                var latlngs = [currentPosition, qibla_coords];
                var polyline = L.polyline(latlngs, {color: 'green'}).addTo(map);

                p_marker.addEventListener('drag', function(){
                    currentPosition = [p_marker.getLatLng().lat, p_marker.getLatLng().lng];
                    polyline.setLatLngs([currentPosition, qibla_coords]);
                });
            },

            // Функция обратного вызова при неуспешном извлечении локации
            function(error){
                console.log(error);
                if(error.code == 1){
                    alert("Siz turgan joy aniqlash uchun ruxsat berishingiz kerak");
                }
            }
        );
    }
    getQiblaDirection();

</script>
</body>
</html>
