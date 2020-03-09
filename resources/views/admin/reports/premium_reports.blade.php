@extends('admin.index')
@section('title',trans('admin.Premium_reports_Subscribers'))
@section('content')
    @push('js')

        <script>


            function printPageArea(areaID){
                var divElements = document.getElementById('invoice').innerHTML;
                //Get the HTML of whole page
                var oldPage = document.body.innerHTML;

                //Reset the page's HTML with div's HTML only
                document.body.innerHTML =
                    "<html><head><title></title></head><body>" +
                    divElements + "</body>";

                //Print Page
                window.print();
                window.location.reload(true);
                //Restore orignal HTML
                document.body.innerHTML = oldPage;
            }

        </script>
    @endpush
    @push('css')
        <style>
            @media print {
                a[href]:after {
                    content: " (" attr(href) ")";
                }
            }
        </style>

        @endpush
    <div class="box" id="invoice">
        <div class="box-header">
            <h3 class="box-title">{{trans('admin.Premium_reports_Subscribers')}}</h3>
        </div>
    @include('admin.layouts.message')
    <!-- /.box-header -->
        @foreach ($data as $key => $carts)

            <div class="text-center" style="font-size:24px">{{getsubscriper($key)->name_ar}}</div>
            <div class="box-body">
            <table class="table table-bordered table-striped table-hover">
                <tr>
                    <th>{{trans('admin.depart')}}</th>
                    <th>{{trans('admin.desname')}}</th>
                    <th>{{trans('admin.From')}}</th>
                    <th>{{trans('admin.to')}}</th>
                    <th>{{trans('admin.amount')}}</th>
                    <th>{{trans('admin.amount_paid')}}</th>
                    <th>{{trans('admin.rest')}}</th>
                </tr>

            @foreach ($carts as $cart)
                @if($cart->subtransports['price'] != $cart->payment)
                    <tr>
                        <td><a class="hide-for-print" href="{{url('admin/cart/'.$cart->subtransports->id)}}">{{state($cart->subtransports->depart_id)->state_name_ar}}</a> </td>
                        <td><a class="hide-for-print" href="{{url('admin/cart/'.$cart->subtransports->id)}}">{{state($cart->subtransports->desname_id)->state_name_ar}}</a></td>
                        <td>{{date('d-m-Y', strtotime($cart->subtransports->start))}}</td>
                        <td>{{date('d-m-Y', strtotime($cart->subtransports->end))}}</td>
                        <td>{{$cart->subtransports->price}}</td>
                        <td>{{$cart->payment}}</td>
                        <td><a class="hide-for-print" href="{{url('admin/cart/'.$cart->subtransports->id)}}">{{$cart->subtransports->price - $cart->payment}}</a></td>
                    </tr>
                @endif
            @endforeach
            </table>
            @endforeach
                <br>
                <br>

        </div>
    </div>
    <button class="btn btn-default" onclick="printPageArea()" id="primaryButton"><i class="fa fa-print"></i> {{trans('admin.print')}} </button>
    <!-- /.box-body -->
















@endsection