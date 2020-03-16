@extends('hr.index')
@section('title',trans('hr.dep_loc'))
@section('content')
@push('js')
    <script>

        $(document).ready(function () {

            var timer = 0;
            var delay = 100;
            var prevent = false;

            $(document).on('change', '#Select_Cmp_No', function(){
                $('#jstree').jstree('destroy');
                var tree = [];
                var Cmp_No = $('#Select_Cmp_No').val();
                if(Cmp_No != null){
                    $.ajax({
                        url: "{{route('getDepartments')}}",
                        type: "POST",
                        dataType: 'html',
                        data: {"_token": "{{ csrf_token() }}", Cmp_No: Cmp_No},
                        success: function(data){

                            dataParse = JSON.parse(data);

                            for(var i = 0; i < dataParse.length; i++){
                                tree.push(dataParse[i])
                            }

                            $('#jstree').jstree({
                                "core" : {
                                    'data' : tree,
                                    "themes" : {
                                        "variant" : "large"
                                    },
                                    "multiple" : false,
                                    "animation" : 300
                                },
                                "checkbox" : {
                                    "keep_selected_style" : false
                                },
                                "plugins" : [ "themes","html_data","dnd","ui","types" ]
                            });

                            //close or open all nodes on jstree load -opened by default-
                            $('#jstree').on('loaded.jstree', function() {
                                $('#jstree').jstree('open_all');
                            });

                            $('#jstree').on("changed.jstree", function (e, data) {
                                var i, j, r = [];
                                var name = [];
                                for (i=0,j=data.selected.length;i < j;i++){
                                    r.push(data.instance.get_node(data.selected[i]).id);
                                    name.push(data.instance.get_node(data.selected[i]).text);
                                }
                                $('#parent_name').text(name);

                                //get all direct and undirect children of selected node
                                var currentNode = data.node;
                                var allChildren = $(this).jstree(true).get_children_dom(currentNode);
                                // var result = [currentNode.id];
                                var result = [];
                                allChildren.find('li').addBack().each(function(index, element) {
                                    if ($(this).jstree(true).is_leaf(element)) {
                                        // result.push(element.textContent);
                                        result.push(parseInt(element.id));
                                    } else {
                                        var nod = $(this).jstree(true).get_node(element);
                                        // result.push(nod.text);
                                        result.push(parseInt(nod.id));
                                    }
                                });

                                //handle click event
                                handle_click(r[0], result);
                                // }
                                // prevent = false;
                                // }, delay);
                            });

                            //handle tree double click event
                            $('#jstree').on("dblclick.jstree", function (e){
                                clearTimeout(timer);
                                prevent = true;
                                handle_dbclick(e);
                            });
                        }
                    });
                }
            });

            $('#jstree').jstree({
                "core" : {
                    'data' : {!! load_depLoc('parent_id', '', '') !!},
                    "themes" : {
                        "variant" : "large"
                    },
                    "multiple" : false,
                    "animation" : 300
                },
                "checkbox" : {
                    "keep_selected_style" : false
                },
                "plugins" : [ "themes","html_data","dnd","ui","types" ]
            });

            $('#jstree').on('loaded.jstree', function() {
                $('#jstree').jstree('open_all');
            });

            $('#jstree').on("changed.jstree", function (e, data) {
                var i, j, r = [];
                var name = [];
                for (i=0,j=data.selected.length;i < j;i++){
                    r.push(data.instance.get_node(data.selected[i]).id);
                    name.push(data.instance.get_node(data.selected[i]).text);
                }
                $('#parent_name').text(name);
            });

            //handle tree click vent
            $('#jstree').on("click.jstree", function (e){
                timer = setTimeout(function() {
                    handle_click(e);
                    prevent = false;
                }, delay);
            });

            //handle tree double click event
            $('#jstree').on("dblclick.jstree", function (e){
                clearTimeout(timer);
                prevent = true;
                handle_dbclick(e);
            });


            function handle_click(DepmLoc_No, children){

                // console.log(Costcntr_No)
                // var node = $(e.target).closest("li");
                // var type = node.attr('rel');
                // var Costcntr_No = node[0].id;
                $.ajax({
                    url: "{{route('getDepLocEditBlade')}}",
                    type: "POST",
                    dataType: 'html',
                    data: {"_token": "{{ csrf_token() }}", DepmLoc_No: DepmLoc_No, children: children },
                    success: function(data){
                        $('#chart_form').html(data);
                    }
                });
            }

            function handle_dbclick(e){
                var node = $(e.target).closest("li");
                var type = node.attr('rel');
                var parent = node[0].id;
                $.ajax({
                    url: "{{route('createNewDepNo')}}",
                    type: "POST",
                    dataType: 'html',
                    data: {"_token": "{{ csrf_token() }}", parent: parent },
                    success: function(data){
                        $('#chart_form').html(data);
                    }
                });
            }

            $('#Level_Status').on('change', function(){
                if($(this).val() == 1){
                    $('#main_chart').removeClass('hidden');
                }
                else{
                    $('#main_chart').addClass('hidden');
                    $('#main_chart').val(null);
                }
            });

            $('#delete_button').click(function(e){
                e.preventDefault();
                $('#delete_form').submit()
            });

            $('#initChartDepLoc').on('click', function(){
                $.ajax({
                    url: "{{route('initChartDepLoc')}}",
                    type: "POST",
                    dataType: 'html',
                    data: {"_token": "{{ csrf_token() }}"},
                    success: function(data){
                        $('#chart_form').html(data);
                    }
                });
            });


            $(document).on('change', '#cc_type_Check', function(){
                if($(this).is(':checked')){
                    $('#cc_type').removeClass('hidden');
                }
                else{
                    $('#cc_type').addClass('hidden');
                    $('#cc_type').val(null);
                }
            });

            $(document).on('change', '#edit_form :radio[id=Level_Status]', function(){
                if($(this).is(':checked')){
                    if($(this).val() == 1){
                        $('.branch').removeClass('hidden');
                    }
                    else{
                        $('.branch').addClass('hidden');
                        $('#Acc_Ntr').val(null);
                        $('#Fbal_DB').val(0);
                        $('#Fbal_CR').val(0);
                        $('#Cr_Blnc').val(0);
                        $('#Acc_Typ').val(null);
                        $('#ClsCostcntr_No2').val(null);
                        $('#cc_type').val(null);
                    }
                }
            });

        });

    </script>
