@extends('admin.index')
@section('title', 'فاتورة المشتريات')

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
                    <a href="{{ route('purchasesInvoices.index') }}">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="fa fa-calculator"></i></span>
                            <div class="info-box-content">
                                <h2 class="info-box-text">فاتورة المشتريات</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="#">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="fa fa-calculator"></i></span>
                            <div class="info-box-content">
                                <h2 class="info-box-text">مرتجع المشتريات </h2>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <a href="#">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="fa fa-calculator"></i></span>
                            <div class="info-box-content">
                                <h2 class="info-box-text">أمر شراء من الموردين</h2>
                            </div>
                        </div>
                    </a>
                </div>
                <div class="col-md-3 col-sm-6 col-12">
                    <a href="#">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="fa fa-calculator"></i></span>
                            <div class="info-box-content">
                                <h2 class="info-box-text">تقارير يومية المشتريات</h2>
                            </div>
                        </div>
                    </a>
                </div>

                <div class="col-md-3 col-sm-6 col-12">
                    <a href="#">
                        <div class="info-box">
                            <span class="info-box-icon bg-warning"><i class="fa fa-calculator"></i></span>
                            <div class="info-box-content">
                                <h2 class="info-box-text">حركة المشتريات بالاصناف</h2>
                            </div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>



@endsection
