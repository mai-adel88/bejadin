
@extends('hr.index')
@section('title', trans('hr.department_create'))
@section('root_link', route('hrcountries.index'))
@section('root_name', trans('hr.departments'))
@section('content')
    @can('create')
        @push('css')
        @endpush
        @push('js')
        
        <script>
         $(document).ready(function () {

            $('.select2').select2({
                dir: "{{direction()}}",
                width: "100%"
            });
         });
        $(".Cmp_No").change(function () {
                $.ajax({
                    url : "{{route('createdepNo')}}",
                    type : 'get',
                    dataType:'json',
                    data: {"_token": "{{ csrf_token() }}", Cmp_No: $(this).val() },
                    success : function(data){
                        // alert();
                        $('.Depm_Main').val(data)
                    }
                });
            });
        </script>
        @endpush
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">{{trans('hr.department_create')}}</h3>
            </div>
            <div class="box-body">
                @include('hr.layouts.message')
                {{ Form::open(['method'=>'post', 'route' => 'hrdepartments.store']) }}

                {{--tap container--}}
                <div class="tab-content" id="myTabContent1">
                    {{--First tap--}}
                    <div class="tab-pane fade show active in" id="basic_information" role="tabpanel" aria-labelledby="home-tab">
                        <div class="panel panel-default">
                            <div class="panel-body">
                                
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <select name="Cmp_No" class="Cmp_No select2 form-control">
                                            <option value="" disabled selected>{{trans('admin.select')}}</option>
                                            @foreach($companies as $mainCompany)
                                                <option value="{{$mainCompany->Cmp_No}}">{{$mainCompany->{'Cmp_Nm'.ucfirst(session('lang'))} }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <input type="text" readonly name="Depm_Main" class="form-control text-center Depm_Main" id="Depm_Main" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{Form::text('Depm_NmAr', '',['class' => 'form-control Depm_NmAr', 'placeholder'=>trans('hr.departmrnt_name_ar')])}}
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        {{Form::text('Depm_NmEn', '',['class' => 'form-control Depm_NmEn', 'placeholder' => trans('hr.departmrnt_name_en')])}}
                                    </div>
                                </div>

                                

                            </div>
                        </div>
                    </div>
                    {{--Second tap--}}
                </div>
                {{Form::submit(trans('hr.save'), ['class'=>'btn btn-info btn-block'])}}
                {{Form::close()}}
            </div>
        </div>
    @endcan
@endsection
