@extends('admin.index')
@section('title',trans('admin.daily_limitation'))
@section('content')
    @push('js')
        <script>
            $(document).ready(function () {
                $(document).on('click', '.class_active_link', function () {
                    let url = $(this).attr('data-url'),
                        ID_NO = $(this).attr('data-id'),
                        linkElement = $('.link_'+ID_NO),
                        iconElement = linkElement.children('i');
                    $.ajax({
                        url: url,
                        type: 'get',
                        dataType: 'json',
                        data:{ ID_NO: ID_NO },
                        success: function (data) {
                            // if(data.status === 0){
                            //     $('.active_message').removeClass('hidden').html(data.message);
                            //     return false;
                            // }
                            iconElement.toggleClass('fa-close fa-check');
                            linkElement.toggleClass('btn-danger btn-success');
                            $('.active_message').removeClass('hidden').html(data.message);

                        }
                    });
                })
            })
        </script>
    @endpush
    @hasrole('admin')
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">{{trans('admin.daily_limitation')}} </h3>
        </div>
        <div class="col-md-12">
            @include('admin.layouts.message')
            <div class="alert alert-info active_message hidden"></div>
        </div>
    <!-- /.box-header -->
        <div class="box-body table-responsive">
            {!! $dataTable->table([
             'class' => 'table table-bordered table-striped table-hover'
             ],true) !!}
        </div>
        <!-- /.box-body -->
    </div>







    @push('js')
        {!! $dataTable->scripts() !!}
    @endpush
    @else
        <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

        @endhasrole
@endsection
