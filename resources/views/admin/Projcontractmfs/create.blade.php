@extends('admin.index')
@section('title',trans('admin.projects_contracts'))
@section('content')

    @push('js')
        <script>

            $('.datepicker').datepicker({
                format: 'yyyy-mm-dd',
                rtl: true,
                language: '{{session('lang')}}',
                inline:true,
                minDate: 0,
                autoclose:true,
                minDateTime: dateToday

            });


            $('#myTabs a').click(function (e) {
                e.preventDefault()
                $(this).tab('show')
            })
        </script>
    @endpush

    @push('css')
        <style>
            fieldset {
                display: block;
                margin-left: 2px;
                margin-right: 2px;
                padding-top: 0.35em;
                padding-bottom: 0.625em;
                padding-left: 0.75em;
                padding-right: 0.75em;
                border: 2px solid #ccc;
            }
            legend{
                display: block;
                padding: 0;
                margin-bottom: 20px;
                font-size: 18px;
                line-height: inherit;
                color: #333;
                width: 152px;
                border-bottom: none;
            }
        </style>
    @endpush
@hasrole('writer')
@can('create')
    <div class="box">
        @include('admin.layouts.message')
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>

        <div class="box-body">
            {!! Form::open(['method'=>'POST','route' => 'project_contract.store']) !!}
            {{ Form::button('<i class="fa fa-save"></i>', ['type' => 'submit', 'class' => 'btn btn-primary','style' => 'float:left;display:inline-block'] )  }}

            <br>
            <br>
            @include('admin.Projcontractmfs.form')

            @endcan
        @else
            <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>
            @endhasrole
    </div>
    </div>


@endsection
