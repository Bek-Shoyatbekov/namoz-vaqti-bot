<p align="center">
    <a class="btn btn-lg btn-block " style="color: #222; ;background-color: #e9b10d !important; border-color: #007A39 !important" href="{{route("qibla")}}">@lang('public.qibla')</a>
</p>


<footer>
    <input type="hidden" id="locale" value="{{app()->getLocale()}}">

    <div class="footer">
        @php $description = "Namoz vaqtlari. O'zbekiston shaharlari uchun namoz vaqtlari";@endphp
        <a href="https://play.google.com/store/apps/details?id=com.programmsoft.prayertime" id="playmarketbtn"><img src={{asset("img/pmarket.png")}} width="43" height="43" alt="play market" title="play market"></a>
        <a href="https://t.me/namozvaqtiuz_bot"><img src={{asset("img/telegram.png")}} width="43" height="43"
                                                         alt="Telegram" title="Telegram"></a>
{{--        <a href="#"><img src={{asset("img/instagram.png")}} width="43" height="43" alt=""></a>--}}
{{--        <a href="#"><img src={{asset("img/mail.png")}} width="43" height="43" alt=""></a>--}}
        <a href="https://www.facebook.com/sharer.php?src=sp&u={{route("index")}}%2F&title={{$description}}&utm_source=share2"><img src={{asset("img/fb.png")}} width="43" height="43" alt="facebook" title="facebook"></a>
        
    </div>
    <div class="cop text-center">
        ©<strong>Namozvaqti <?php echo date("Y")?></strong>
        <br/>
        @lang("public.dedication")
    </div>
    <script src="{{asset("js/jquery-3.5.1.min.js")}}"></script>
    <script src="{{asset("js/bootstrap.bundle.min.js")}}"></script>
    <script src="{{asset("js/search.js")}}"></script>
    <!-- Yandex.Metrika counter -->
    <script type="text/javascript" >
        (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
            m[i].l=1*new Date();k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
        (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

        ym(67654851, "init", {
            clickmap:true,
            trackLinks:true,
            accurateTrackBounce:true,
            webvisor:true
        });
    </script>
    <noscript><div><img src="https://mc.yandex.ru/watch/67654851" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
    <!-- /Yandex.Metrika counter -->
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-179299483-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());
        gtag('config', 'UA-179299483-1');
    </script>

<script>
    const shahars = [
        @foreach($shahars as $shahar)
            {
                "name": "{{ $shahar->title}}",
                "link": "{{ $shahar->slug }}", 
                "viloyat": {
                    "id": {{$shahar->region->id}}, 
                    "name": "{{ $shahar->region->title }}",
                    "link": "{{ $shahar->region->slug }}"
                }
            },
        @endforeach
    ];

</script>
</footer>

