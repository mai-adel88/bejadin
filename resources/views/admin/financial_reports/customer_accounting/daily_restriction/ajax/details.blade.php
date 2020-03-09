{!! Form::open(array('route' => 'cust_daily_restriction.print', 'method' => 'POST', 'target' => '_blank')) !!}
{{Form::hidden('MainCompany',$MainCompany)}}
{{Form::hidden('type',$type)}}
{{Form::hidden('date_limition',$date_limition)}}
{{Form::hidden('fromDate',$fromDate)}}
{{Form::hidden('toDate',$toDate)}}


{{ Form::submit(trans('admin.Print_PDF'), array('class' => 'btn btn-primary')) }}

{!! Form::close() !!}

