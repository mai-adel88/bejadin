@extends('admin.index')
@section('title',trans('admin.data_transfere'))
@section('content')
@push('js')
<script>
    $(document).ready(function(){
        $('#send').click(function(e){
            e.preventDefault();
            var select;
            if($('#cache_in').is(':checked')){
                select = $('#cache_in').val();
            }
            else if($('#cache_out').is(':checked')){
                select = $('#cache_out').val();
            }
            else if($('#daily_limitation').is(':checked')){
                select = $('#daily_limitation').val();
            }
            $.ajax({
                url: "{{route('send')}}",
                type: "POST",
                dataType: 'html',
                data: {"_token": "{{ csrf_token() }}", select: select },
                success: function(data){
                    
                }
            });
        });
    });
</script>
@endpush

<form action="{{route('send')}}" method="POST">
    {{ csrf_field() }}
    <div class="panel panel-default">
        <div class="panel-heading">
            <div class="panel-title">
                {{trans('admin.data_transfere')}}
            </div>
        </div>
        <div class="panel-body">
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                        type="radio" name='select' id='cache_in'
                        value="{{2}}">
                        <label for="">{{trans('admin.cache_in')}}</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                        type="radio" name='select' id='cache_out'
                        value="{{4}}">
                        <label for="">{{trans('admin.cache_out')}}</label>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <input class="checkbox-inline" style="margin-left:30px; width: 15px; height: 15px"
                        type="radio" name='select' id='daily_limitation'
                        value="{{6}}">
                        <label for="">{{trans('admin.daily_limitation')}}</label>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <button type="submit" class="btn btn-primary" id="send">{{trans('admin.transfere')}}</button>
</form>
@endsection