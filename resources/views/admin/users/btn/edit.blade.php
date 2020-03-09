@hasrole('writer')
@if($status == 0)
{!! Form::open(['method'=>'PUT','route' => ['users.update',$id]]) !!}
{{Form::hidden('status',$status)}}
{{Form::submit(trans('admin.active'),['class'=>'btn btn-success remove-record'])}}
{!! Form::close() !!}
    @else
    {!! Form::open(['method'=>'PUT','route' => ['users.update',$id]]) !!}
    {{Form::hidden('status',$status)}}
    {{Form::submit(trans('admin.deactive'),['class'=>'btn btn-danger remove-record'])}}
    {!! Form::close() !!}

@endif
@else
    <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

@endhasrole