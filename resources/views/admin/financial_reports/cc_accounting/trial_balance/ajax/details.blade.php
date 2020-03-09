@if($level != null)
{!! Form::open(array('route' => 'movementTrialbalance.print', 'method' => 'POST', 'target' => '_blank')) !!}

{{Form::hidden('MainCompany', $MainCompany)}}
{{Form::hidden('level', $level)}}
{{Form::hidden('fromtree', $fromtree)}}

{{Form::hidden('from', $from)}}
{{Form::hidden('to', $to)}}
{{Form::hidden('radiodepartment', $radiodepartment)}}



{{ Form::submit(trans('admin.Print_PDF'), array('class' => 'btn btn-primary', 'style' => 'margin-right: 10px;')) }}


{!! Form::close() !!}

@endif

