<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DependentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


    public function rules()
    {
        return [
            'Cmp_No'        =>  'required',
            'Emp_No'        =>  'required',
            'Host_No'       =>  'sometimes',
            'Pasprt_No'     =>  'sometimes',
            'Host_NmAr1'    =>  'sometimes',
            'Host_NmAr2'    =>  'sometimes',
            'Host_NmAr3'    =>  'sometimes',
            'Host_NmAr4'    =>  'sometimes',
            'Host_NmAr'     =>  'sometimes',
            'Host_NmEn1'    =>  'sometimes',
            'Host_NmEn2'    =>  'sometimes',
            'Host_NmEn3'    =>  'sometimes',
            'Host_NmEn4'    =>  'sometimes',
            'Host_NmEn'     =>  'sometimes',
            'Cntry_No'      =>  'sometimes',
            'Gender'        =>  'sometimes',
            'Pasprt_Ty'     =>  'sometimes',
            'Relation'      =>  'sometimes',
            'Birth_dt'      =>  'sometimes',
            'Reljan_No'     =>  'sometimes',
            'Job'           =>  'sometimes',
            'Passprt_No'    =>  'sometimes',
            'Passprt_Sdt'   =>  'sometimes',
            'Passprt_Edt'   =>  'sometimes',
            'Passprt_Plc'   =>  'sometimes',
            'Resid_No'      =>  'sometimes',
            'Resid_Sdt'     =>  'sometimes',
            'Resid_Edt'     =>  'sometimes',
            'Resid_Plc'     =>  'sometimes',
            'Photo'         =>  'sometimes',
            'In_Job'        =>  'sometimes',
            'In_VisaNo'     =>  'sometimes',
            'In_VisaDt'     =>  'sometimes',
            'In_Port'       =>  'sometimes',
            'In_Date'       =>  'sometimes',
            'In_EntrNo'     =>  'sometimes',
            'Out_VisaNo'    =>  'sometimes',
            'Out_VisaDt'    =>  'sometimes',
            'Out_Port'      =>  'sometimes',
            'Out_Date'      =>  'sometimes',
            'Trnsfer_Dt'    =>  'sometimes',
            'Trnsfer_OLdNm' =>  'sometimes',
        ];
    }

    public function messages()
    {
        return [
            'Cmp_No.required' => 'الشركه مطلوبه',
            'Emp_No.required'  => 'اختيارالموظف مطلوب',
        ];
    }


}
