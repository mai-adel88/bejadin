@if($status == 0)
{!! Form::model($status,['method'=>'PUT','route' => ['supervisors.status',$id]]) !!}
{{Form::hidden('status',$status)}}
{{Form::submit('active',['class'=>'btn btn-info'])}}
{!! Form::close() !!}
    @else
    {!! Form::model($status,['method'=>'PUT','route' => ['supervisors.status',$id]]) !!}
    {{Form::hidden('status',$status)}}
    {{Form::submit('deactive',['class'=>'btn btn-danger'])}}
    {!! Form::close() !!}

@endif
