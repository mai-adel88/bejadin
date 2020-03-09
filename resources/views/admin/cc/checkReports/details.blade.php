{!! Form::open(array('url' => 'admin/cc/report/checkReports/pdf', 'method' => 'POST', 'target' => '_blank')) !!}


@if(!empty($fromtree) && !empty($totree))
    {{Form::hidden('fromtree', $fromtree)}}
    {{Form::hidden('totree', $totree)}}
    {{Form::hidden('from', $from)}}
    {{Form::hidden('to', $to)}}
@endif
@if(!empty($level))
{{Form::hidden('level', $level)}}
@endif
{{ Form::submit('Print PDF', array('class' => 'btn btn-primary', 'style' => 'margin-right: 10px;')) }}

{!! Form::close() !!}