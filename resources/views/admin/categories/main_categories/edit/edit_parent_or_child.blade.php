<script>
    $(document).on('change', '.Itm_Picture', function () {
        var reader = new FileReader();
        reader.onload = function(e) {
            $('.img_content').html('<img style="width:100%" src="'+e.target.result+'">');
        };
        reader.readAsDataURL(this.files[0]);
    });
    $('select').change(function () {
        $(this).siblings('input').val($(this).val())
    });

    // effect inputs number when change unit in MtsItmfsunit
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

</script>


{{--First tap--}}
@include('admin.categories.main_categories.edit.cat_data')
{{--Second tap--}}
@include('admin.categories.main_categories.edit.weight_measure')
{{--third tap--}}
@include('admin.categories.main_categories.edit.purchases')
