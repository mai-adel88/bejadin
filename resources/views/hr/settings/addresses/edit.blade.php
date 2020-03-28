@extends('hr.index')
@section('title', trans('hr.edit_address'))
@section('root_link', route('address.index'))
@section('root_name', trans('hr.address'))

@section('content')
        @push('css')
            <style>
                .p-0{ padding:0px; }
                .mp-0{ padding:0px;margin:0; }
                .mt-15{ margin-top:15px; }
                .pt-3{ padding-top: 3px; }
                .color-red{ color:red; }
                .br-4{ border-radius: 4px;}
                /* fieldset */
                fieldset
                {
                    border: 1px solid #ddd !important;
                    margin: 0;
                    min-width: 0;
                    padding: 10px;
                    position: relative;
                    border-radius:4px;
                    background-color:#f5f5f5;
                    padding-left:10px!important;
                }

                legend
                {
                    font-size:14px;
                    font-weight:bold;
                    margin-bottom: 0px;
                    width: 100%;
                    border: 1px solid #ddd;
                    border-radius: 4px;
                    padding: 5px 5px 5px 10px;
                    background-color: #ffffff;
                }
            </style>

        @endpush
        @push('js')
            <script>

            // employees from selected company
            $(".Cmp_No").change(function () {
                    $.ajax({
                        url : "{{route('getemployees')}}",
                        type : 'get',
                        dataType:'html',
                        data: {"_token": "{{ csrf_token() }}", Cmp_No: $(this).val() },
                        success : function(data){
                            // alert();
                            $('.Emp_No').html(data);
                        }
                    });
                });
                // employees address data from selected employee
                $(document).on('change', '.Emp_No', function(){
                    // alert('hh');
                    $.ajax({
                        url : "{{route('getemployeeaddressData')}}",
                        type : 'get',
                        dataType:'html',
                        data: {"_token": "{{ csrf_token() }}", Emp_No: $(this).val() },
                        success : function(data){
                            // alert();
                            $('.empAddressData').html(data);
                        }
                    });
                });

                $('.select2').select2({
                    dir: "{{direction()}}",
                    width: "100%"
                });
        </script>

        @endpush
        <div class="box">
            <div class="box-header">
            </div>
            <div class="box-body">
                @include('hr.layouts.message')
                {!! Form::model($emp_data,['method'=>'PUT','route'=>['address.update',$emp_data->ID_No]]) !!}
                <div class="col-md-12 card text-white bg-info mb-3" style="margin-bottom: 15px;">
                    <div class="card-header">
                        {{Form::submit(trans('admin.create'),['class'=>'btn mt-15', 'style'=>'background-color: #538a9e;color:#fff;float:left;'])}}
                    </div>
                    <div class="card-body">
                        <div class="col-md-12 appendDiv" style="margin-bottom: 10px;margin-top:20px;">
                            <div class="form-group row">
                                <!-- الشركات -->
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <label class="col-md-3">{{trans('hr.company')}} <span class="color-red"> * </span> </label>
                                        <div class="col-md-9 p-0">
                                            <select name="Cmp_No" class="select2 Cmp_No form-control">
                                                <option disabled selected>{{trans('admin.select')}}</option>
                                                @foreach($companies as $mainCompany)
                                                    <option {{$emp_data->Cmp_No == $mainCompany->Cmp_No ? 'selected' : ''}} value="{{$mainCompany->Cmp_No}}">{{$mainCompany->{'Cmp_Nm'.ucfirst(session('lang'))} }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div> <!-- end of first right row col-md-5 -->
                                <!-- الموظفين -->
                                <div class="col-md-6">
                                    <div class="col-md-12">
                                        <label class="col-md-3">{{trans('hr.employee')}}<span class="color-red"> * </span></label>
                                        <div class="col-md-9 p-0">
                                            <select name="Emp_No" class="Emp_No select2 form-control">
                                                <option disabled selected>{{trans('admin.select')}}</option>
                                                @foreach($employees as $employee)
                                                <option {{$emp_data->Emp_No == $employee->Emp_No ? 'selected' : ''}} value="{{$employee->Emp_No}}">{{$employee->{'Emp_Nm'.ucfirst(session('lang'))} }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div> <!-- end of form-group row row -->
                        </div> <!-- end of col-md-12-->
                    </div>
                </div>
                
                <!-- second row -->
                @include('hr.settings.addresses.get_employee_data')
                <!-- end of second row -->

                {!! Form::close() !!}
            </div> {{--end of  box-body --}}
            <!-- last of day -->
        </div> {{--end of div box--}}
@endsection
