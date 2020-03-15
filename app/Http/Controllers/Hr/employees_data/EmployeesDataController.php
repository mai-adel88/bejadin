<?php


namespace App\Http\Controllers\Hr\employees_data;

use App\DataTables\Hr\EmployeesDataDataTable;
use App\Models\Hr\HREmpCnt;
use App\city;
use App\Models\Hr\country;
use App\Models\Hr\HrEmpmfs;
use App\Models\Hr\HREmpAttach; // المرفقات
use App\Models\Hr\DepmCmp;
use App\Models\Hr\HREmpadr; // العناوين
use App\Models\Hr\Pyjobs;
use App\Models\Hr\HrAstPorts; 
use App\Models\Admin\GLaccBnk;
use App\Models\Hr\LocClass;
use App\Models\Hr\HrOwnrmf; // الكفيل
use App\Models\Hr\HRMainCmpnam; // الشركات
use App\Models\Hr\HrAstPlcLicns; // اماكن التراخيص
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;

use Up;

class EmployeesDataController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param MainCompanyDataTable $dataTable
     * @return Response
     */
    public function index(EmployeesDataDataTable $dataTable)
    {
        return $dataTable->render('hr.employee_data.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $last = HrEmpmfs::orderBy('ID_No', 'DESC')->latest()->first(); //latest record
        if(!empty($last) || $last || $last < 0){
            $last = $last->Emp_No +1;
        }else{
            $last =  1;
        }

        $companies = HRMainCmpnam::get();   // الشركات
        $departments = DepmCmp::get();      // الاقسام
        $jobs = Pyjobs::get();              // الوظائف
        $administrations = LocClass::get(); // الادارة
        $ports = HrAstPorts::get();        // منافذ الدخول والمغادره
        $countries = country::get();        //الدول
        $cities = city::get();              //المدينه

        // البنك للشركه )التعاقد)
        $flags = GLaccBnk::all();
        $banks = [];
        foreach ($flags as $flag) {
            if ($flag->Bank_No == 1) {
                array_push($banks, $flag);
            }
        }

        //الوظيفه بالشركه / بالشئون
        $job_cmp = Pyjobs::where('job_cmpny', 1)->get();
        //الوظيفه بالحكومه / تأشيرة القدوم
        $job_gov = Pyjobs::where('job_gov', 1)->get();
        $job_affairs = Pyjobs::where('job_cmpny', 1)->get();        // الوظيفة بالشئون
        $licences = HrAstPlcLicns::where('cty_jobactv', 1)->get(); // الترخيص
        $drivelicences = HrAstPlcLicns::where('cty_drivlic', 1)->get(); // ماكن اصدار رخصة القيادة
        $residencelicences = HrAstPlcLicns::where('cty_resident', 1)->get(); // الاقامة
        $civilcelicences = HrAstPlcLicns::where('cty_Nat_id', 1)->get(); // الهوية
        $job_techs = Pyjobs::where('job_tech', 1)->get(); // التخصص المهنى
        $owners = HrOwnrmf::get(); // الكفيل

        return view('hr.employee_data.create', compact('ports','owners','full_names','civilcelicences','residencelicences','drivelicences','job_techs','licences','companies','jobs','departments','last','administrations', 'banks','countries','cities','job_cmp','job_gov'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     * @throws ValidationException
     */
    public function store(Request $request)
    {
    // dd($request->all());
        $data = $this->validate($request, [
            'Cmp_No'    => 'required', // رقم الشركة
            'SubCmp_No' =>'sometimes', // القسم
            'Emp_SubNo' =>'sometimes', // رقم الموظف بالقسم
            'Emp_Type'  =>'sometimes', // تصنيف العمالة
            'Emp_No'    => 'sometimes', // رقم
            'Emp_NmAr'  =>'sometimes', // الاسم
            'Emp_NmAr1' => 'sometimes',
            'Emp_NmAr2' => 'sometimes',
            'Emp_NmAr3' => 'sometimes',
            'Emp_NmAr4' => 'sometimes',
            'Emp_NmEn1' => 'sometimes',
            'Emp_NmEn2' => 'sometimes',
            'Emp_NmEn3' => 'sometimes',
            'Emp_NmEn4' => 'sometimes',
            'Emp_NmEn'  =>'sometimes', // الاسم بالانجليزى
            'Cntry_No'  =>'sometimes', // الجنسية
            'Birth_Date'=>'sometimes', // تاريخ الميلاد
            'Reljan'    =>'sometimes', // الديانة
            'Birth_Plac'=>'sometimes', // مكان الميلاد
            'Int_Ext'   =>'sometimes', // خارجى 2 داخلى 1
            'Under_Test'=>'sometimes', // تحت التجربة
            'Gender'    =>'sometimes', // ذكر  انثى
            'Start_Date'=>'sometimes', // تاريخ التعيين
            'Start_DateHij'=>'sometimes', //  هجرى تاريخ التعيين
            'Depm_No'   =>'sometimes', // الادارة
            'Residn_Chld'=>'sometimes', // المرافقين
            'Blood_Type'=>'sometimes', // فصيلة الدم
            'On_WorkDt' =>'sometimes', // تايخ مباشرة العمل
            'On_WorkDtHij'=>'sometimes', // تايخ مباشرة العمل هجرى
            'Job_Stu'=>'sometimes', // الحالة
            
            'Status_Type'=>'sometimes', // الحالة الاجتماعية
            'End_Tstdt'  =>'sometimes', // انهاء التجربة
            'End_TstdtHij'=>'sometimes', // انهاء التجربة هجرى
            'Job_No'    =>'sometimes', // الوظيفة
            'Educt_Type'=>'sometimes', // الحالة التعليمية
            
            'Ownr_No'=>'sometimes', // الكفيل
            'EmpType_No'=>'sometimes', // فئة الموظف
            'Bsc_Salary'=>'sometimes',
            
            // تراخيص مزاولة المهنة
            'Rcrd_LicNo1' => 'sometimes',
            'Rcrd_Endt' => 'sometimes',
            'Rcrd_Rnwdt' => 'sometimes',
            'Rcrd_Stdt' => 'sometimes',
            'JobCtg_No1' => 'sometimes',
            'JobCtg_No' => 'sometimes',
            'JobPLc_No' => 'sometimes',
            'Jobknd_No' => 'sometimes',
            'Rcrd_LicNo' => 'sometimes',
            'Rcrd_LicTyp' => 'sometimes', // الفئة
            'Rcrd_LicTyp1' => 'sometimes', // الفئة بطاقة التسجيل المهنى
            // بياانت الجواز
            'Pasprt_No' => 'sometimes',
            'Pasprt_Ty' => 'sometimes',
            'Pasprt_Plc' => 'sometimes',
            'Pasprt_Sdt' => 'sometimes',
            'Pasprt_Edt' => 'sometimes',
            'Pasprt_Nt' => 'sometimes',
            'In_Job' => 'sometimes',
            'In_VisaNo' => 'sometimes',
            'In_VisaDt' => 'sometimes',
            'In_Port' => 'sometimes',
            'In_Date' => 'sometimes',
            'In_EntrNo' => 'sometimes',
            'Out_VisaNo' => 'sometimes',
            'Out_VisaDt' => 'sometimes',
            'Out_Date' => 'sometimes',
            'Out_Port' => 'sometimes',
            'Trnsfer_Dt' => 'sometimes',
            'Trnsfer_OLdNm' => 'sometimes',
            'Psprt_Rcv' => 'sometimes', // الجواز موجود نعم
            // الهوية
            'Budg_typ' => 'sometimes',
            'Cnt_Endt' => 'sometimes', // نهاية التعقاد
            'Ensurans_No' => 'sometimes', // رقم التامينات الاجتماعية
            'Work_Lic' => 'sometimes', // Work_Lic ملف مكتب العمل 
            'Specl_Need' => 'sometimes', // طبيعى / احتياجات خاصة
            'Lic_Plc' => 'sometimes',
            'Lic_Typ' => 'sometimes',
            'Lic_Edt' => 'sometimes',
            'Lic_Sdt' => 'sometimes',
            'Lic_No' => 'sometimes',
            'Work_PLC' => 'sometimes', // مكان الاصدار
            'Work_Endt' => 'sometimes', // 
            'Work_StDt' => 'sometimes', //  
            'Residn_Plc' => 'sometimes', // مكان الاصدار
            'Residn_Ty' => 'sometimes', // النوع
            'Residn_Edt' => 'sometimes', // الانتهاء
            'Residn_Sdt' => 'sometimes', // الاصدار
            'Civl_No' => 'sometimes', // الرقم المدني
            'CivL_StDt' => 'sometimes', // 
            'Civl_Plc' => 'sometimes', // مكان الانتهاء
            'Residn_No' => 'sometimes', //   // بيانات الاقامه الرقم
            'Cnt_Period' => 'sometimes', // نهاية التعاقد
            'MJob_No' => 'sometimes', // الوظيفه بالشئون
            'Month_Salry' => 'sometimes', // الراتب بالشركة
            'MMonth_Salry' => 'sometimes', // الراتب بالشئون
            // HREmpAttach
            'Attch_No' => 'sometimes',
            'Ln_No' => 'sometimes',
            'Attch_Ty' => 'sometimes',
            'Attch_Desc' => 'sometimes' ,
        ]);

        if($request->Gross_Salary){
            //التعاقد
            // dd($request->Gross_Salary);
            $emp = $this->validate($request, [
                'Bsc_Salary'=> 'sometimes',
                'Hous_Alw'  => 'sometimes',
                'Emp_NmAr'  => 'sometimes',
                'Emp_NmEn'  => 'sometimes',
                'Emp_No'    => 'sometimes', // رقم
                'Trnsp_Alw' => 'sometimes',
                'Food_Alw' => 'sometimes',
                'Other_Alw' => 'sometimes',
                'Add_Alw' => 'sometimes',
                'ALw1' => 'sometimes',
                'ALw2' => 'sometimes',
                'ALw3' => 'sometimes',
                'ALw4' => 'sometimes',
                'ALw5' => 'sometimes',
                'Gross_Salary'  => 'sometimes',
                'Huspym_No'     => 'sometimes',
                'Wrk_Hour'      => 'sometimes',
                'Wrk_CostHour'  => 'sometimes',
                'Total_Wrk_CostHour' => 'sometimes',
                'Wrk_OvrTime'   => 'sometimes',
                'OvrTime_Rate'  => 'sometimes',
                'OvrTime_HR1'   => 'sometimes',
                'OvrTime_HR2'   => 'sometimes',
                'OvrTime_HR3'   => 'sometimes',
                'Lunch_hour'    => 'sometimes',
                'Cnt_Stdt'      => 'sometimes',
                'Cnt_StdtHij'   => 'sometimes',
                'Cnt_Endt'      => 'sometimes',
                'Cnt_EndtHij'   => 'sometimes',
                'Cnt_Nwdt'      => 'sometimes',
                'Cnt_NwdtHij'   => 'sometimes',
                'Start_Date'    => 'sometimes',
                'Start_DateHij' => 'sometimes',
                'Dection_ExpireDt'=> 'sometimes',
                'Bouns_Prct'    => 'sometimes',
                'Start_Paid'    => 'sometimes',
                'Start_UnPaid'  => 'sometimes',
                'Fbal_Db'       => 'sometimes',
                'Fbal_CR'       => 'sometimes',
                'Acc_NoDb1'     => 'sometimes',
                'Prj_No'        => 'sometimes',
                'PjLoc_No'      => 'sometimes',
                'Tkt_No2'       => 'sometimes',
                'Tkt_Class2'    => 'sometimes',
                'Tkt_Sector2'   => 'sometimes',
                'Tkt_No'        => 'sometimes',
            ]);
            HREmpCnt::create($emp);
        }

        if($request->HLdy_Ty || $request->HLd_Period){
            // dd('اجازات');
            // dd($request->HLdy_Ty, $request->HLd_Period);
            $hlds = $this->validate($request, [
                'Cmp_No'        => 'sometimes',
                'Emp_No'        => 'sometimes',
                'Gender'        => 'sometimes',
                'Tkt_No2'       => 'sometimes',
                'Tkt_Class2'    => 'sometimes',
                'Tkt_Sector2'   => 'sometimes',
                'Tkt_No'        => 'sometimes',
                'Cnt_Period'    => 'sometimes',
                'HLd_Period'    => 'sometimes',
                'DueDt_Hldy'    => 'sometimes',
                'DueDt_HldyHij' => 'sometimes',
                'DueDt_Tkt'     => 'sometimes',
                'DueDt_TktHij'  => 'sometimes',
                'HLdy_Ty'       => 'sometimes',
                'HldTrnsp_No'   => 'sometimes',
                'Tkt_Class'     => 'sometimes',
                'Tkt_Sector'    => 'sometimes',
                'HldTrnsp_No1'  => 'sometimes',
                'Tkt_No1'       => 'sometimes',
                'Tkt_Class1'    => 'sometimes',
                'Tkt_Sector1'   => 'sometimes',
                'HldTrnsp_No2'  => 'sometimes',
                'Tkt_Sector1'   => 'sometimes',
                'Tkt_Ty1'       => 'sometimes',
                'Tkt_Ty2'       => 'sometimes',
                'Tkt_Ty3'       => 'sometimes',
                'Tkt_Ty4'       => 'sometimes',
                'Tkt_Ty5'       => 'sometimes',
                'Tkt_Ty6'       => 'sometimes',
                'Tkt_Ty7'       => 'sometimes',
            ]);
            HREmpCnt::create($hlds);
        }

        if($request->Cntry_No || $request->Emp_City|| $request->Adrs_Nerst || $request->RefPerson_Nm){
            // dd('العناوين');
            $address = $this->validate($request, [
                'Cmp_No'        => 'sometimes',
                'Emp_No'        => 'sometimes',
                'Cntry_No'      => 'sometimes',
                'Phon_Cntry'    => 'sometimes',
                'Emp_Adrs'      => 'sometimes',
                'Name_Nerst'    => 'sometimes',
                'Phon_nerst'    => 'sometimes',
                'Adrs_Nerst'    => 'sometimes',
                'Notes'         => 'sometimes',
                'Emp_City'      => 'sometimes',
                'Stat_No'       => 'sometimes',
                'Emp_Street'    => 'sometimes',
                'Emp_Phon'      => 'sometimes',
                'Emp_Mobile'    => 'sometimes',
                'E_Email'       => 'sometimes',
                'RefPerson_Nm'  => 'sometimes',
                'RefPerson_Mobile'=> 'sometimes',
            ]);
            HREmpadr::create($address);
        }

        if ($request->hasFile('Photo')) {
            $validateAttach = $this->validate($request,[
                'Photo.*' => 'required',
                'Cmp_No.*' => 'sometimes',
                'Emp_No.*' => 'sometimes',
                'Attch_No.*' => 'sometimes',
                'Ln_No.*' => 'sometimes',
                'Attch_Ty.*' => 'sometimes',
                'Attch_Desc.*' => 'sometimes',
                
            ],[],[
                'Photo' => trans('admin.photo'),
            ]);
            foreach ($request->Photo as  $key => $Photo)
            {
                
                $filePath = 'files/employees';
                $extension = $Photo->getClientOriginalExtension();
                $name = $Photo->getClientOriginalName(); 
                $fileName = $name . '_' . time() . '.' .$extension;
                $Photo->move($filePath, $fileName);
                HREmpAttach::create([
                    'Photo' => $filePath.$fileName,
                    'Cmp_No' => $request->Cmp_No,
                    'Emp_No' => $request->Emp_No,
                    'Attch_No' => $request->Attch_No[$key],
                    'Ln_No' => $request->Ln_No[$key],
                    'Attch_Ty' => $request->Attch_Ty[$key],
                    'Attch_Desc' => $request->Attch_Desc[$key],
    
                ]);
            }
        }

        
        if($request->Emp_NmAr1 Or $request->Emp_NmAr2 Or $request->Emp_NmAr3 Or $request->Emp_NmAr4){
            $data['Emp_NmAr'] = $request->Emp_NmAr1 .' '. $request->Emp_NmAr2 .' '. $request->Emp_NmAr3 .' '. $request->Emp_NmAr4;
        }
        if($request->Emp_NmAr1 Or $request->Emp_NmAr2 Or $request->Emp_NmAr3 Or $request->Emp_NmAr4){
            $data['Emp_NmEn'] = $request->Emp_NmEn1 .' '. $request->Emp_NmEn2 .' '. $request->Emp_NmEn3 .' '. $request->Emp_NmEn4;
        }

        // dd($data);
        HrEmpmfs::create($data);
        return redirect()->route('employeeData.index')->with(session()->flash('message',trans('hr.add_success')));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($ID_NO)
    {
        $emp_data = HrEmpmfs::findOrFail($ID_NO);
        $companies = HRMainCmpnam::get(); // الشركات
        $departments = DepmCmp::get();    // الاقسام
        $jobs = Pyjobs::get();            // الوظائف
        $administrations = LocClass::get(); // الادارة
        $countries = country::get();    //الدول
        $cities = city::get();          //المدينه
        $ports = HrAstPorts::get();    // منافذ الدخول والمغادره

        // البنك للشركه )التعاقد)
        $flags = GLaccBnk::all();
        $banks = [];
        foreach ($flags as $flag) {
            if ($flag->Bank_No == 1) {
                array_push($banks, $flag);
            }
        }

        //الوظيفه بالشركه / بالشئون
        $job_cmp = Pyjobs::where('job_cmpny', 1)->get();
        //الوظيفه بالحكومه / تأشيرة القدوم
        $job_gov = Pyjobs::where('job_gov', 1)->get();
        $job_affairs = Pyjobs::where('job_cmpny', 1)->get(); // الوظيفة بالشئون
        $licences = HrAstPlcLicns::where('cty_jobactv', 1)->get(); // الترخيص
        $drivelicences = HrAstPlcLicns::where('cty_drivlic', 1)->get(); // ماكن اصدار رخصة القيادة
        $residencelicences = HrAstPlcLicns::where('cty_resident', 1)->get(); // الاقامة
        $civilcelicences = HrAstPlcLicns::where('cty_Nat_id', 1)->get(); // الهوية
        $job_techs = Pyjobs::where('job_tech', 1)->get(); // التخصص المهنى

        return view('hr.employee_data.show', compact(['ports','civilcelicences','residencelicences','drivelicences','job_techs','licences','emp_data','companies','jobs','departments','administrations', 'banks','countries','cities','job_cmp','job_gov']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($ID_NO)
    {
        $emp_data = HrEmpmfs::findOrFail($ID_NO);
        $companies = HRMainCmpnam::get();   // الشركات
        $departments = DepmCmp::get();      // الاقسام
        $jobs = Pyjobs::get();              // الوظائف
        $ports = HrAstPorts::get();        // منافذ الدخول والمغادره
        $administrations = LocClass::get(); // الادارة
        $countries = country::get();        //الدول
        $cities = city::get();              //المدينه

        // البنك للشركه )التعاقد)
        $flags = GLaccBnk::all();
        $banks = [];
        foreach ($flags as $flag) {
            if ($flag->Bank_No == 1) {
                array_push($banks, $flag);
            }
        }

        //الوظيفه بالشركه / بالشئون
        $job_cmp = Pyjobs::where('job_cmpny', 1)->get();
        //الوظيفه بالحكومه / تأشيرة القدوم
        $job_gov = Pyjobs::where('job_gov', 1)->get();
        $job_affairs = Pyjobs::where('job_cmpny', 1)->get();        // الوظيفة بالشئون
        $licences = HrAstPlcLicns::where('cty_jobactv', 1)->get(); // الترخيص
        $drivelicences = HrAstPlcLicns::where('cty_drivlic', 1)->get(); // ماكن اصدار رخصة القيادة
        $residencelicences = HrAstPlcLicns::where('cty_resident', 1)->get(); // الاقامة
        $civilcelicences = HrAstPlcLicns::where('cty_Nat_id', 1)->get(); // الهوية
        $job_techs = Pyjobs::where('job_tech', 1)->get();               // التخصص المهنى

        return view('hr.employee_data.edit', compact('ports','civilcelicences','residencelicences','drivelicences','job_techs','licences','emp_data','companies','jobs','departments','administrations', 'banks','countries','cities','job_cmp','job_gov'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $ID_NO)
    {
// dd($request->all());
        $update_emp = HrEmpmfs::findOrFail($ID_NO);
        $update_empCnt = HREmpCnt::where('ID_No', $ID_NO)->find($ID_NO);
        $update_empadr = HREmpadr::where('ID_No', $ID_NO)->find($ID_NO);
        $data = $this->validate($request, [
            'Cmp_No'    => 'required', // رقم الشركة
            'SubCmp_No' =>'sometimes', // القسم
            'Emp_SubNo' =>'sometimes', // رقم الموظف بالقسم
            'Emp_Type'  =>'sometimes', // تصنيف العمالة
            'Emp_No'    => 'sometimes', // رقم
            'Emp_NmAr'  =>'sometimes', // الاسم
            'Emp_NmAr1' => 'sometimes',
            'Emp_NmAr2' => 'sometimes',
            'Emp_NmAr3' => 'sometimes',
            'Emp_NmAr4' => 'sometimes',
            'Emp_NmEn1' => 'sometimes',
            'Emp_NmEn2' => 'sometimes',
            'Emp_NmEn3' => 'sometimes',
            'Emp_NmEn4' => 'sometimes',
            'Emp_NmEn'  =>'sometimes', // الاسم بالانجليزى
            'Cntry_No'  =>'sometimes', // الجنسية
            'Birth_Date'=>'sometimes', // تاريخ الميلاد
            'Reljan'    =>'sometimes', // الديانة
            'Birth_Plac'=>'sometimes', // مكان الميلاد
            'Int_Ext'   =>'sometimes', // خارجى 2 داخلى 1
            'Under_Test'=>'sometimes', // تحت التجربة
            'Gender'    =>'sometimes', // ذكر  انثى
            'Start_Date'=>'sometimes', // تاريخ التعيين
            'Start_DateHij'=>'sometimes', //  هجرى تاريخ التعيين
            'Depm_No'   =>'sometimes', // الادارة
            'Residn_Chld'=>'sometimes', // المرافقين
            'Blood_Type'=>'sometimes', // فصيلة الدم
            'On_WorkDt' =>'sometimes', // تايخ مباشرة العمل
            'On_WorkDtHij'=>'sometimes', // تايخ مباشرة العمل هجرى
            'Job_Stu'=>'sometimes', // الحالة
            
            'Status_Type'=>'sometimes', // الحالة الاجتماعية
            'End_Tstdt'  =>'sometimes', // انهاء التجربة
            'End_TstdtHij'=>'sometimes', // انهاء التجربة هجرى
            'Job_No'    =>'sometimes', // الوظيفة
            'Educt_Type'=>'sometimes', // الحالة التعليمية
            
            'Ownr_No'=>'sometimes', // الكفيل
            'EmpType_No'=>'sometimes', // فئة الموظف
            'Bsc_Salary'=>'sometimes',
            
            // تراخيص مزاولة المهنة
            'Rcrd_LicNo1' => 'sometimes',
            'Rcrd_Endt' => 'sometimes',
            'Rcrd_Rnwdt' => 'sometimes',
            'Rcrd_Stdt' => 'sometimes',
            'JobCtg_No1' => 'sometimes',
            'JobCtg_No' => 'sometimes',
            'JobPLc_No' => 'sometimes',
            'Jobknd_No' => 'sometimes',
            'Rcrd_LicNo' => 'sometimes',
            'Rcrd_LicTyp' => 'sometimes', // الفئة
            'Rcrd_LicTyp1' => 'sometimes', // الفئة بطاقة التسجيل المهنى
            // بياانت الجواز
            'Pasprt_No' => 'sometimes',
            'Pasprt_Ty' => 'sometimes',
            'Pasprt_Plc' => 'sometimes',
            'Pasprt_Sdt' => 'sometimes',
            'Pasprt_Edt' => 'sometimes',
            'Pasprt_Nt' => 'sometimes',
            'In_Job' => 'sometimes',
            'In_VisaNo' => 'sometimes',
            'In_VisaDt' => 'sometimes',
            'In_Port' => 'sometimes',
            'In_Date' => 'sometimes',
            'In_EntrNo' => 'sometimes',
            'Out_VisaNo' => 'sometimes',
            'Out_VisaDt' => 'sometimes',
            'Out_Date' => 'sometimes',
            'Out_Port' => 'sometimes',
            'Trnsfer_Dt' => 'sometimes',
            'Trnsfer_OLdNm' => 'sometimes',
            'Psprt_Rcv' => 'sometimes', // الجواز موجود نعم
            // الهوية
            'Budg_typ' => 'sometimes',
            'Cnt_Endt' => 'sometimes', // نهاية التعقاد
            'Ensurans_No' => 'sometimes', // رقم التامينات الاجتماعية
            'Work_Lic' => 'sometimes', // Work_Lic ملف مكتب العمل 
            'Specl_Need' => 'sometimes', // طبيعى / احتياجات خاصة
            'Lic_Plc' => 'sometimes',
            'Lic_Typ' => 'sometimes',
            'Lic_Edt' => 'sometimes',
            'Lic_Sdt' => 'sometimes',
            'Lic_No' => 'sometimes',
            'Work_PLC' => 'sometimes', // مكان الاصدار
            'Work_Endt' => 'sometimes', // 
            'Work_StDt' => 'sometimes', //  
            'Residn_Plc' => 'sometimes', // مكان الاصدار
            'Residn_Ty' => 'sometimes', // النوع
            'Residn_Edt' => 'sometimes', // الانتهاء
            'Residn_Sdt' => 'sometimes', // الاصدار
            'Civl_No' => 'sometimes', // الرقم المدني
            'CivL_StDt' => 'sometimes', // 
            'Civl_Plc' => 'sometimes', // مكان الانتهاء
            'Residn_No' => 'sometimes', //   // بيانات الاقامه الرقم
            'Cnt_Period' => 'sometimes', // نهاية التعاقد
            'MJob_No' => 'sometimes', // الوظيفه بالشئون
            'Month_Salry' => 'sometimes', // الراتب بالشركة
            'MMonth_Salry' => 'sometimes', // الراتب بالشئون
            // HREmpAttach
            'Attch_No' => 'sometimes',
            'Ln_No' => 'sometimes',
            'Attch_Ty' => 'sometimes',
            'Attch_Desc' => 'sometimes' ,
        ]);

        if($request->Gross_Salary){
            //التعاقد
            // dd($request->Gross_Salary);
            $emp = $this->validate($request, [
                'Bsc_Salary'=> 'sometimes',
                'Hous_Alw'  => 'sometimes',
                'Emp_NmAr'  => 'sometimes',
                'Emp_NmEn'  => 'sometimes',
                'Emp_No'    => 'sometimes', // رقم
                'Trnsp_Alw' => 'sometimes',
                'Food_Alw' => 'sometimes',
                'Other_Alw' => 'sometimes',
                'Add_Alw' => 'sometimes',
                'ALw1' => 'sometimes',
                'ALw2' => 'sometimes',
                'ALw3' => 'sometimes',
                'ALw4' => 'sometimes',
                'ALw5' => 'sometimes',
                'Gross_Salary'  => 'sometimes',
                'Huspym_No'     => 'sometimes',
                'Wrk_Hour'      => 'sometimes',
                'Wrk_CostHour'  => 'sometimes',
                'Total_Wrk_CostHour' => 'sometimes',
                'Wrk_OvrTime'   => 'sometimes',
                'OvrTime_Rate'  => 'sometimes',
                'OvrTime_HR1'   => 'sometimes',
                'OvrTime_HR2'   => 'sometimes',
                'OvrTime_HR3'   => 'sometimes',
                'Lunch_hour'    => 'sometimes',
                'Cnt_Stdt'      => 'sometimes',
                'Cnt_StdtHij'   => 'sometimes',
                'Cnt_Endt'      => 'sometimes',
                'Cnt_EndtHij'   => 'sometimes',
                'Cnt_Nwdt'      => 'sometimes',
                'Cnt_NwdtHij'   => 'sometimes',
                'Start_Date'    => 'sometimes',
                'Start_DateHij' => 'sometimes',
                'Dection_ExpireDt'=> 'sometimes',
                'Bouns_Prct'    => 'sometimes',
                'Start_Paid'    => 'sometimes',
                'Start_UnPaid'  => 'sometimes',
                'Fbal_Db'       => 'sometimes',
                'Fbal_CR'       => 'sometimes',
                'Acc_NoDb1'     => 'sometimes',
                'Prj_No'        => 'sometimes',
                'PjLoc_No'      => 'sometimes',
                'Tkt_No2'       => 'sometimes',
                'Tkt_Class2'    => 'sometimes',
                'Tkt_Sector2'   => 'sometimes',
                'Tkt_No'        => 'sometimes',
            ]);
            $update_empCnt->update($data);  //HREmpCnt

        }

        if($request->HLdy_Ty || $request->HLd_Period){
            // dd('اجازات');
            // dd($request->HLdy_Ty, $request->HLd_Period);
            $hlds = $this->validate($request, [
                'Cmp_No'        => 'sometimes',
                'Emp_No'        => 'sometimes',
                'Gender'        => 'sometimes',
                'Tkt_No2'       => 'sometimes',
                'Tkt_Class2'    => 'sometimes',
                'Tkt_Sector2'   => 'sometimes',
                'Tkt_No'        => 'sometimes',
                'Cnt_Period'    => 'sometimes',
                'HLd_Period'    => 'sometimes',
                'DueDt_Hldy'    => 'sometimes',
                'DueDt_HldyHij' => 'sometimes',
                'DueDt_Tkt'     => 'sometimes',
                'DueDt_TktHij'  => 'sometimes',
                'HLdy_Ty'       => 'sometimes',
                'HldTrnsp_No'   => 'sometimes',
                'Tkt_Class'     => 'sometimes',
                'Tkt_Sector'    => 'sometimes',
                'HldTrnsp_No1'  => 'sometimes',
                'Tkt_No1'       => 'sometimes',
                'Tkt_Class1'    => 'sometimes',
                'Tkt_Sector1'   => 'sometimes',
                'HldTrnsp_No2'  => 'sometimes',
                'Tkt_Sector1'   => 'sometimes',
                'Tkt_Ty1'       => 'sometimes',
                'Tkt_Ty2'       => 'sometimes',
                'Tkt_Ty3'       => 'sometimes',
                'Tkt_Ty4'       => 'sometimes',
                'Tkt_Ty5'       => 'sometimes',
                'Tkt_Ty6'       => 'sometimes',
                'Tkt_Ty7'       => 'sometimes',
            ]);
            $update_empCnt->update($data);  //HREmpCnt
        }

        if($request->Cntry_No || $request->Emp_City|| $request->Adrs_Nerst || $request->RefPerson_Nm){
            // dd('العناوين');
            $address = $this->validate($request, [
                'Cmp_No'        => 'sometimes',
                'Emp_No'        => 'sometimes',
                'Cntry_No'      => 'sometimes',
                'Phon_Cntry'    => 'sometimes',
                'Emp_Adrs'      => 'sometimes',
                'Name_Nerst'    => 'sometimes',
                'Phon_nerst'    => 'sometimes',
                'Adrs_Nerst'    => 'sometimes',
                'Notes'         => 'sometimes',
                'Emp_City'      => 'sometimes',
                'Stat_No'       => 'sometimes',
                'Emp_Street'    => 'sometimes',
                'Emp_Phon'      => 'sometimes',
                'Emp_Mobile'    => 'sometimes',
                'E_Email'       => 'sometimes',
                'RefPerson_Nm'  => 'sometimes',
                'RefPerson_Mobile'=> 'sometimes',
            ]);
            $update_empadr->update($data);  //HREmpadr

        }

        if ($request->hasFile('Photo')) {
            $validateAttach = $this->validate($request,[
                'Photo.*' => 'required',
                'Cmp_No.*' => 'sometimes',
                'Emp_No.*' => 'sometimes',
                'Attch_No.*' => 'sometimes',
                'Ln_No.*' => 'sometimes',
                'Attch_Ty.*' => 'sometimes',
                'Attch_Desc.*' => 'sometimes',
                
            ],[],[
                'Photo' => trans('admin.photo'),
            ]);
            foreach ($request->Photo as  $key => $Photo)
            {
                
                $filePath = 'files/employees';
                $extension = $Photo->getClientOriginalExtension();
                $name = $Photo->getClientOriginalName(); 
                $fileName = $name . '_' . time() . '.' .$extension;
                $Photo->move($filePath, $fileName);
                HREmpAttach::create([
                    'Photo' => $filePath.$fileName,
                    'Cmp_No' => $request->Cmp_No,
                    'Emp_No' => $request->Emp_No,
                    'Attch_No' => $request->Attch_No[$key],
                    'Ln_No' => $request->Ln_No[$key],
                    'Attch_Ty' => $request->Attch_Ty[$key],
                    'Attch_Desc' => $request->Attch_Desc[$key],
    
                ]);
            }
        }


        
// dd($data);
        if($request->Emp_NmAr1 Or $request->Emp_NmAr2 Or $request->Emp_NmAr3 Or $request->Emp_NmAr4){
            $data['Emp_NmAr'] = $request->Emp_NmAr1 .' '. $request->Emp_NmAr2 .' '. $request->Emp_NmAr3 .' '. $request->Emp_NmAr4;
        }
        if($request->Emp_NmAr1 Or $request->Emp_NmAr2 Or $request->Emp_NmAr3 Or $request->Emp_NmAr4){
            $data['Emp_NmEn'] = $request->Emp_NmEn1 .' '. $request->Emp_NmEn2 .' '. $request->Emp_NmEn3 .' '. $request->Emp_NmEn4;
        }
        $update_emp->update($data);

        return redirect()->route('employeeData.index')->with(session()->flash('message',trans('hr.update_success')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($ID_NO)
    {
        $employeedata = HrEmpmfs::findOrFail($ID_NO);
        $employeedata->delete();
        return  redirect()->route('employeeData.index')->with(session()->flash('message', trans('hr.delete_success')));
    }


    public function getdepartment(Request $request)
    {
        if($request->ajax()){
            $departments = DepmCmp::where('Cmp_No',  $request->Cmp_No)->get();
            return view('hr.employee_data.getdepartments', compact('departments'));
        }
    }

    //رقم الموظف بالقسم
    public function createEmpSubNo(Request $request)
    {
        if($request->ajax()){
            $last_sub = HrEmpmfs::where('SubCmp_No', $request->SubCmp_No)->orderBy('ID_No', 'DESC')->latest()->first(); //latest record
            if(!empty($last_sub) || $last_sub || $last_sub < 0){
                $last_sub = $last_sub->Emp_SubNo +1;
            }else{
                $last_sub =  1;
            }
            return response()->json($last_sub);
        }   
    }

    // higiri date
    public function convertToDateToHijri(Request $request){
        $hijri = date('Y-m-d',strtotime(\GeniusTS\HijriDate\Hijri::convertToHijri($request->Hijri)));
        return response()->json($hijri);
    }
}
