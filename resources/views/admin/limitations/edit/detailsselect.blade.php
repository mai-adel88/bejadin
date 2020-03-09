
<script>

    $(function () {
        'use strict'
        $('.creditor').val($('.totel_credit').val());
        $('.debtor').val($('.totel_debtor').val());
    });

</script>
<script>

    $(function () {
        'use strict'
        $('.e2').select2({
            placeholder: "{{trans('admin.select')}}",
            dir: '{{direction()}}'
        });
    });
    $(function () {
        'use strict'
        $('.tree,.type').change(function () {
            $('.dbt').val(null);
            $('.crd').val(null);
        });
    });

        @if ($type == 1)
            $('.crd').attr("disabled","disabled");
        @endif
        @if ($type == 5)
            $('.crd').attr("disabled","disabled");
        @endif
        @if ($type == 2)
            $('.crd').attr("disabled","disabled");
        @endif
        @if ($type == 4)
            $('.crd').attr("required","required");
            $('.crd').removeAttr("disabled");
        @endif

        $(function () {
            'use strict'

            $(".tree").on("change",function(){
                event.preventDefault();
                var tree = $('.tree :selected').val();
                var type = $('.type :selected').val();
                if (type == 4) {
                    if (this) {
                        $.ajax({
                            url: '{{aurl('banks/Receipt/cc')}}',
                            type: 'get',
                            dataType: 'html',
                            data: {tree: tree},
                            success: function (data) {
                                $('.column-account-cc').html(data);

                            }
                        });
                    } else {
                        $('.column-account-cc').html('');
                    }
                }
            });


        });
</script>
<div class="form-group row">
    <div class="col-md-12">
        {{ Form::label('tree', session_lang($operation->name_en,$operation->name_ar), ['class' => 'control-label']) }}
        {{ Form::select('tree',$tree,null, array_merge(['class' => 'form-control e2 tree','placeholder'=> trans('admin.select') ])) }}
    </div>
    <div class="column-account-cc">

    </div>
</div>