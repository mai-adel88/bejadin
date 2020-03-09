@extends('web.index')
@section('title')
    عن الشركة
@endsection

@section('content')
    <section class="container-fluid" style="background:#00a8ff;color: white">
        <div class="container">
            <div class="text-center d-flex justify-content-center align-items-center" style="height:254px;">
                <div>
                    <h2 style="margin-bottom: 30px;">قصة الشحرى</h2>
                    <h4>لا أحد يحب الألم بذاته، يسعى ورائه أو يبتغيه، ببساطة لأنه الألم...</h4>
                </div>
            </div>
        </div>
    </section>
    <section class="container-fluid">
        <div class="container">
            <div class="text-justify d-flex justify-content-center align-items-center col-xl-8 col-lg-9 m-auto position-relative arrow-bottom-section" style="min-height:316px;">
                <div>
                    <p>
                        هنالك العديد من الأنواع المتوفرة لنصوص لوريم إيبسوم، ولكن الغالبية تم تعديلها بشكل ما عبر إدخال بعض النوادر أو الكلمات العشوائية إلى النص. إن كنت تريد أن تستخدم نص لوريم إيبسوم ما، عليك أن تتحقق أولاً أن ليس هناك أي كلمات أو عبارات محرجة أو غير لائقة مخبأة في هذا النص. بينما تعمل جميع مولّدات نصوص لوريم إيبسوم على الإنترنت على إعادة تكرار مقاطع من نص لوريم إيبسوم نفسه عدة مرات بما تتطلبه الحاجة، يقوم مولّدنا هذا باستخدام كلمات من قاموس يحوي على أكثر من 200 كلمة لا تينية، مضاف إليها مجموعة من الجمل النموذجية، لتكوين نص لوريم إيبسوم ذو شكل منطقي قريب إلى النص الحقيقي.
                    </p>
                </div>
            </div>
        </div>
    </section>
    @foreach( about() as $about )
        <section class="container-fluid about-us">
            <div class="container">
                <div class="row position-relative all-about-us" style="min-height:432px;">
                    <div class="arrow-bottom-section{{ $about->id }}" style="width: 100%;display: flex;justify-content: center;"></div>
                    <div class="col-lg-6 col-xl-6 float-right text-justify d-flex justify-content-center align-items-center about-us-word{{ $about->id }}">
                        <div>
                            <h2 style="margin-bottom: 35px">{{ $about->title }}</h2>
                            <p>{{ $about->body }}</p>
                        </div>
                    </div>
                    <div class="col-lg-6 col-xl-6 float-right text-justify d-flex justify-content-center align-items-center about-us-image">
                        <div style="max-width: 440px;">
                            <img class="img-fluid" src="{{asset('storage/'.$about->image)}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
        </section>
    @endforeach
    <section class="container-fluid background5 float-right" id="special-service">
        <div class="container text-center language-arabic text-white">
            <div  class="d-flex justify-content-center align-items-center" style="height: 463px">
                <div>
                    <div class="d-block">
                        <h2 style="font-size: 40px;">الخدمة الخاصة : استئجار حافلة مع سائق</h2>
                    </div>
                    <div class="d-block mt-5">
                        <button class="text-white border-0 pt-2 pb-2 pr-5 pl-5" style="background: #487eb0">احجز الان</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="container-fluid float-right" id="all-call-us" style="background: #ecf2f7">
        <div class="container language-arabic position-relative">
            <div class="col-md-7 float-right all-call-us">
                <div class="d-flex align-items-center" style="height: 463px;">
                    <div>
                        <div style="margin-bottom: 40px;">
                            <h6 style="color: #fbc531;">خط مساعدة دعم العملاء على مدار 24 ساعة طوال أيام الأسبوع</h6>
                        </div>
                        <div style="margin-bottom: 40px;">
                            <h2 id="call-us" class="language-english text-dark" style="font-size: 65px;">Tel. {{ setting()->phone }}</h2>
                        </div>
                        <div style="margin-bottom: 50px;">
                            <h6 class="text-dark" style="font-size: 20px;">خدمة الدعم متوفرة على مدار 24 ساعة في اليوم ، 7 أيام في الأسبوع لمساعدتك في شراء التذاكر الخاصة بك.</h6>
                        </div>
                        <div>
                            <a href="/contact"><button class="text-white border-0 pt-2 pb-2 pr-5 pl-5" style="background: #487eb0">اتصل بنا</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 float-right all-call-us">
                <div style="height: 463px;">
                    <img class="position-absolute" style="bottom: 0;left: 0;width: 100%" src="{{ url('/') }}/elshehry/images/image8.png" alt="">
                </div>
            </div>
        </div>
    </section>
    <section class="container-fluid float-right">
        <div class="container language-arabic">
            <div class="" style="height: 396px;">
                <div class="col-md-3 col-sm-12 col-md-12 col-lg-3 col-xl-3  float-right footer1" style="height: 396px;">
                    <div class="position-relative" style="height: inherit">
                        <div class="footer-transform">
                            <p class="">{{ setting()->contact_description }}</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 float-right footer2" style="height: 396px;">
                    <div class="position-relative" style="height: inherit">
                        <div class="footer-transform">
                            <div class="d-block">
                                {{ setting()->email }}<br>
                                {{ setting()->phone }}
                            </div>
                            <div class="d-block mt-4">
                                {{ setting()->addriss }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-6 col-sm-6 col-md-4 col-lg-3 col-xl-3 float-right position-relative footer3" style="height: 396px;">
                    <div class="position-relative" style="height: inherit">
                        <div class="footer-transform">
                            <ul class="list-unstyled">
                                <li><a class="footer-link" href="/">الرئيسية</a></li>
                                <li><a class="footer-link" href="/about">عن الشركة</a></li>
                                <li><a class="footer-link" href="/services">خدماتنا</a></li>
                                <li><a class="footer-link" href="/#latest-news">اخر الاخبار</a></li>
                                <li><a class="footer-link" href="#special-service">خدمة خاصة</a></li>
                                <li><a class="footer-link" href="/contact">اتصل بنا</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-md-3 col-sm-12 col-md-4 col-lg-3 col-xl-3 float-right footer4" style="height: 396px;">
                    <div class="position-relative" style="height: inherit">
                        <div class="footer-transform">
                            <div class="text-center">
                                <img class="img-fluid col-sm-7 col-7 col-md-auto" src="{{ url('/') }}/elshehry/images/sh1.png" alt="">
                            </div>
                            <div class="d-flex text-center mt-4" style="font-size: 30px;">
                                <a class="footer-link" href="{{ setting()->facebook }}"><i class="fab fa-facebook-f col-md-3"></i></a>
                                <a class="footer-link" href="{{ setting()->twitter }}"><i class="fab fa-twitter col-md-3"></i></a>
                                <a class="footer-link" href="{{ setting()->googel }}"><i class="fab fa-instagram col-md-3"></i></a>
                                <a class="footer-link" href="{{ setting()->linkedin }}"><i class="fab fa-linkedin-in col-md-3"></i></a>
                            </div>
                            <div class="text-center mt-4">
                                <h6>
                                    2002 - 2019 جميع الحقوق محفوظة لصالح شركة الاستشارية
                                </h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection