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
                $('#modal-delete').attr('action','{{route('departmentLoc.index')}}/'+r.join(', '));
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
                var DepmLoc_No = node[0].id;
                $.ajax({
                    url: "{{route('getDepLocEditBlade')}}",
                    type: "POST",
                    dataType: 'html',
                    data: {"_token": "{{ csrf_token() }}", DepmLoc_No: DepmLoc_No },
                    success: function(data){
                        $('#chart_form').html(data);
                    }
                });
            }

            function handle_dbclick(e){
                var node = $(e.target).closest("li");
                var type = node.attr('rel');
                var DepmLoc_No = node[0].id;
                $.ajax({
                    url: "{{route('createNewDepNo')}}",
                    type: "POST",
                    dataType: 'html',
                    data: {"_token": "{{ csrf_token() }}", DepmLoc_No: DepmLoc_No },
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



            $(document).on('change', '#edit_form :radio[id=Level_Status]', function(){
                if($(this).is(':checked')){
                    if($(this).val() == 1){
                        $('.branch').removeClass('hidden');
                    }
                    else{
                        $('.branch').addClass('hidden');
                        $('#Parnt_DepmLoc').val(null);
                        $('#Level_No').val(null);
                        $('#DepmLoc_NmAr').val(null);
                        $('#DepmLoc_NmEn').val(null);
                        $('#Level_Status').val(null);
                        $('#DepmLoc_Actv').val(null);
                        $('#Ownr_No').val(null);
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
            <div class="row col-md-10">
                <div class="col-md-7">
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
                                    @if(isset($cmps) && count($cmps) > 0)
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

                <div class="col-md-5" id="chart_form">


                        {{-- Parnt_DepmLoc --}}
                        <input type="text" name="Parnt_DepmLoc" id="Parnt_Acc" value="{{0}}" hidden>
                        <input type="text" name="Level_No" id="Level_No" value="{{1}}" hidden>
                        {{-- Parnt_DepmLoc end --}}

                        
                        <div class="row col-md-12 pull-left">
                            <button type="submit" class="btn btn-primary pull-left"><i class="fa fa-floppy-o" aria-hidden="true"></i></button>
                        </div>

                            {{-- رقم الاداره --}}
                        <div class="row">
                            <label for="DepmLoc_No" class="col-md-4">{{trans('hr.dep_number')}}:</label>
                            <input type="text" name="DepmLoc_No" readonly id="Costcntr_No" class="form-control col-md-3" value="{{$Depm_No}}">
                        </div>
                            {{-- رقم الاداره --}}
                            <br>
                            {{-- تصنيف الاداره رئيسي / فرعي --}}
                            <input type="text" value="{{0}}" name="Level_Status" hidden>
                            {{-- نهاية تصنيف الاداره --}}

                        {{-- اسم الاداره عربى --}}
                        <div class="form-group row">
                            <label class="col-md-4" for="DepmLoc_NmAr">{{trans('admin.name_ar')}}:</label>
                                <input type="text" name="DepmLoc_NmAr" id="DepmLoc_NmAr" class="col-md-8 form-control">
                        </div>
                        {{-- نهاية اسم الاداره عربى --}}

                        {{-- اسم الاداره انجليزى --}}
                        <div class="form-group row">
                            <label class="col-md-4" for="DepmLoc_NmEn">En</label>
                            <input type="text" name="DepmLoc_NmEn" id="DepmLoc_NmEn" class=" col-md-8 form-control">
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
                    
                </div>
            </div>
        </div>
        <!-- /.box-body -->
    </div>







@endsection
