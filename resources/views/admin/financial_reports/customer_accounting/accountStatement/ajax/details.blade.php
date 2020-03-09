
{!! Form::open(array('route' => 'accountStatementCust.acc_pdf', 'method' => 'POST', 'target' => '_blank')) !!}
{{Form::hidden('maincompany',$maincompany)}}
@if($fromtree != null && $totree != null )
{{Form::hidden('fromtree',$fromtree)}}
{{Form::hidden('totree',$totree)}}
@else
    {{Form::hidden('fromtree',$acc_fromtree)}}
    {{Form::hidden('totree',$acc_totree)}}
    @endif
{{Form::hidden('from',$from)}}
{{Form::hidden('to',$to)}}


{{ Form::submit(trans('admin.Print_PDF'), array('class' => 'btn btn-primary', 'style' => 'margin: 19px 81px -32px 0px')) }}

{!! Form::close() !!}

