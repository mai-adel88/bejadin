@extends('hr.index')

{{--@inject('employee','App\Models\Hr\HREmpadr')--}}

@section('root_name', trans('hr.title'))
@section('content')
    @push('css')
        <style>
            .p-0{ padding:0px; }
        </style>

    @endpush
    @push('js')
        <script>
            $(document).ready(function () {

                // get employees for company
                $(".Cmp_No").change(function () {
                    $.ajax({
                        url: "{{route('get-employees')}}",
                        type: 'get',
                        dataType: 'html',
                        data: {"_token": "{{ csrf_token() }}", Cmp_No: $(this).val()}, //why csrf_token?????
                        success: function (data) {
                            // alert('ss');
                            $('.Emp_No').html(data)
                        }
                    });
                });

                //get employee data if he exists
                $(".Emp_No").change(function () {
                    $.ajax({
                        url: "{{route('get-employee-data')}}",
                        type: 'get',
                        dataType: 'html',
                        data: {"_token": "{{ csrf_token() }}", Emp_No: $(this).val()},
                        success: function (data) {
               //             alert('ss');
                            $('.employee-data').html(data)
                        }
                    });
                });
            });
        </script>

    @endpush
    <div class="box">
        <div class="box-header">
        </div>
        <div class="box-body">
            @include('hr.layouts.message')
            {!!Form::open(['method'=>'POST','route' => 'address.store','files'=> true]) !!}
            @include('hr.settings.addresses.form')
        </div> {{--end of  box-body --}}
    </div> {{--end of div box--}}
@endsection