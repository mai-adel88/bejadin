@extends('admin.index')
@section('title',trans('admin.AddClassification_suppliers'))
@section('content')

    @push('js')
        <script>
            $('#myTabs a').click(function (e) {
                e.preventDefault()
                $(this).tab('show')
            })
        </script>
    @endpush
@hasrole('writer')
@can('create')
    <div class="box">
        @include('admin.layouts.message')
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>

        <div class="box-body">
            {!! Form::open(['method'=>'POST','route' => 'astsupctg.store']) !!}
            {{ Form::button('<i class="fa fa-save"></i>', ['type' => 'submit', 'class' => 'btn btn-primary','style' => 'float:left;display:inline-block'] )  }}


<br>
<br>
                                <div class="form-group row">
                                    <div class="col-md-6">
                                        {!!Form::label('Supctg_Nmar', trans('admin.Supctg_Nmar'))!!}
                                        {!!Form::text('Supctg_Nmar', null, ['class'=>'form-control'])!!}
                                    </div>

                                    <div class="col-md-6">
                                        {!!Form::label('Supctg_Nmen', trans('admin.Supctg_Nmen'))!!}
                                        {!!Form::text('Supctg_Nmen', null, ['class'=>'form-control'])!!}
                                    </div>
                                </div>




                    {!! Form::close() !!}
        @endcan
        @else
            <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>
            @endhasrole
    </div>


@endsection
