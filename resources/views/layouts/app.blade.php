<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <!-- Fonts -->
    <script src="{{ asset('js/app.js') }}"></script>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">   
    <link href="{{ asset('fontawesome/fontawesome-free-5.10.2-web/css/all.css') }}" rel="stylesheet">
    @yield('css')
    @yield('head')
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">

                    </ul>
                    {{-- <ul><h3>BAYZARA</h3></ul> --}}
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        </li>
                        @else
                          <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Süreç</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                               @role('genel mudur|planlama|admin|muhasebe') <a class="dropdown-item" href="{{route('control.create')}}">Perkotek Mola Alanı Rapor</a>@endrole  
                               @role('genel mudur|planlama|admin|muhasebe') <a class="dropdown-item" href="{{route('control2')}}">Perkotek Yemekhane Rapor</a>@endrole  
                                @role('genel mudur|konfeksiyon plan|sevkiyat|planlama|admin|desen|konfeksiyon')<a class="dropdown-item" href="{{route('order.index')}}">Sipariş</a> @endrole 
                               @can('delete') <a class="dropdown-item" href="{{route('kapananindex')}}">Kapanan Sipariş</a> @endcan 
                                @role('genel mudur|muhasebe|admin|konfeksiyon')<a class="dropdown-item" href="{{route('priceindex')}}">Fiyatlar</a> @endrole
                               @role('muhasebe') <a class="dropdown-item" href="{{route('kapananindex')}}">Kapanan Sipariş</a> @endrole 
                               @role('genel mudur|konfeksiyon plan|planlama|admin|sevkiyat') <a class="dropdown-item" href="{{route('iplikbukum.index')}}">İplik Büküm Talimat</a>  @endrole
                               @role('genel mudur|planlama|admin|sevkiyat') <a class="dropdown-item" href="{{route('iplikboya.index')}}">İplik Boya Talimat</a>  @endrole
                               @role('genel mudur|planlama|admin|sevkiyat') <a class="dropdown-item" href="{{route('boyahane.index')}}">Boyahane Talimat</a>  @endrole
                               @role('genel mudur|planlama|admin|sevkiyat') <a class="dropdown-item" href="{{route('kumas.index')}}">Kumas(Boyahane) Kabul</a>  @endrole
                               @role('genel mudur|konfeksiyon plan|planlama|admin|sevkiyat') <a class="dropdown-item" href="{{route('cozgu.index')}}">Çözgü Talimat</a>@endrole  
                               @role('genel mudur|konfeksiyon plan|planlama|admin|sevkiyat') <a class="dropdown-item" href="{{route('iplikreport')}}">İplik Depo</a>  @endrole
                               @role('genel mudur|konfeksiyon plan|planlama|admin|sevkiyat') <a class="dropdown-item" href="{{route('iplikreport2')}}">İplik Depo(Detay)</a>  @endrole
                               @role('genel mudur|planlama|admin|sevkiyat|muhasebe') <a class="dropdown-item" href="{{route('iplikirsaliye.index')}}">İplik İrsaliye</a>@endrole  
                               @role('genel mudur|konfeksiyon plan|planlama|admin|sevkiyat') <a class="dropdown-item" href="{{route('leventhareket.index')}}">Levent Hareket</a>@endrole  
                               @role('genel mudur|konfeksiyon plan|planlama|admin|sevkiyat') <a class="dropdown-item" href="{{route('leventdepo')}}">Levent Depo</a>@endrole  
                               @role('genel mudur|konfeksiyon plan|planlama|kalite kontrol|sevkiyat|admin') <a class="dropdown-item" href="{{route('ball_list')}}">Kumaş Depo</a>@endrole  
                               @role('genel mudur|konfeksiyon plan|planlama|kalite kontrol|sevkiyat|admin') <a class="dropdown-item" href="{{route('shipball_list')}}">Sevk Olan Kumaşlar</a>@endrole 
                               @role('genel mudur|konfeksiyon plan|planlama|sevkiyat|admin') <a class="dropdown-item" href="{{route('uretilentop_list')}}">Dokumadan Kesilen Toplar</a>@endrole  
                               @role('genel mudur|planlama|admin|sevkiyat') <a class="dropdown-item" href="{{route('demandindex')}}">Top Aktarma(Sipariş Bölme)</a>@endrole  
                               @role('genel mudur|planlama|admin|sevkiyat') <a class="dropdown-item" href="{{route('split')}}">Top Bölme(Top Parçala)</a>@endrole  
                               @role('genel mudur|konfeksiyon plan|planlama|sevkiyat|admin')<a class="dropdown-item" href="{{route('kkform.index')}}">Ham KK Form</a> @endrole 
                               @role('genel mudur|konfeksiyon plan|planlama|sevkiyat|admin')<a class="dropdown-item" href="{{route('sevkham.index')}}">Kumaş Sevkiyat</a> @endrole 
                               @role('genel mudur|konfeksiyon plan|planlama|sevkiyat|admin')<a class="dropdown-item" href="{{route('mamulkkform.index')}}">Mamul KK Form</a> @endrole 
                               @role('genel mudur|konfeksiyon plan|planlama|sevkiyat|admin')<a class="dropdown-item" href="{{route('sevkmamul.index')}}">Mamul Sevk</a> @endrole 
                               @role('genel mudur|planlama|admin|uretim|sevkiyat|uretimgenel')<a class="dropdown-item" href="{{route('uretimtakip.index')}}">Üretim Takip</a> @endrole 
                               @role('admin|planlama|genel mudur|uretimgenel')<a class="dropdown-item" href="{{route('machinebarcode')}}">Makina Etiketi Çıkartma</a> @endrole 
                               @role('admin|genel mudur|uretim|planlama|kalite kontrol|uretimgenel')<a class="dropdown-item" href="{{route('uretimtakip.create')}}">Top Kesim Ekranı</a> @endrole 
                               @role('genel mudur|planlama|admin|kalite kontrol|uretimgenel')<a class="dropdown-item" href="{{route('kkformtop')}}">Kalite Kontrol Kabul</a> @endrole 
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>Tanımlar</a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                               @role('genel mudur|konfeksiyon plan|planlama|admin|desen') <a class="dropdown-item"  href="{{route('desen.index')}}">Desen</a> @endrole
                               @role('genel mudur|planlama|admin|desen') <a class="dropdown-item" href="{{ route('makinacins.index') }}">Makina Cins</a>@endrole
                               @role('genel mudur|planlama|admin|desen') <a class="dropdown-item" href="{{ route('iplikcins.index') }}">İplik Cins</a>@endrole
                               @role('genel mudur|planlama|admin|desen') <a class="dropdown-item" href="{{ route('boyacins.index') }}">İplik Boya Cins</a>@endrole
                               @role('genel mudur|planlama|admin') <a class="dropdown-item" href="{{ route('surecislemi.index') }}">Süreç İşlemi</a>@endrole
                               @role('genel mudur|planlama|admin') <a class="dropdown-item" href="{{ route('terbiyesureci.index') }}">Terbiye Süreci</a>@endrole
                               @role('genel mudur|planlama|admin|desen') <a class="dropdown-item" href="{{ route('ebatcins.index') }}">Ebat Cins</a>@endrole
                               @role('genel mudur|planlama|admin|desen') <a class="dropdown-item" href="{{ route('kenartipi.index') }}">Kenar Tipi</a>@endrole
                               @role('genel mudur|planlama|admin')<a class="dropdown-item" href="{{ route('kalitedetay.index') }}">Kalite Detay</a>@endrole
                               @role('genel mudur|planlama|admin') <a class="dropdown-item" href="{{ route('hatalist.index') }}">Hata Listesi</a>@endrole
                               @role('genel mudur|planlama|admin') <a class="dropdown-item" href="{{ route('sipsozmad.index') }}">Sipariş Sözleşmesi Maddeleri</a>@endrole
                               @role('genel mudur|planlama|admin|muhasebe') <a class="dropdown-item" href="{{ route('gorevlistesi.index') }}">Görev Listesi</a>@endrole
                               @role('genel mudur|planlama|admin|muhasebe') <a class="dropdown-item" href="{{route('departman.index')}}">Departman</a>@endrole
                               @role('genel mudur|planlama|admin|muhasebe') <a class="dropdown-item" href="{{route('firmatipi.index')}}">Firmatipi</a>@endrole
                               @role('genel mudur|planlama|admin|muhasebe') <a class="dropdown-item" href="{{route('firma.index')}}">Firma</a>@endrole
                               @role('genel mudur|planlama|admin|muhasebe') <a class="dropdown-item" href="{{route('tesis.index')}}">Tesis</a>@endrole
                               @role('genel mudur|planlama|admin|muhasebe') <a class="dropdown-item" href="{{route('yetkili.index')}}">Yetkili</a>@endrole
                               @role('genel mudur|planlama|admin|muhasebe') <a class="dropdown-item" href="{{route('control.index')}}">Perkotek</a>@endrole
                            </div>
                        </li>
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                {{ Auth::user()->name.' '.Auth::user()->surname }} <span class="caret"></span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                @role('genel mudur|admin|muhasebe')<a class="dropdown-item" href="{{ route('usercreate') }}">Kullanıcı Kayıt</a>@endrole
                                <a class="dropdown-item" href="{{ route('password.changee') }}">Parola Güncelleme</a>
                                 @role('genel mudur|admin|muhasebe')<a class="dropdown-item" href="{{route('personel.index')}}">Personel</a>@endrole
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                                {{ __('Oturumu Kapat') }}
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>
    <main> <!--class="py-4" -->
        @yield('content')
    </main>
</div>
</body>

@yield('js')
</html>
