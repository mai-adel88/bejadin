{!! Form::open(array('url' => 'admin/trialbalance/pdf2', 'method' => 'POST', 'target' => '_blank')) !!}


{{Form::hidden('fromtree', $fromtree)}}
{{Form::hidden('totree', $totree)}}
{{Form::hidden('from', $from)}}
{{Form::hidden('to', $to)}}
{{Form::hidden('kind', $kind)}}
{{Form::hidden('operations', $operations)}}

{{ Form::submit(trans('admin.Print_PDF'), array('class' => 'btn btn-primary', 'style' => 'margin-right: 10px;')) }}


{!! Form::close() !!}



