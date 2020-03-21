@extends('hr.index')

@section('root_name', trans('hr.title'))
@section('content')
    @push('css')
        <style>
            .p-0{ padding:0px; }
        </style>

    @endpush
    @push('js')
        <script>

            // employees for company
            $(".Cmp_No").change(function () {
                $.ajax({
                    url : "{{route('get-employee')}}",
                    type : 'get',
                    dataType:'html',
                    data: {"_token": "{{ csrf_token() }}", Cmp_No: $(this).val() },
                    success : function(data){
                        // alert('ss');
                        $('.SubCmp_No').html(data)
                    }
                });
            });
        </script>

    @endpush
    <div class="box">
        <div class="box-header">
        </div>
        <div class="box-body">
            @include('hr.layouts.message')
            {!!Form::open(['method'=>'POST','route' => 'address.store','files'=> true]) !!}
            @include('hr.settings.addresses.form')
        </div> {{--end of  box-body --}}
    </div> {{--end of div box--}}
@endsection