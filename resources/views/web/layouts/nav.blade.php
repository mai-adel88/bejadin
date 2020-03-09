<header class="container-fluid">
    <div class="container all-info">
        <div class="position-relative info-and-nav">
            <div class="float-left col-12 text-white position-absolute info-text-font">
                <div class = "float-left location" style="margin-right: 15px;width: 325px;">
                    <i class="float-left fas fa-map-marker-alt"></i>
                    <h6 class = "location-h6 language-english float-left" style="font-size: 13px;">{{ setting()->addriss }}</h6>
                </div>
                <div class = "float-left telephone" style="margin-right: 15px;width: 120px;">
                    <i class="float-left fas fa-phone"></i>
                    <h6 class = "telephone-h6 language-english float-left" style="font-size: 13px;">{{ setting()->phone }}</h6>
                </div>
                <div class = "float-left email" style="width: 200px;">
                    <i class="float-left fas fa-envelope"></i>
                    <h6 class = "email-h6 language-english float-left" style="font-size: 13px;">{{ setting()->email }}</h6>
                </div>
            </div>
            <nav class="navbar navbar-expand-lg navbar-light bg-transparent position-relative" style="height: 110px;top: 60px;direction: ltr;padding: 0;">
                <a class="navbar-brand float-left" href="#" style="margin: 0"><img src="{{ url('/') }}/elshehry/images/sh1.png" class="logo" alt=""></a>
                <button style="height: 55px;" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class=""><i class="fas fa-bars" style="font-size: 30px"></i></span>
                </button>
                <div class="collapse navbar-collapse bg-color-nav" style="justify-content: flex-end;" id="navbarNav">
                    <ul class="navbar-nav language-arabic bg-transparent" style="direction: rtl">
                        <li class="nav-item {{ \Illuminate\Support\Facades\Request::is('/') ? "active" : "" }}">
                            <a class="nav-link padding-menu" href="/">الرئيسية<span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item {{ \Illuminate\Support\Facades\Request::is('about') ? "active" : "" }}">
                            <a class="nav-link padding-menu" href="/about">عن الشركة</a>
                        </li>
                        <li class="nav-item {{ \Illuminate\Support\Facades\Request::is('services') ? "active" : "" }}">
                            <a class="nav-link padding-menu" href="/services">خدماتنا</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link padding-menu" href="/#latest-news">اخر الاخبار</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link padding-menu" href="#special-service">خدمة خاصة</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link padding-menu" href="#all-call-us">اتصل بنا</a>
                        </li>
                        <li class="nav-item {{ \Illuminate\Support\Facades\Request::is('contact') ? "active" : "" }}">
                            <a class="nav-link padding-menu" href="/contact">تواصل معنا</a>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
    </div>
    <div class="" style="margin-top: -110px;">
        <div id="wowslider-container1" class="container-fluid">
            <div class="ws_images">
                <ul>
                    @foreach(slider() as $slider)
                    <li>
                        <!-- <img src="data1/images/background1.jpg" alt="background1" title="background1" id="wows1_0"/> -->
                        <img src="{{asset('storage/'. $slider->image)}}" alt="slide22" title="slide22" class="img-responsive img-lg" id="wows1_0"/>
                        <div class="ism-caption ism-caption-0 venom">
                            <div class="position-relative language-arabic text-white arrow-information" style="height: inherit;">
                                <div class="position-absolute arrow-information-in" style="left: 50%;top: 50%;transform: translate(-65%,-50%);">
                                    <div class="mb-3">
                                        <h2>{{ $slider->title }}</h2>
                                    </div>
                                    <div class="mb-4">
                                        <h4>{{ $slider->tag }}</h4>
                                    </div>
                                    <div>
                                        <p style="line-height: 20px;font-size: 13px;">{{ $slider->body }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="ws_bullets">
                <div>
                    @foreach( slider() as $slider)
                    <a href="#" title="background1"><span><img src="{{ url('/') . '/elshehry/data1/tooltips/' . $slider->image }}" alt="background1"/>1</span></a>
                    @endforeach
                </div>
            </div>
            <div class="ws_shadow"></div>
        </div>
    </div>
</header>