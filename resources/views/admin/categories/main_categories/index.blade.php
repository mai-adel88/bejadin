@extends('admin.index')
@section('title',trans('admin.basic_types'))
@section('content')
    @push('css')
        <style>
            .collaps_tree{
                width: 0;
                overflow: hidden !important;
            }
            .nav-tabs.nav-justified>.active>a, .nav-tabs.nav-justified>.active>a:focus, .nav-tabs.nav-justified>.active>a:hover{
                border-top: 1px groove black;
                background: #019ce65c;
                border-radius: 0;
                font-weight: bold;
            }

            .nav-tabs.nav-justified>li>a{
                color: #444;
                background: rgba(1, 156, 230, 0.11);
            }

            .nav-tabs.nav-justified>li>a:hover{
                background: #019ce65c;
            }

            .input_number{
                width: 100%;
                height: 30px;
                font-size: 14px;
                line-height: 1.42857143;
                text-align: center;
                color: #555;
                background-color: #fff;
                background-image: none;
                border: 1px solid #ccc;
                border-radius: 4px;
                -webkit-box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                box-shadow: inset 0 1px 1px rgba(0,0,0,.075);
                -webkit-transition: border-color ease-in-out .15s,-webkit-box-shadow ease-in-out .15s;
                -o-transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
                transition: border-color ease-in-out .15s,box-shadow ease-in-out .15s;
            }
        </style>
    @endpush
    @push('js')
        <script>

            $(document).ready(function () {

                var timer = 0;
                var delay = 100;
                var prevent = false;

                $(document).on('change', '.Cmp_No , .Actvty_No', function(){
                    $('#jstree').jstree('destroy');
                    var tree = [];
                    var Cmp_No = $('.Cmp_No').val();
                    var Actvty_No = $('.Actvty_No').val();
                    if(Cmp_No != null){
                        $.ajax({
                            url: "{{route('getCategoryItem')}}",
                            type: "post",
                            dataType: 'html',
                            data: {
                                _token: "{{ csrf_token() }}",
                                Cmp_No: Cmp_No,
                                Actvty_No: Actvty_No
                            },
                            success: function(data){
                                let dataParse = JSON.parse(data);

                                for(var i = 0; i < dataParse.length; i++){
                                    tree.push(dataParse[i])
                                }

                                $('#jstree').jstree({
                                    "core" : {
                                        'data' : {!!  load_item('Itm_Parnt', '', session('updatedComNo'), session('updatedActiveNo')) !!},
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
                                    // $('#parent_name').text(name);

                                    //get all direct and undirect children of selected node
                                    var currentNode = data.node;
                                    var allChildren = $(this).jstree(true).get_children_dom(currentNode);
                                    var result = [];
                                    allChildren.find('li').addBack().each(function(index, element) {
                                        if ($(this).jstree(true).is_leaf(element)) {
                                            result.push(parseInt(element.id));
                                        } else {
                                            var nod = $(this).jstree(true).get_node(element);
                                            result.push(parseInt(nod.id));
                                        }
                                    });

                                    timer = setTimeout(function () {
                                        handle_click(r[0], result);
                                        prevent = false;
                                    }, delay)
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
                        'data' : {!!  load_item('Itm_Parnt', '', session('updatedComNo'), session('updatedActiveNo')) !!},
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
                    // $('#parent_name').text(name);

                    //get all direct and undirect children of selected node
                    var currentNode = data.node;
                    var allChildren = $(this).jstree(true).get_children_dom(currentNode);
                    var result = [];
                    allChildren.find('li').addBack().each(function(index, element) {
                        if ($(this).jstree(true).is_leaf(element)) {
                            result.push(parseInt(element.id));
                        } else {
                            var nod = $(this).jstree(true).get_node(element);
                            result.push(parseInt(nod.id));
                        }
                    });

                    timer = setTimeout(function () {
                        handle_click(r[0], result);
                        prevent = false;
                    }, delay)
                });

                $('#jstree').on("dblclick.jstree", function (e){
                    clearTimeout(timer);
                    prevent = true;
                    handle_dbclick(e);
                });

                // handle click event
                function handle_click(Itm_No, children){

                    $('form.mainCategories').attr('action', "{{route('updateRootOrChildOrCreateChild')}}")
                    // console.log(Costcntr_No)
                    // var node = $(e.target).closest("li");
                    // var type = node.attr('rel');
                    // var Costcntr_No = node[0].id;
                    $.ajax({
                        url: "{{route('getRootOrChildForEdit')}}",
                        type: "get",
                        dataType: 'html',
                        data: {
                            _token: "{{ csrf_token() }}",
                            Itm_No: Itm_No,
                            children: children
                        },
                        success: function(data){
                            $('#myTabContent1').html(data);
                            $('.editRootOrChildLink ').removeClass('hidden createChild');
                            $('.createChild').addClass('editRootOrChildLink').removeClass('createChild');
                            $('.deleteRootOrChildLink  ').removeClass('hidden');
                        }

                    });
                }

                function handle_dbclick(e){
                    $('form.mainCategories').attr('action', "{{route('updateRootOrChildOrCreateChild')}}")
                    var node = $(e.target).closest("li");
                    var type = node.attr('rel');
                    var parent = node[0].id;
                    $.ajax({
                        url: "{{route('returnCreateChildBlade')}}",
                        type: "post",
                        dataType: 'html',
                        data: {"_token": "{{ csrf_token() }}", parent: parent},
                        success: function(data){
                            $('#myTabContent1').html(data);
                            $('.editRootOrChildLink ').addClass('createChild').removeClass('editRootOrChildLink');
                            $('.deleteRootOrChildLink  ').addClass('hidden');
                        }
                    });
                }

                /**
                 * Separate
                 */


                // $('#parent').click(function () {
                //     $('input[type="checkbox"]#sells').prop('checked', true);
                // });
                //
                // if($('#parent').prop('checked') === true){
                //     $('input[type="checkbox"]#sells').prop('checked', true);
                // }
                //
                // $('#child').click(function () {
                //     $('input[type="checkbox"]#sells').prop('checked', false);
                // });

                // $('input[type="checkbox"]#sells').click(function () {
                //     if($('#child').prop('checked') === true){
                //         $('input[type="checkbox"]#sells').prop('checked', false);
                //     }
                //     if($('#parent').prop('checked') === true){
                //         $('input[type="checkbox"]#sells').prop('checked', true);
                //     }
                // });

                $('.Sup_No').change(function () {
                    $('.Sup_No_show').val($(this).val())
                });

                $('.addRootOrChild').click(function () {


                    let form = $('form.mainCategories'),
                        formData = new FormData(form[0]);
                    $.ajax({
                        url: "{{route('mainCategories.store')}}",
                        type: "post",
                        dataType: 'json',
                        processData: false,
                        cache: false,
                        contentType: false,
                        // crossDomain: true,
                        data: formData,
                        success: function (data) {
                            if(data.status === 0){
                                $('.error_message').removeClass('hidden').html(data.message);
                                $('.success_message').addClass('hidden')
                            } else {
                                $('.Itm_No').val(parseInt($('.Itm_No').val())+1);
                                $('.success_message').removeClass('hidden').html(data.message);
                                $('.error_message').addClass('hidden');
                                window.location.reload();
                            }
                        }
                    })
                });

                $(document).on('change', '.Itm_Picture', function () {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        $('.img_content').html('<img style="width:100%" src="'+e.target.result+'">');
                    };
                    reader.readAsDataURL(this.files[0]);
                });

                var lastItemNo = $('.Itm_No ').val();
                $('.editRootOrChildLink, .createChild').click(function () {

                    let form = $('form.mainCategories'),
                        formData = new FormData(form[0]);
                    $.ajax({
                        url: "{{route('updateRootOrChildOrCreateChild')}}",
                        type: "post",
                        dataType: 'json',
                        processData: false,
                        cache: false,
                        contentType: false,
                        data: formData,
                        success: function (data) {
                            if(data.status === 0){
                                $('.error_message').removeClass('hidden').html(data.message);
                                $('.success_message').addClass('hidden')
                            } else {
                                $('.Itm_No').val(parseInt($('.Itm_No').val())+1);
                                $('.success_message').removeClass('hidden').html(data.message);
                                $('.error_message').addClass('hidden');
                                    $('.Itm_No').val(lastItemNo);
                                    $('.Level_No').val(1);
                                    $('.Itm_NmAr').val('');
                                    $('.Itm_NmEn').val('');
                                    window.location.reload();
                            }
                        }
                    });

                });

                $('.deleteRootOrChildLink').click(function () {

                    $('.conform_delete').click(function () {
                        $.ajax({
                            url: "{{route('deleteRootOrChild')}}",
                            type: "post",
                            dataType: 'json',
                            data: {
                                _token: "{{csrf_token()}}",
                                Itm_No: $('.Itm_No').val(),
                            },
                            success: function (data) {
                                if(data.status === 0){
                                    $('.error_message').removeClass('hidden').html(data.message);
                                    $('.success_message').addClass('hidden')
                                } else {
                                    window.location.reload();
                                }

                            }
                        });
                    })


                });

                // close-open tree
                $('.tree_panel .close_tree').click(function () {
                    $('.tree_panel').toggleClass('collaps_tree col-md-4 col-md-1');
                    $('.weight_measure_panel').toggleClass('col-md-8 col-md-11');
                    $('#chart_form').toggleClass('col-md-8 col-md-11');
                    $(this).toggleClass('btn-danger btn-success').children('i').toggleClass('fa-close fa-arrow-left')
                });

                // effect inputs number whene change unit generally
                $('select').change(function () {
                    $(this).siblings('input').val($(this).val())
                });

                // effect inputs number whene change unit in MtsItmfsunit
                $('.Unit_No_1, .Unit_No_2, .Unit_No_3').change(function () {
                    $('#'+this.classList[1]).val($(this).val())
                });

                // change unit no in MtsItmfsunit depend unit no in item
                $('.Unit_No').change(function () {

                    $(this).css({
                        borderColor: '#d2d6de'
                    });

                    let value = $(this).val(),
                        html = $(this).children('option:selected').html(),
                        selectedOption = `<option selected value="`+value+`">`+html+`</option>`,
                        Unit_No_1 = $('.Unit_No_1');

                    Unit_No_1.children('option:selected').removeAttr('selected');
                    Unit_No_1.prepend(selectedOption);
                    Unit_No_1.children('option[value="'+value+'"]:not(:selected)').remove();
                    $('#Unit_No_1').val(value);

                    if($('.Itm_Sal1').val() !== ''){
                        $('#Unit_Sal1').val(parseFloat($('.Itm_Sal1').val()));
                    }


                });

                $('.Itm_Sal1, .Itm_Pur, .Itm_COst').change(function () {
                    let unitRation2 = $('#Unit_Ratio_2'),
                        unitRation3 = $('#Unit_Ratio_3');

                    if($('.Unit_No').val() === ''){
                        $('.Unit_No').css({
                            borderColor: 'red'
                        });
                        return false;
                    }
                    $($(this).data('sal')).val(parseFloat($(this).val()));

                    if(unitRation2.val() !== ''){
                        $(unitRation2.data('unit-sal')).val(parseFloat($('.Itm_Sal1').val())/parseFloat(unitRation2.val()))
                        $(unitRation2.data('unit-pure')).val(parseFloat($('.Itm_Pur').val())/parseFloat(unitRation2.val()))
                        $(unitRation2.data('unit-cost')).val(parseFloat($('.Itm_COst').val())/parseFloat(unitRation2.val()))
                    }

                    if(unitRation3.val() !== ''){
                        $(unitRation3.data('unit-sal')).val((parseFloat($('.Itm_Sal1').val())/parseFloat(unitRation2.val()))/parseFloat(unitRation3.val()))
                        $(unitRation3.data('unit-pure')).val((parseFloat($('.Itm_Pur').val())/parseFloat(unitRation2.val()))/parseFloat(unitRation3.val()))
                        $(unitRation3.data('unit-cost')).val((parseFloat($('.Itm_COst').val())/parseFloat(unitRation2.val()))/parseFloat(unitRation3.val()))
                    }



                });

                $('#Unit_Ratio_2 ,#Unit_Ratio_3').change(function () {
                    let unitSalVal = parseFloat($('#Unit_Sal1').val()),
                        unitPureVal = parseFloat($('#Unit_Pur1').val()),
                        unitCostVal = parseFloat($('#Unit_Cost1').val()),
                        unitRation2Count = parseFloat($('#Unit_Ratio_2').val()),
                        unitRation3Count = parseFloat($('#Unit_Ratio_3').val()),
                        UnitSal = $($(this).data('unit-sal')),
                        unitPure = $($(this).data('unit-pure')),
                        unitCost = $($(this).data('unit-cost'));

                    if($(this).attr('id') === 'Unit_Ratio_3'){
                        UnitSal.val(unitSalVal/(unitRation2Count*unitRation3Count));
                        unitPure.val(unitPureVal/(unitRation2Count*unitRation3Count));
                        unitCost.val(unitCostVal/(unitRation2Count*unitRation3Count));
                    } else {
                        UnitSal.val(unitSalVal/unitRation2Count);
                        unitPure.val(unitPureVal/unitRation2Count);
                        unitCost.val(unitCostVal/unitRation2Count);

                        if($('#Unit_Ratio_3').val() !== ''){
                            $('#Unit_Sal3').val(unitSalVal/(unitRation2Count*unitRation3Count));
                            $('#Unit_Pur3').val(unitPureVal/(unitRation2Count*unitRation3Count));
                            $('#Unit_Cost3').val(unitCostVal/(unitRation2Count*unitRation3Count));
                        }


                    }

                })

            });

        </script>
    @endpush
    <div class="box">

    @include('admin.layouts.message')

        <div class="modal fade" id="delete_modal">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <h4 class="modal-title">{{trans('admin.Delete_Record')}}</h4>
                    </div>
                    <div class="modal-body">
                        {{trans('admin.You_Want_You_Sure_Delete_This_Record')}}
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-danger conform_delete" data-dismiss="modal">{{trans('admin.delete')}}</button>
                    </div>
                </div><!-- /.modal-content -->
            </div><!-- /.modal-dialog -->
        </div><!-- /.modal -->
    <!-- /.box-header -->
        <div class="box-body table-responsive" id="create_chart">
            <div class="row">
                <div class="col-md-12">
                    <div class="alert alert-danger error_message hidden"></div>
                </div>
                <div class="col-md-12">
                    <div class="alert alert-success success_message hidden"></div>
                </div>
            </div>
            <div class="row text-left" style="margin-bottom: 5px">
                <div class="col-md-4 pull-left">
                    <a class="btn btn-info editRootOrChildLink hidden" href="#"><i class="fa fa-floppy-o"></i></a>
                    <a data-toggle="modal" href="#delete_modal" class="btn btn-danger deleteRootOrChildLink hidden"><i class="fa fa-trash"></i></a>
                </div>
            </div>
            {!! Form::open(['route' => 'mainCategories.store', 'method' => 'post', 'class' => 'mainCategories', 'files' => true]) !!}
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group" style="display: flex">
                        <label style="width: 25%" for="Cmp_No">{{trans('admin.companies')}}</label>
                        {{--@if($cmp->ID_No == session('updatedComNo')) selected @endif--}}
                        <select name="Cmp_No" id="Cmp_No" class="form-control Cmp_No">
                            <option value="">{{trans('admin.select')}}</option>
                            @if(count($cmps) > 0)
                                @foreach($cmps as $cmp)
                                    <option @if(session('updatedComNo') == $cmp->ID_No) selected @endif value="{{$cmp->ID_No}}">{{$cmp->{'Cmp_Nm'.ucfirst(session('lang'))} }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    {{--@if($active->ID_No == session('updatedActiveNo')) selected @endif--}}
                    <div class="form-group" style="display: flex">
                        <label style="width: 25%" for="Actvty_No" >{{trans('admin.activity')}}</label>
                        <select name="Actvty_No" id="Actvty_No" class="form-control Actvty_No">
                            <option value="">{{trans('admin.select')}}</option>
                            @if(count($activity) > 0)
                                @foreach($activity as $active)
                                    <option @if(session('updatedActiveNo') == $active->ID_No) selected @endif value="{{$active->ID_No}}">{{$active->{'Name_'.ucfirst(session('lang'))} }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                </div>
            </div>

            {{-- start Ul taps--}}
            <ul class="nav nav-tabs nav-justified" id="myTab1" role="tablist">
                <li class="nav-item active">
                    <a class="nav-link active" id="home-tab1" data-toggle="tab" href="#cat_data" role="tab" aria-controls="home"
                       aria-selected="true">{{trans('admin.cat_data')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab1" data-toggle="tab" href="#weight_measure" role="tab" aria-controls="profile"
                       aria-selected="false">{{trans('admin.weight_measure')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" id="profile-tab2" data-toggle="tab" href="#purchases" role="tab" aria-controls="profile"
                       aria-selected="false">{{trans('admin.purchases')}}</a>
                </li>
            </ul>
            {{-- End Ul taps--}}

            <div class="panel panel-default tree_panel collaps_tree col-md-1" style="margin-top:1%; overflow: auto">
                <div class="panel-body">
                    <a class="btn btn-primary addRootOrChild" id="addRootOrChild">{{trans('admin.new_category')}}</a>
                    <span class="btn btn-success btn-sm  pull-left close_tree"><i class="fa fa-arrow-left"></i></span>
                    <div id="parent_name" style="display: inline-block"></div>
                    <div id="jstree" style="margin-top: 20px"></div>

                </div>
            </div>

            <div class="tab-content" id="myTabContent1" style="margin-top:1%">
                {{--First tap--}}
                @include('admin.categories.main_categories.create_parent.cat_data')
                {{--Second tap--}}
                @include('admin.categories.main_categories.create_parent.weight_measure')
                {{--third tap--}}
                @include('admin.categories.main_categories.create_parent.purchases')
            </div>
            {!! Form::close() !!}

        </div>

    </div>

@endsection
