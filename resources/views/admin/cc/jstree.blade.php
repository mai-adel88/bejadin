<script>
    $(document).ready(function(){
        $('#jstree').jstree({
            "core" : {
                'data' : {!! load_dep('parent_id') !!},
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

            // if(r.join(', ') != ''){
            //     $('.showbtn_control').removeClass('hidden');
            //     $('.edit_dep').attr('href','{{aurl('cc')}}/'+r.join(', ')+'/edit');
            // }else{
            //     $('.showbtn_control').addClass('hidden');
            // }
        });
    });
</script>

<div id="jstree" style="margin-top: 20px"></div>
