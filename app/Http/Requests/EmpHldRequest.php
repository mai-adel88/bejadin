<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EmpHldRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'Cmp_No'       =>  'required',
            'Emp_No'       =>  'required',
            'SubCmp_No'    =>  'sometimes',
            'today_date'   =>  'sometimes',
            'Work_Yer'     =>  'sometimes',
            'Increase_Days'=>  'sometimes',
            'Notes'        =>  'sometimes',
            'Blnc_UnPaid'  =>  'sometimes',
            'Blnc_Paid'    =>  'sometimes',
            'Hld_Ern'      =>  'sometimes',
            'Hld_Ern_Prod' =>  'sometimes',
            'Start_Paid'   =>  'sometimes',
            'Start_UnPaid' =>  'sometimes',
            'Open_Balnc'   =>  'sometimes',
            'Curnt_Balnc'  =>  'sometimes',
            'Start_Lasthld'=>  'sometimes',
            'Last_Ret_Dt'  =>  'sometimes',
            'Unpad_Nxtyer' =>  'sometimes',
            'Pat_First'    =>  'sometimes',
            'Pat_Hld'      =>  'sometimes',
            'Inc_Typ'      =>  'sometimes',
            'Inc_Yer'      =>  'sometimes',
            'Inc_days'     =>  'sometimes',
            'Tkt_No'       =>  'sometimes',
            'Tkt_Val'      =>  'sometimes',
            'Tkt_Pth'      =>  'sometimes',
            'Hold_Estmdt'  =>  'sometimes',
            'Hold_Lstdt'   =>  'sometimes',
            'HLdy_Ty'      =>  'sometimes',
            'HLd_Period'   =>  'sometimes',
            'Hold_Blnc'    =>  'sometimes',
            'Hold_Ndys'    =>  'sometimes',
            'Last_Hldstdt' =>  'sometimes',
            'Last_Hldendt' =>  'sometimes',
            'Last_Hldrtdt' =>  'sometimes',
            'Last_Hldprod' =>  'sometimes',
            'Last_Hldrqno' =>  'sometimes',
            'Last_Hldrqty' =>  'sometimes',
            'Hld_No1'      =>  'sometimes',
            'Hld_Prod1'    =>  'sometimes',
            'Hld_Stdt1'    =>  'sometimes',
            'Hld_Rtdt1'    =>  'sometimes',
            'Hld_Endt1'    =>  'sometimes',
            'Isu_Bln1'     =>  'sometimes',
            'Hld_No2'      =>  'sometimes',
            'Hld_Prod2'    =>  'sometimes',
            'Hld_Stdt2'    =>  'sometimes',
            'Hld_Endt2'    =>  'sometimes',
            'Hld_Rtdt2'    =>  'sometimes',
            'Isu_Bln2'     =>  'sometimes',
            'Hld_No3'      =>  'sometimes',
            'Hld_Prod3'    =>  'sometimes',
            'Hld_Stdt3'    =>  'sometimes',
            'Hld_Rtdt3'    =>  'sometimes',
            'Hld_Endt3'    =>  'sometimes',
            'Isu_Bln3'     =>  'sometimes',
            'Hld_No4'      =>  'sometimes',
            'Hld_Prod4'    =>  'sometimes',
            'Hld_Stdt4'    =>  'sometimes',
            'Hld_Rtdt4'    =>  'sometimes',
            'Hld_Endt4'    =>  'sometimes',
            'Isu_Bln4'     =>  'sometimes',
            'Hld_No5'      =>  'sometimes',
            'Hld_Prod5'    =>  'sometimes',
            'Hld_Stdt5'    =>  'sometimes',
            'Hld_Rtdt5'    =>  'sometimes',
            'Hld_Endt5'    =>  'sometimes',
            'Isu_Bln5'     =>  'sometimes',
            'Tkt_Sector'   =>  'sometimes',
            'Tkt_Sector1'  =>  'sometimes',
            'Tkt_Sector2'  =>  'sometimes',
            'HldTrnsp_No'  =>  'sometimes',
            'HldTrnsp_No1' =>  'sometimes',
            'HldTrnsp_No2' =>  'sometimes',
            'Tkt_No1'      =>  'sometimes',
            'Tkt_No2'      =>  'sometimes',
            'Tkt_Class'    =>  'sometimes',
            'Tkt_Class1'   =>  'sometimes',
            'Tkt_Class2'   =>  'sometimes',
            'Tkt_Ty1'      =>  'sometimes',
            'Tkt_Ty2'      =>  'sometimes',
            'Tkt_Ty3'      =>  'sometimes',
            'Tkt_Ty4'      =>  'sometimes',
            'Tkt_Ty5'      =>  'sometimes',
            'Tkt_Ty6'      =>  'sometimes',
            'Tkt_Ty7'      =>  'sometimes',
            'Cnt_Period'   =>  'sometimes',
            'DueDt_Hldy'   =>  'sometimes',
            'DueDt_HldyHij'=>  'sometimes',
            'DueDt_Tkt'    =>  'sometimes',
            'DueDt_TktHij' =>  'sometimes',
            'Visainout_ActDt' =>  'sometimes',
            'Visainout_ExtDt' =>  'sometimes',
            'Visainout_Period'=>  'sometimes',
            'Visainout_Type'  =>  'sometimes',
            'Visainout_ID'    =>  'sometimes',
        ];
    }

    public function messages()
    {
        return [
            'Cmp_No.required'  => 'الشركه مطلوبه',
            'Emp_No.required'  => 'اختيارالموظف مطلوب',
        ];
    }
}
