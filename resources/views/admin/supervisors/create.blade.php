@extends('admin.index')
@inject('branches', 'App\Models\Admin\MainBranch')
@inject('supervisors', 'App\Models\Admin\AstMarket)
@inject('companies', 'App\Models\Admin\MainCompany')


@section('title',trans('admin.create_new_supervisor'))
@section('content')
    @push('js')
        <script>

        $(document).ready(function(){

            $('#type').select2({
                    placeholder: "Select a State",
                    allowClear: true,
                    dir : '{{direction()}}'
                });

            $('#departments a').click(function (e) {
              e.preventDefault()
              $(this).tab('show')
            });

             $("#countries").change(function(){
                //get governorates
                var country_id = $(this).val();

                 if(country_id){
                        $.ajax({
                        url : "{{route('getCities')}}",
                        type : 'get',
                        dataType:'html',
                        data:{country_id:country_id},
                        success : function(res){
                            $('#cities').html(res)
                        }
                    })
                 }


            });

         // $(document).on('change', "#cities", function(){
         //    alert($(this).val())
         // })

         // $("#cities").change(function(){
         //    alert($(this).val())
         // })

            $('#companies').change(function(){
                var Cmp_No = $(this).val();

                if(Cmp_No){
                    $.ajax({
                        url : "{{route('getBranch')}}",
                        type : 'get',
                        dataType:'html',
                        data:{Cmp_No:Cmp_No},
                        success : function(res){
                            $('#branches').html(res)
                            $('#stores').html(res)
                        }
                    })
                }


            });




        })


        </script>

    @endpush

    @push('css')
    <style>
        @if(session('lang') == 'ar')
            .datepicker{
            direction: rtl;
        }
        @endif
    </style>
    @endpush
    @include('admin.layouts.message')

  {{Form::open(['route'=>'supervisors.store','class'=>'form-group','files'=>true])}}
  <button class="btn btn-primary" style="float: left;"><i class="fa fa-save"></i></button>
    <div class="panel panel-default">
            <div class="panel-heading">
                <h5>{{trans('admin.create_new_supervisor')}}</h5>
            </div>
            <div class="panel-body">
                @can('single')

                    <div class="form-group col-md-8">
                        <div class="form-group row col-md-12">
                            <div class="col-md-9">
                                <div class="col-md-4">{!!Form::label('Mrkt_No', trans('admin.Mrkt_No'))!!}</div>
                                <div class="col-md-8">{!!Form::text('Mrkt_No', $last, ['class'=>'form-control', 'readonly'=>'true'])!!}</div>

                            </div>
                            <div class="col-md-3">
                                {!! Form::label('Mrkt_Active', trans('admin.active')) !!}
                                {!! Form::checkbox('Mrkt_Active') !!}
                            </div>
                        </div>
                        <div class="form-group row col-md-12">
                            <div class="col-md-3">{!!Form::label('Cmp_No', trans('admin.Cmp_No'))!!}</div>
                            <div class="col-md-9">
                                {!!Form::select('Cmp_No' ,$companies->pluck('Cmp_Nm'.ucfirst(session('lang')),'ID_No')->toArray(),null,[
                                    'class'=>'form-control', 'id'=>'companies','placeholder'=>trans('admin.select')
                                ])!!}
                            </div>
                        </div>
                        <div class="form-group row col-md-12">
                            <div class="col-md-3">{!!Form::label('Brn_No', trans('admin.branche'))!!}</div>
                            <div class="col-md-9">
                                <select class="form-control" name="Brn_No" id="branches">
                                    <option>{{trans('admin.select')}}</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row col-md-12">
                            <div class="col-md-3">{!!Form::label('Mrkt_NmAr', trans('admin.subscriber_name_ar'))!!}</div>
                            <div class="col-md-9">{!!Form::text('Mrkt_NmAr', null, ['class'=>'form-control'])!!}</div>
                        </div>
                        <div class="form-group row col-md-12">
                            <div class="col-md-3">{!!Form::label('Mrkt_NmEn', trans('admin.subscriber_name_en'))!!}</div>
                            <div class="col-md-9">{!!Form::text('Mrkt_NmEn', null, ['class'=>'form-control'])!!}</div>
                        </div>

                        <div class="card-footer">
                            <button type="submit" class="btn btn-primary">{{trans('admin.add')}}</button>
                        </div>
                    </div>

                    <div class="col-md-6">


                        @else
                            <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

                        @endcan
                    </div>


                    {{ Form::close() }}

            </div>
        </div>

@endsection
