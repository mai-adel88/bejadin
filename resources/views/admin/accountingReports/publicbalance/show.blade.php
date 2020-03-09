{!! Form::open(array('url' => 'admin/publicbalance/pdf', 'method' => 'POST', 'target' => '_blank')) !!}


{{Form::hidden('from', $from)}}
{{Form::hidden('to', $to)}}
@if(!empty($department))
{{Form::hidden('department', $department)}}
@endif
@if(!empty($level))
    {{Form::hidden('level', $level)}}
@endif
{{ Form::submit(trans('admin.Print_PDF'), array('class' => 'btn btn-primary', 'style' => 'margin-right: 10px;')) }}


{!! Form::close() !!}
