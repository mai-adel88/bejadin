
{{--tree_id -== null--}}
@if(count($receipts_3) > 0)
    <?php
    //    $branches = App\Branches::where('id',$limitations->limitations->branche_id)->first();

    //    $limitationReceipts = App\limitationReceipts::where('id',$limitations->limitations->limitationsType_id)->first();
    $r = count($receipts_3)-1;

    ?>




    <table style="border:none" class="table table-bordered table-striped table-hover" data-serial="">
        <tr>
            <th colspan="2">#</th>
            <th colspan="4">رقم السند</th>
            <th> الاسم بالسند </th>
            <th colspan="2"> الاسم الحساب</th>

            <th colspan="2"> مدين</th>
            <th colspan="2" style="vertical-align: middle;">دائن</th>
            <th  style="vertical-align: middle;">التاريخ الانشاء</th>
            <th  style="vertical-align: middle;"> سبب المشكلة</th>
            <th colspan="2" style="vertical-align: middle;">العرض</th>
        </tr>



        @for(;$r>=0; $r--)




            <tr>


                <td colspan="3">{{$receipts_3[$r]->id}}</td>
                <td colspan="3">{{$receipts_3[$r]->receipts-> receiptId}}</td>
                <td>{{$receipts_3[$r]->name_ar}}</td>
                <td colspan="2">{{$receipts_3[$r]->departments->dep_name_ar}}</td>
                <td colspan="2">{{$receipts_3[$r]->debtor}}</td>

                <td colspan="2">{{$receipts_3[$r]->creditor}}</td>
                <td>{{$receipts_3[$r]->created_at->format('Y-m-d')}}</td>
                @if($receipts_3[$r]->operation_id == 1)
                    <td colspan="2">{{'tree_id in supplier != tree_id in receipts '}}</td>
                @elseif ($receipts_3[$r]->operation_id == 3)
                    <td colspan="2">{{'tree_id in porjects != tree_id in receipts '}}</td>
                @elseif ($receipts_3[$r]->operation_id == 5)
                    <td colspan="2">{{'tree_id in employess != tree_id in receipts '}}</td>
                @elseif ($receipts_3[$r]->operation_id ==10)
                    <td colspan="2">{{'tree_id in contractors != tree_id in receipts '}}</td>
                @endif
                <td><a href="{{url('admin/banks/Receipt/receipts/'.$receipts_3[$r]->id.'/edit')}}" class="btn btn-success" target="_blanck"> عرض </a></td>







            </tr>



        @endfor
    </table>
@endif




@if(count($receipts_2) > 0)

    <table style="border:none" class="table table-bordered table-striped table-hover" data-serial="">
        <tr>
            <th colspan="2">#</th>
            <th colspan="4">رقم السند</th>
            <th> الاسم بالسند </th>
            <th colspan="2"> الاسم الحساب</th>

            <th colspan="2"> مدين</th>
            <th colspan="2" style="vertical-align: middle;">دائن</th>
            <th  style="vertical-align: middle;">التاريخ الانشاء</th>
            <th  style="vertical-align: middle;"> سبب المشكلة</th>
            <th colspan="2" style="vertical-align: middle;">العرض</th>

        </tr>
        <?php
        //            $branches = App\Branches::where('id',$receiptsType[0]->receipts->branche_id)->first();

        //            $limitationreceipts = App\limitationreceipts::where('id',$receiptsType[0]->receipts->receiptsType_id)->first();
        $r = count($receipts_2)-1;
        ?>

        @for(;$r>=0; $r--)
            {{--        @if(receipts[$r]->departments->dep_name_ar != $receiptsType[$r]->name_ar)--}}
            <tr>



                <td colspan="3">{{$receipts_2[$r]->id}}</td>
                <td colspan="3">{{$receipts_2[$r]->receipts-> receiptId}}</td>
                <td>{{$receipts_2[$r]->name_ar}}</td>
                <td colspan="2">{{$receipts_2[$r]->departments->dep_name_ar}}</td>
                <td colspan="2">{{$receipts_2[$r]->debtor}}</td>

                <td colspan="2">{{$receipts_2[$r]->creditor}}</td>
                <td>{{$receipts_2[$r]->created_at->format('Y-m-d')}}</td>
                <td colspan="2">{{'dep_name_ar != name_ar '}}</td>

                <td><a href="{{url('admin/banks/Receipt/receipts/'.$receipts_2[$r]->id.'/edit')}}" class="btn btn-success" target="_blanck"> عرض </a></td>

            </tr>
            {{--        @endif--}}

        @endfor
    </table>

