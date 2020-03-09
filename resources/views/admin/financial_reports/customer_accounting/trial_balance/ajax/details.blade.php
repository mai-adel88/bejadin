{!! Form::open(array('route' => 'print_trial_balance', 'method' => 'POST', 'target' => '_blank')) !!}


{{Form::hidden('MainCompany', $MainCompany)}}

@if(!empty($but_sales_check))
    {{Form::hidden('but_sales_check', $but_sales_check)}}
@endif

    {{Form::hidden('sales_check', $sales_check)}}


{{Form::hidden('fromtree', $fromtree)}}
{{Form::hidden('numberfromtree', $numberfromtree)}}
{{Form::hidden('totree', $totree)}}
{{Form::hidden('numbertotree', $numbertotree)}}
{{Form::hidden('From',$From)}}
{{Form::hidden('to', $to)}}

{{Form::hidden('radioDepartment', $radioDepartment)}}

@if(!empty($delegates))
    {{Form::hidden('delegates', $delegates)}}
@endif
@if(!empty($mtscustomer))
    {{Form::hidden('mtscustomer', $mtscustomer)}}
@endif


{{ Form::submit(trans('admin.Print_PDF'), array('class' => 'btn btn-primary', 'style' => 'margin-right: 10px;')) }}


{!! Form::close() !!}