@endpush
    <div class="box">
        @include('admin.layouts.message')
        <!-- /.box-header -->
        <div class="box-body table-responsive" id="create_chart">
            <div class="row col-md-10">

                {{-- chart tree start --}}
                <div class="col-md-7">
                    <div class="box-header">
                        <div class="form-group row">
                            <h3 class="box-title col-md-2">{{trans('admin.companies')}}</h3>
                            <select name="Cmp_No" id="Select_Cmp_No" class="form-control col-md-10">
                                <option disabled selected>{{trans('hr.company')}}</option>
                                @if(isset($cmps) && count($cmps))
                                    @foreach($cmps as $cmp)
                                        <option value="{{$cmp->Cmp_No}}">{{$cmp->{'Cmp_Nm'.ucfirst(session('lang'))} }}</option>
                                    @endforeach
                                @endif
                            </select>
                        </div>
                    </div>
                    <div class="panel panel-default">
                        <div class="panel-body">
                            <a class="btn btn-primary" id="initChartDepLoc">{{trans('hr.Create_new_dep')}}</a>
                            <div id="parent_name" style="display: inline-block"></div>
                            <div id="jstree" style="margin-top: 20px"></div>
                        </div>
                    </div>
                </div>
                {{-- chart tree end --}}

                {{-- form start --}}
                <div class="col-md-5" id="chart_form">
                    {!! Form::open(['method'=>'POST','route' => ['departmentLoc.update', $chart_item->DepmLoc_No? $chart_item->DepmLoc_No : null], 'id' => 'edit_form','files' => true]) !!}
                        {{csrf_field()}}
                        {{method_field('PUT')}}

                        <div class="row">
                            {{-- رقم الاداره --}}
                            <label for="DepmLoc_No" class="col-md-4">{{trans('hr.dep_number')}}:</label>
                            <input disabled type="text" name="DepmLoc_No" id="DepmLoc_No" class="form-control col-md-2" value="{{$chart_item->DepmLoc_No}}">
                            {{-- رقم الاداره --}}

                            {{-- تصنيف الاداره --}}
                            <div class="col-md-6">
                                @foreach(\App\Enums\dataLinks\TypeAccountType::toSelectArray() as $key => $value)
                                    <input class="checkbox-inline" type="radio"
                                        name="Level_Status" id="Level_Status" value="{{$key}}"
                                        style="margin: 3px;" disabled
                                        @if ($chart_item->Level_Status == $key) checked @endif>
                                    <label>{{$value}}</label>
                                @endforeach
                            </div>
                            {{-- نهاية تصنيف الاداره --}}
                        </div>
                        <br>

                        {{-- رقم الشركه --}}
                        <input type="text" name="Cmp_No" id="Cmp_No" value="{{$chart_item->Cmp_No}}" hidden>
                        {{-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="Cmp_No">{{trans('admin.cmp_no')}}</label>
                                <select name="Cmp_No" id="Cmp_No" class="form-control">
                                    <option>{{trans('admin.select')}}</option>
                                    @if(count($cmps) > 0)
                                        @foreach($cmps as $cmp)
                                            <option value="{{$cmp->Cmp_No? $cmp->Cmp_No : null}}" @if($chart_item->Cmp_No == $cmp->Cmp_No) selected @endif>{{$cmp->{'Cmp_Nm'.ucfirst(session('lang'))} }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div> --}}
                        {{-- نهاية رقم الشركه --}}

                        {{-- اسم الاداره عربى --}}
                        <div class="form-group row">
                            <label class="col-md-4" for="DepmLoc_NmAr">{{trans('admin.account_name')}}:</label>
                                <input disabled type="text" name="DepmLoc_NmAr" id="DepmLoc_NmAr" class="col-md-8 form-control"
                                value="{{$chart_item->DepmLoc_NmAr? $chart_item->DepmLoc_NmAr : null}}">
                            </div>
                        {{-- نهاية اشم الاداره عربى --}}

                        {{-- اسم الاداره انجليزى --}}
                        <div class="form-group row">
                            <label class="col-md-4" for="DepmLoc_NmEn">{{trans('admin.account_name_en')}}:</label>
                            <input disabled type="text" name="DepmLoc_NmEn" id="DepmLoc_NmEn" class=" col-md-8 form-control"
                                value="{{$chart_item->DepmLoc_NmEn? $chart_item->DepmLoc_NmEn : null}}">
                        </div>
                        {{-- نهاية اسم الاداره انجليزى --}}

                        {{-- الكفيل --}}
                        <div class="form-group row">
                            <label class="col-md-4" for="Ownr_No">{{trans('hr.Ownr_No')}}</label>
                            <select name="Ownr_No" id="Ownr_No" class=" col-md-8 form-control">
                                <option disables selected>{{trans('admin.select')}}</option>
                            </select>
                        </div>
                        {{--    الكفيل --}}

                    {!! Form::close() !!}
                    <form action="{{route('departmentLoc.destroy', $chart_item->DepmLoc_No? $chart_item->DepmLoc_No : null)}}" method="POST" id="delete_form">
                        {{csrf_field()}}
                        {{method_field('DELETE')}}
                    </form>
                </div>
                {{-- form end --}}

            </div>
        </div>
        <!-- /.box-body -->
    </div>







@endsection
