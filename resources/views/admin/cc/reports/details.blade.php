{!! Form::open(array('url' => 'admin/departments/reports/pdf', 'method' => 'POST', 'target' => '_blank')) !!}
@if(!empty($type))
{{Form::hidden('type', $type)}}
@endif
@if(!empty($typeRange))
{{Form::hidden('typeRange', $typeRange)}}
@endif
@if(!empty($search))
    {{Form::hidden('search', $search)}}
@endif
{{ Form::submit(trans('admin.Print_PDF'), array('class' => 'btn btn-primary', 'style' => 'margin-right: 10px;')) }}


{!! Form::close() !!}

