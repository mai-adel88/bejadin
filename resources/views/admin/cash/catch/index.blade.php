@extends('admin.index')
@section('title',trans('admin.caching_receipt'))
@section('content')
    @push('js')
        <script>

            $(document).ready(function() {
                $('#example').DataTable();
            } );


            $(document).ready(function(){



                //get branches of specific company selection
                $(document).on('change', '#Cmp_No', function(){
                    $.ajax({
                        url: "{{route('getBranchesAndStores')}}",
                        type: "POST",
                        dataType: 'html',
                        data: {"_token": "{{ csrf_token() }}", Cmp_No: $(this).val() },
                        success: function(data){
                            $('#Brn_No_content').html(data);
                        }
                    });

                    $.ajax({
                        url: "{{route('receiptCash.index')}}",
                        type: "get",
                        dataType: 'html',
                        data: {"_token": "{{ csrf_token() }}", Cmp_No: $(this).val() },
                        success: function(data){
                            $('#tableFilter').html(data);
                        }
                    });
                });

                $(document).on('change', '#Dlv_Stor', function(){
                    var Cmp_No = $('#Cmp_No').children('option:selected').val();
                    $.ajax({
                        url: "{{route('receiptCash.index')}}",
                        type: "get",
                        dataType: 'html',
                        data: { pranch: $(this).val() , Cmp_No: Cmp_No },
                        success: function(data){
                            $('#tableFilter').html(data);
                        }
                    });
                });

                // Modal - هل انت متأكد من الحذف؟
                $('#myModal').on('shown.bs.modal', function () {
                    $('#myInput').trigger('focus')
                });

                $('#delete').click(function(e){
                    e.preventDefault();
                });
                $('#modal_yes').click(function(){
                    $('#delete_form').submit();
                });
            });
        </script>
    @endpush
    {{-- header start --}}
    <div class="row">

        {{-- الشركه --}}
        <div class="col-md-4">
            <div class="form-group">
                <label for="Cmp_No">{{trans('admin.company')}}</label>
                <select name="Cmp_No" id="Cmp_No" class="form-control">
                    <option value="{{null}}">{{trans('admin.select')}}</option>
                    @if(count($companies) > 0)
                        @foreach($companies as $cmp)
                            <option value="{{$cmp->Cmp_No}}">{{$cmp->{'Cmp_Nm'.ucfirst(session('lang'))} }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
        </div>
        {{-- نهاية الشركه --}}
        {{-- الفرع --}}
        <div class="col-md-2">
            <div class="form-group">
                <label for="Dlv_Stor">{{trans('admin.section')}}</label>
                <div id="Brn_No_content">
                    <select name="Dlv_Stor" id="Dlv_Stor" class="form-control">
                        <option value="{{null}}">{{trans('admin.select')}}</option>
                    </select>
                </div>
            </div>
        </div>
        {{-- نهاية الفرع --}}
        <br>
        <br>
        <br>

        <div class="content">
            <div class="box">
                <div class="box-header">
                    {{-- header end --}}
                    <div class="row">
                        <a class="btn btn-primary" style="float: left;margin-left: 20px" href="{{route('receiptCash.create')}}">{{trans('admin.create_caching_receipt')}}</a>

                        <div class="col-md-12" id="rcpt_content">
                            <div id="tableFilter">
                                <table id="example" class="table table-striped display" style="width:100%">
                                    <thead>
                                    <tr>
                                        <th>{{trans('admin.id')}}</th>
                                        <th>{{trans('admin.number_of_receipt')}}</th>
                                        <th>{{trans('admin.receipts_type')}}</th>
                                        <th>{{trans('admin.receipt_date')}}</th>
                                        <th>{{trans('admin.note_for')}}</th>
                                        <th>حالة السند</th>
{{--                                        <th>مصاريف الإعتماد</th>--}}
{{--                                        <th>العملة الأجنبية مدين </th>--}}
{{--                                        <th>العملة الأجنبيه دائن </th>--}}
                                        <th>{{trans('admin.View')}}</th>
{{--                                        <th>{{trans('admin.print')}}</th>--}}
                                        <th>{{trans('admin.edit')}}</th>
                                        <th>{{trans('admin.delete')}}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @if(count($gls) > 0)
                                        @foreach($gls as $gl)
                                            <tr>
                                                <td>{{$loop->iteration}}</td>


                                                <td>{{$gl->Tr_No}}</td>
                                                <td>
                                                    {{\App\Enums\dataLinks\ReceiptType::getDescription($gl->Jr_Ty) }}
                                                </td>
                                                <td>{{$gl->Tr_Dt}}</td>
                                                <td>{{$gl->Tr_Ds}}</td>

                                                <td>
                                                    @if($gl->status == 1)
                                                        تم الحذف
                                                    @else
                                                        فعال
                                                    @endif
                                                </td>

{{--                                                <td></td>--}}
{{--                                                <td></td>--}}
{{--                                                <td></td>--}}

                                                <td>
                                                    <a href="{{route('receiptCash.show', $gl->Tr_No)}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                                                </td>
{{--                                                <td>--}}
{{--                                                    <a href="../../receiptCash/print/{{$gl->Tr_No}}" class="btn btn-info"><i class="fa fa-print"></i></a>--}}
{{--                                                </td>--}}
                                                <td>
                                                    <a href="{{route('receiptCash.edit', $gl->Tr_No)}}" class="btn btn-success"><i class="fa fa-edit"></i></a>
                                                </td>
                                                <td>
                                                    <form action="{{route('receiptCash.destroy', $gl->ID_No)}}" id="delete_form" method="POST">
                                                        {{csrf_field()}}
                                                        {{method_field('DELETE')}}
                                                        <button type="submit" class="btn btn-danger" id="delete" data-toggle="modal" data-target="#saveChangesModal"><i class="fa fa-trash" ></i></button>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endforeach
                                    @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <div>
                        {{$gls->links()}}
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{-- Modal --}}
    <div class="modal fade" id="saveChangesModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    {{-- <h5 class="modal-title" id="exampleModalLabel">Modal title</h5> --}}
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    {{trans('admin.You_Want_You_Sure_Delete_This_Record')}}
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" id="modal_yes">{{trans('admin.yes')}}</button>
                    <button type="button" class="btn btn-primary" id="modal_no" data-dismiss="modal" aria-label="Close">{{trans('admin.no')}}</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal end --}}

@endsection
