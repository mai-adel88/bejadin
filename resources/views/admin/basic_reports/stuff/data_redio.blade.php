<style>
    .myradio__input {
        opacity: 0;
        position: absolute;
    }
    .myradio__label {
        border-radius: 9999px;
        padding: 5px 15px 5px 40px;
        cursor: pointer;
        position: relative;
        transition: all .5s;
    }
    .myradio__label::before, .myradio__label::after {
        content: "";
        border-radius: 9999px;
        width: 16px;
        height: 16px;
        margin: 3px 0;
        position: absolute;
        z-index: 1;
    }
    .myradio__label::before {
        background-color: #FFFFFF;
        border: 2px solid #DCDCDC;
        top: 4px;
        left: 10px;
        transition: all .5s;
    }
    .myradio__label::after {
        background-color: transparent;
        top: 6px;
        left: 12px;
        transition: all .2s;
        transition-timing-function: ease-out;
    }
    .myradio__label:hover::after {
        background-color: rgba(51, 170, 221, 0.08);
        transform: scale(2.5);
    }
    .myradio__input:checked ~ .myradio__label::before {
        background-color: #FFFFFF;
        border: 2px solid #33aadd;
    }
    .myradio__input:checked ~ .myradio__label::after {
        background-color: #33aadd;
        border: 2px solid transparent;
        top: 4px;
        left: 10px;
        transform: scale(0.6);
    }
    .myradio__input:checked ~ .myradio__label:hover::after {
        transform: scale(0.6);
    }

</style>

<br>
<br>
<div class="row">
    <div class="col-md-6">
        <div class="vertical-menu">
            <div class="custom_radio">
                <input style="width: 100px"  value="2" type="radio" name="myRadio" id="one"  class="myradio__input" >
                <label for="one" class="myradio__label">دليل الحسابات</label>
            </div>
            <div class="custom_radio">
                <input style="width: 250px"  value="2" type="radio" name="myRadio" id="two"  class="myradio__input" >
                <label for="two" class="myradio__label">الراتب</label>
            </div>
            <div class="custom_radio">
                <input style="width: 250px" value="2" type="radio" name="myRadio" id="three"  class="myradio__input" >
                <label for="three" class="myradio__label">نوع الدوام </label>
            </div>
        </div>
    </div>


    <div class="col-md-6">
        <div class="vertical-menu">
            <div class="custom_radio">
                <input   value="2" type="radio" name="myRadio" id="four"  class="myradio__input" >
                <label  for="four" class="myradio__label">الحالة الوظيفية </label>
            </div>
            <div class="custom_radio">
                <input   value="2" type="radio" name="myRadio" id="five"  class="myradio__input" >
                <label  for="five" class="myradio__label">بنك الشركة</label>
            </div>
            <div class="custom_radio">
                <input   value="2" type="radio" name="myRadio" id="six"  class="myradio__input" >
                <label  for="six" class="myradio__label">بنك الموظف</label>
            </div>
        </div>
    </div>
</div>



