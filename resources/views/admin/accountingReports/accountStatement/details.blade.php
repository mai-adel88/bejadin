@if($hasTask || $hasTask2)
    {!! Form::open(array('url' => 'admin/accountStatement/pdf', 'method' => 'POST', 'target' => '_blank')) !!}
    {{Form::hidden('operations',$operations)}}
    {{Form::hidden('branches',$branches)}}
    {{Form::hidden('from',$from)}}
    {{Form::hidden('from',$from)}}
    {{Form::hidden('fromtree',$fromtree)}}
    {{Form::hidden('to',$to)}}
    {{Form::hidden('totree',$totree)}}

    {{ Form::submit(trans('admin.Print_PDF'), array('class' => 'btn btn-primary', 'style' => 'margin-right: 10px;')) }}

    {!! Form::close() !!}


@else
    <div class="alert alert-danger">{{trans('admin.no_account_between_this_date')}}</div>
@endif