@endif

@if(count($receipts_1) > 0)

<table style="border:none" class="table table-bordered table-striped table-hover" data-serial="">
    <tr>
        <th colspan="2">#</th>
        <th colspan="4">رقم السند</th>
        <th> الاسم بالسند </th>
        <th colspan="2"> الاسم الحساب</th>

        <th colspan="2"> مدين</th>
        <th colspan="2" style="vertical-align: middle;">دائن</th>
        <th  style="vertical-align: middle;">التاريخ الانشاء</th>
        <th  style="vertical-align: middle;"> سبب المشكلة</th>
        <th colspan="2" style="vertical-align: middle;">العرض</th>

    </tr>
    <?php
    //            $branches = App\Branches::where('id',$receiptsType[0]->receipts->branche_id)->first();

    //            $limitationreceipts = App\limitationreceipts::where('id',$receiptsType[0]->receipts->receiptsType_id)->first();
    $r = count($receipts_1)-1;
    ?>

    @for(;$r>=0; $r--)
{{--        @if(receipts[$r]->departments->dep_name_ar != $receiptsType[$r]->name_ar)--}}
        <tr>



            <td colspan="3">{{$receipts_1[$r]->id}}</td>
            <td colspan="3">{{$receipts_1[$r]->receipts-> receiptId}}</td>
            <td>{{$receipts_1[$r]->name_ar}}</td>
            <td colspan="2">{{$receipts_1[$r]->departments->dep_name_ar}}</td>
            <td colspan="2">{{$receipts_1[$r]->debtor}}</td>

            <td colspan="2">{{$receipts_1[$r]->creditor}}</td>
            <td>{{$receipts_1[$r]->created_at->format('Y-m-d')}}</td>
            <td colspan="2">{{'tree_id != relation_id'}}</td>

            <td><a href="{{url('admin/banks/Receipt/receipts/'.$receipts_1[$r]->id.'/edit')}}" class="btn btn-success" target="_blanck"> عرض </a></td>

        </tr>
{{--        @endif--}}

@endfor
</table>

@endif




@if(count($limitations_1) > 0)

<table style="border:none" class="table table-bordered table-striped table-hover" data-serial="">
    <tr>
        <th colspan="2">#</th>
        <th colspan="4">رقم القيد</th>
        <th>اسم الحساب	 </th>
        <th colspan="3"> الاسم بالحسابات	</th>
        <th colspan="2"> مدين</th>
        <th colspan="2" style="vertical-align: middle;">دائن</th>
        <th colspan="2" style="vertical-align: middle;">وقت الانشاء</th>
        <th colspan="2" style="vertical-align: middle;">سبب المشكلة</th>


    </tr>
    <?php
//    $branches = App\Branches::where('id',$limitations->limitations->branche_id)->first();

//    $limitationReceipts = App\limitationReceipts::where('id',$limitations->limitations->limitationsType_id)->first();
    $r = count($limitations_1)-1;
    ?>

    @for(;$r>=0; $r--)




        <tr>


        <tr>
            <td colspan="4">{{$limitations_1[$r]->id}}</td>

            <td colspan="2">{{$limitations_1[$r]->limitations->limitationId}}</td>

            <td colspan="2">{{$limitations_1[$r]->name_ar}}</td>
            @if($limitations_1[$r]->tree_id != null)
                <td colspan="2">{{$limitations_1[$r]->departments->dep_name_ar}}</td>

            @else
                <td colspan="2">{{null}}</td>
            @endif
            <td colspan="2">{{$limitations_1[$r]->debtor}}</td>

            <td colspan="2">{{$limitations_1[$r]->creditor}}</td>


            <td>{{$limitations_1[$r]->created_at}}</td>

            <td colspan="2">{{'dep_name_ar != name_ar '}}</td>

            <td colspan="2"><a href="{{url('admin/limitations/'.$limitations_1[$r]->limitations->id.'/edit')}}" class="btn btn-success" target="_blanck"> عرض </a></td>


        </tr>



        </tr>



    @endfor
</table>
@endif


