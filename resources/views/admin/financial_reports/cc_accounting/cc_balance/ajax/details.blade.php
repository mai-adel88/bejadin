{!! Form::open(array('route' => 'cc_balance.print', 'method' => 'POST', 'target' => '_blank')) !!}

{{Form::hidden('MainCompany', $MainCompany)}}
{{Form::hidden('level', $level)}}
{{Form::hidden('fromtree', $fromtree)}}
{{Form::hidden('totree', $totree)}}
{{Form::hidden('from', $from)}}
{{Form::hidden('to', $to)}}
{{Form::hidden('radiodepartment', $radiodepartment)}}
{{Form::hidden('but_level_check', $but_level_check)}}

{{--@if(!empty($but_level_check))--}}
{{--    {{Form::hidden('but_level_check', $but_level_check)}}--}}
{{--@endif--}}
{{--@if(!empty($radiodepartment))--}}
{{--    {{Form::hidden('radiodepartment', $radiodepartment)}}--}}
{{--@endif--}}


{{ Form::submit(trans('admin.Print_PDF'), array('class' => 'btn btn-primary', 'style' => 'margin-right: 10px;')) }}


{!! Form::close() !!}



