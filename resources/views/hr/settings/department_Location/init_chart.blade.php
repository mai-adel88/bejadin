@extends('hr.index')
@section('title',trans('hr.dep_loc'))
@section('content')
@push('js')
    <script> 
        var timer = 0;
        var delay = 100;
        var prevent = false;
        $(document).ready(function () {


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
                                    //'data' : {!! load_prj('parent_id', '', '') !!},
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
                                // timer = setTimeout(function() {
                                // if (!prevent) {
                                handle_click(r[0], result);
                                // }
                                // prevent = false;
                                // }, delay);
                            });

                            //handle tree click vent
                            // $('#jstree').on("click.jstree", function (e){
                            //     timer = setTimeout(function() {
                            //     if (!prevent) {
                            //         handle_click(e);
                            //     }
                            //     prevent = false;
                            //     }, delay);
                            // });

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
                    //'data' : {!! load_cc('parent_id', '', '') !!},
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
                $('#modal-delete').attr('action','{{aurl('cc')}}/'+r.join(', '));
                $('#parent_name').text(name);
            });

            //handle tree click vent
            $('#jstree').on("click.jstree", function (e){
                timer = setTimeout(function() {
                if (!prevent) {
                    handle_click(e);
                }
                prevent = false;
                }, delay);
            });

            //handle tree double click event
            $('#jstree').on("dblclick.jstree", function (e){
                clearTimeout(timer);
                prevent = true;
                handle_dbclick(e);
            });


            function handle_click(e){
                var node = $(e.target).closest("li");
                var type = node.attr('rel');
                var Costcntr_No = node[0].id;
                $.ajax({
                    url: "{{route('getCcEditBlade')}}",
                    type: "POST",
                    dataType: 'html',
                    data: {"_token": "{{ csrf_token() }}", Costcntr_No: Costcntr_No },
                    success: function(data){
                        $('#chart_form').html(data);
                    }
                });
            }

            function handle_dbclick(e){
                var node = $(e.target).closest("li");
                var type = node.attr('rel');
                var Costcntr_No = node[0].id;
                $.ajax({
                    url: "{{route('createCcNewAcc')}}",
                    type: "POST",
                    dataType: 'html',
                    data: {"_token": "{{ csrf_token() }}", Costcntr_No: Costcntr_No },
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

            $(document).on('change' ,'#Clsacc_No1_Check' , function(){
                if($(this).is(':checked')){
                    $('#Clsacc_No1').removeClass('hidden');
                }
                else{
                    $('#Clsacc_No1').addClass('hidden');
                    $('#Clsacc_No1').val(null);
                }
            });

            $(document).on('change', '#Clsacc_No2_Check', function(){
                if($(this).is(':checked')){
                    $('#Clsacc_No2').removeClass('hidden');
                }
                else{
                    $('#Clsacc_No2').addClass('hidden');
                    $('#Clsacc_No2').val(null);
                }
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
                        $('#Clsacc_No1').val(null);
                        $('#Clsacc_No2').val(null);
                        $('#cc_type').val(null);
                    }
                }
            });

        });

    </script>
@endpush
    <div class="box">
        @include('hr.layouts.message')
        <!-- /.box-header -->
            {!! Form::open(['method'=>'POST','route' => ['departmentLoc.store'], 'id' => 'edit_form', 'files' => true]) !!}
            {{csrf_field()}}
        <div class="box-body table-responsive" id="create_chart">
            <div class="row">
                <div class="col-md-6">
                    <input type="text" name="Parnt_DepmLoc" id="Prj_Parnt" value="{{0}}" hidden>
                    <input type="text" name="Level_No" id="Level_No" value="{{1}}" hidden>
                    <div class="col-md-12">
                        <div id="parent_name" style="display: inline-block"></div>
                        <div class="box-header">
                            <!-- الشركه -->
                            <div class="form-group row">
                                <label for="Cmp_No" class="col-md-2">{{trans('hr.company')}}</label>

                                <select name="Cmp_No" id="Select_Cmp_No" class="form-control col-md-8">
                                    <option disabled selected>{{trans('admin.select_Cmp')}}</option>
                                    @if(count($cmps) > 0)
                                        @foreach($cmps as $cmp)
                                            <option value="{{$cmp->Cmp_No}}">{{$cmp->{'Cmp_Nm'.ucfirst(session('lang'))} }}</option>
                                        @endforeach
                                    @endif
                                </select>
                            </div>
                        </div>
                        <div id="jstree" style="margin-top: 20px"></div>
                    </div>
                </div>

                <div id="parent_name" style="display: inline-block"></div>

                <div class="col-md-6" id="chart_form">


                        {{-- Parnt_DepmLoc --}}
                        <input type="text" name="Parnt_DepmLoc" id="Parnt_Acc" value="{{0}}" hidden>
                        <input type="text" name="Level_No" id="Level_No" value="{{1}}" hidden>
                        {{-- Parnt_DepmLoc end --}}

                        <div class="row">
                            <div class="col-md-1 pull-left">
                                <button type="submit" class="btn btn-primary"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                            </div>

                            {{-- رقم الاداره --}}
                            <label for="DepmLoc_No" class="col-md-2">{{trans('hr.dep_number')}}:</label>
                            <input type="text" name="DepmLoc_No" readonly id="Costcntr_No" class="form-control col-md-1" value="{{$Depm_No}}">
                            {{-- رقم الاداره --}}
                            <br><br>

                            {{-- تصنيف الاداره رئيسي / فرعي --}}
                            <input type="text" value="{{0}}" name="Level_Status" hidden>
                            {{-- نهاية تصنيف الاداره --}}
                        </div>

                        {{-- اسم الاداره عربى --}}
                        <div class="form-group row">
                            <label class="col-md-2" for="DepmLoc_NmAr">{{trans('admin.name_ar')}}:</label>
                                <input type="text" name="DepmLoc_NmAr" id="DepmLoc_NmAr" class="col-md-9 form-control">
                            </div>
                        {{-- نهاية اسم الاداره عربى --}}

                        {{-- اسم الاداره انجليزى --}}
                        <div class="form-group row">
                            <label class="col-md-2" for="DepmLoc_NmEn">En</label>
                            <input type="text" name="DepmLoc_NmEn" id="DepmLoc_NmEn" class=" col-md-9 form-control">
                        </div>
                        {{-- نهاية اسم الاداره انجليزى --}}

                    {!! Form::close() !!}
                    
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>







@endsection