{{--tree_id -== null--}}
@if(count($limitations_2) > 0)
    <?php
    //    $branches = App\Branches::where('id',$limitations->limitations->branche_id)->first();

    //    $limitationReceipts = App\limitationReceipts::where('id',$limitations->limitations->limitationsType_id)->first();
    $r = count($limitations_2)-1;

    ?>




    <table style="border:none" class="table table-bordered table-striped table-hover" data-serial="">
        <tr>
            <th colspan="4">#</th>
            <th colspan="4">رقم القيد</th>
            <th>اسم الحساب	 </th>
            <th colspan="3"> الاسم بالحسابات	</th>
            <th colspan="2"> مدين</th>
            <th colspan="2" style="vertical-align: middle;">دائن</th>
            <th colspan="2" style="vertical-align: middle;">وقت الانشاء</th>
            <th colspan="2" style="vertical-align: middle;">سبب المشكلة</th>
        </tr>



        @for(;$r>=0; $r--)




                    <tr>


                            <tr>
                <td colspan="4">{{$limitations_2[$r]->id}}</td>

                                <td colspan="2">{{$limitations_2[$r]->limitations->limitationId}}</td>

                                <td colspan="2">{{$limitations_2[$r]->name_ar}}</td>
                @if($limitations_2[$r]->tree_id != null)
                                <td colspan="2">{{$limitations_2[$r]->departments->dep_name_ar}}</td>

                    @else
                    <td colspan="2">{{null}}</td>
                @endif
                <td colspan="2">{{$limitations_2[$r]->debtor}}</td>

                                <td colspan="2">{{$limitations_2[$r]->creditor}}</td>


                                <td>{{$limitations_2[$r]->created_at}}</td>

                <td colspan="2">{{'tree_id  != relation_id '}}</td>

                                <td colspan="2"><a href="{{url('admin/limitations/'.$limitations_2[$r]->limitations->id.'/edit')}}" class="btn btn-success" target="_blanck"> عرض </a></td>


                            </tr>



                    </tr>



        @endfor
    </table>
@endif






{{--tree_id -== null--}}
@if(count($limitations_3) > 0)
    <?php
    //    $branches = App\Branches::where('id',$limitations->limitations->branche_id)->first();

    //    $limitationReceipts = App\limitationReceipts::where('id',$limitations->limitations->limitationsType_id)->first();
    $r = count($limitations_3)-1;

    ?>




    <table style="border:none" class="table table-bordered table-striped table-hover" data-serial="">
        <tr>
            <th colspan="4">#</th>
            <th colspan="4">رقم القيد</th>
            <th>اسم الحساب	 </th>
            <th colspan="3"> الاسم بالحسابات	</th>
            <th colspan="2"> مدين</th>
            <th colspan="2" style="vertical-align: middle;">دائن</th>
            <th colspan="2" style="vertical-align: middle;">وقت الانشاء</th>
            <th colspan="2" style="vertical-align: middle;">سبب المشكلة</th>
        </tr>



        @for(;$r>=0; $r--)




            <tr>


            <tr>
                <td colspan="4">{{$limitations_3[$r]->id}}</td>

                <td colspan="2">{{$limitations_3[$r]->limitations->limitationId}}</td>

                <td colspan="2">{{$limitations_3[$r]->name_ar}}</td>
                @if($limitations_3[$r]->tree_id != null)
                    <td colspan="2">{{$limitations_3[$r]->departments->dep_name_ar}}</td>

                @else
                    <td colspan="2">{{null}}</td>
                @endif
                <td colspan="2">{{$limitations_3[$r]->debtor}}</td>

                <td colspan="2">{{$limitations_3[$r]->creditor}}</td>


                <td>{{$limitations_3[$r]->created_at}}</td>
@if($limitations_3[$r]->operation_id == 1)
                <td colspan="2">{{'tree_id in supplier != tree_id in limitation '}}</td>
@elseif ($limitations_3[$r]->operation_id == 3)
                    <td colspan="2">{{'tree_id in porjects != tree_id in limitation '}}</td>
 @elseif ($limitations_3[$r]->operation_id == 5)
                    <td colspan="2">{{'tree_id in employess != tree_id in limitation '}}</td>
                @elseif ($limitations_3[$r]->operation_id ==10)
                    <td colspan="2">{{'tree_id in contractors != tree_id in limitation '}}</td>
@endif
                    <td colspan="2"><a href="{{url('admin/limitations/'.$limitations_3[$r]->limitations->id.'/edit')}}" class="btn btn-success" target="_blanck"> عرض </a></td>


            </tr>



            </tr>



        @endfor
    </table>
@endif


