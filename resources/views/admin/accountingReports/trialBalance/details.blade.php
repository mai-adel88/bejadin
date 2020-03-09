{!! Form::open(array('url' => 'admin/trialbalance/pdf', 'method' => 'POST', 'target' => '_blank')) !!}


    {{Form::hidden('fromtree', $fromtree)}}
    {{Form::hidden('totree', $totree)}}
    {{Form::hidden('from', $from)}}
    {{Form::hidden('to', $to)}}
    {{Form::hidden('kind', $kind)}}

@if(!empty($level))
    {{Form::hidden('level', $level)}}
@endif
{{ Form::submit(trans('admin.Print_PDF'), array('class' => 'btn btn-primary', 'style' => 'margin-right: 10px;')) }}


{!! Form::close() !!}



