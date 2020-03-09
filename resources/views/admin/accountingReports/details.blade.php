@if($hasTask)
{!! Form::open(array('url' => 'admin/dailyReport/pdf', 'method' => 'POST', 'target' => '_blank')) !!}
    {{Form::hidden('operations',$operations)}}
    {{Form::hidden('branches',$branches)}}
    {{Form::hidden('type',$type)}}
    {{Form::hidden('kind',$kind)}}
    {{Form::hidden('from',$from)}}
    {{Form::hidden('to',$to)}}

    {{ Form::submit(trans('admin.Print_PDF'), array('class' => 'btn btn-primary', 'style' => 'margin-right: 10px;')) }}

{!! Form::close() !!}

    @else
    <div class="alert alert-danger">{{trans('admin.no_account_between_this_date')}}</div>
@endif
