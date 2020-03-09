@extends('web.index')
@section('title')
    الرئيسية
@endsection

@section('content')

    <header class="container-fluid" style="background-color: #f3f3f5;">
        <div class="container">
            <div class="row">
                <div class="dashboard_logo">
                    <div class="dashboard_logo_in">
                        <img class="img-fluid" src="{{asset('public/images/logo2.png')}}" alt="">
                    </div>
                </div>
                <div class="w-100 d-flex flex-wrap justify-content-center pb-5 text-center">
                    <div class="col-md-6 col-lg-4 float-right mt-4 dashboard_all">
                        <a href="{{route('admin.login', ['id' =>1])}}">
                            <div class="dashboard dashboard_maintenance" style="box-shadow: 0px 5px 7px 0px #000;">
                                <div class="dashboard_overlay"></div>
                                <h3>مقاولات صيانة وتشغيل وزارة الاعلام</h3>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-6 col-lg-4 float-right mt-4 dashboard_all">
                        <a href="{{route('hrLogin')}}">
                            <div class="dashboard dashboard_construction" style="box-shadow: 0px 5px 7px 0px #000;">
                                <div class="dashboard_overlay"></div>
                                <h3>Hr System</h3>
                            </div>
                        </a>
                    </div>

                    {{--                    <div class="col-md-6 col-lg-4 float-right mt-4 dashboard_all">--}}
                    {{--                    <a href="{{route('admin.login', ['id' => 3 ])}}">--}}

                    {{--                            <div class="dashboard dashboard_umrah " style="box-shadow: 0px 5px 7px 0px #000;">--}}
                    {{--                                <div class="dashboard_overlay"></div>--}}
                    {{--                                <h3>مشروع اعمال متفرعه بالقوي البحرية -بجذان</h3>--}}
                    {{--                            </div>--}}
                    {{--                        </a>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="col-md-6 col-lg-4 float-right mt-4 dashboard_all">--}}
                    {{--                      <a href="{{route('admin.login', ['id' => 4])}}">--}}

                    {{--                            <div class="dashboard dashboard_subsistence" style="box-shadow: 0px 5px 7px 0px #000;">--}}
                    {{--                                <div class="dashboard_overlay"></div>--}}
                    {{--                                <h3>مشروع الملك عبد الله لتطوير صناعه بجذان</h3>--}}
                    {{--                            </div>--}}
                    {{--                        </a>--}}
                    {{--                    </div>--}}

                    {{--                    <div class="col-md-6 col-lg-4 float-right mt-4 dashboard_all">--}}
                    {{--                        <a href="{{route('admin.login', ['id' => 5])}}">--}}

                    {{--                        <div class="dashboard dashboard_telecommunications" style="box-shadow: 0px 5px 7px 0px #000;">--}}
                    {{--                                <div class="dashboard_overlay"></div>--}}
                    {{--                                <h3>مشروع معالجه التلوث البصري بجده</h3>--}}
                    {{--                            </div>--}}
                    {{--                        </a>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="col-md-6 col-lg-4 float-right mt-4 dashboard_all">--}}
                    {{--                        <a href="#">--}}
                    {{--                            <div class="dashboard dashboard_supply" style="box-shadow: 0px 5px 7px 0px #000;">--}}
                    {{--                                <div class="dashboard_overlay"></div>--}}
                    {{--                                <h3>التموين والتوزيع</h3>--}}
                    {{--                            </div>--}}
                    {{--                        </a>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="col-md-6 col-lg-4 float-right mt-4 dashboard_all">--}}
                    {{--                        <a href="#">--}}
                    {{--                            <div class="dashboard dashboard_tourism" style="box-shadow: 0px 5px 7px 0px #000;">--}}
                    {{--                                <div class="dashboard_overlay"></div>--}}
                    {{--                                <h3>السياحة</h3>--}}
                    {{--                            </div>--}}
                    {{--                        </a>--}}
                    {{--                    </div>--}}
                    {{--                    <div class="col-md-6 col-lg-4 float-right mt-4 dashboard_all">--}}
                    {{--                        <a href="#">--}}
                    {{--                            <div class="dashboard dashboard_energy" style="box-shadow: 0px 5px 7px 0px #000;">--}}
                    {{--                                <div class="dashboard_overlay"></div>--}}
                    {{--                                <h3><a href="#">الطاقة المتجددة</h3>--}}
                    {{--                            </div>--}}
                    {{--                        </a>--}}
                    {{--                    </div>--}}
                </div>
            </div>
        </div>
    </header>


@endsection
