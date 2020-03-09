@extends('admin.index')
@section('title', trans('admin.sales_invoices'))

@section('content')
    @push('css')
        <style>
            .bg-warning {
                background-color: #ffc107!important;

            }
        </style>
    @endpush
    <div class="panel panel-default">
        <div class="panel-body bg-gray">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="{{route('salesInvoices.index')}}">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="fa fa-calculator"></i></span>
                            <div class="info-box-content">
                                <h2 class="info-box-text">{{trans('admin.sales_invoices')}}</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="#">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="fa fa-calculator"></i></span>
                            <div class="info-box-content">
                                <h2 class="info-box-text">مرتجع المبيعات </h2>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <a href="#">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="fa fa-calculator"></i></span>
                            <div class="info-box-content">
                                <h2 class="info-box-text">عروض الاسعار للعملاء</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="#">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="fa fa-calculator"></i></span>
                            <div class="info-box-content">
                                <h2 class="info-box-text">طلبية العملاء</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="#">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="fa fa-calculator"></i></span>
                            <div class="info-box-content">
                                <h2 class="info-box-text">يومية المبيعات بالفروع</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="#">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="fa fa-calculator"></i></span>
                            <div class="info-box-content">
                                <h2 class="info-box-text">حركة المبيعات بالاصناف</h2>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
