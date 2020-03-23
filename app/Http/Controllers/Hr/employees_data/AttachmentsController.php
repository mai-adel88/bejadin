<?php


namespace App\Http\Controllers\Hr\employees_data;

use App\DataTables\Hr\AttachmentsDataTable;
use App\Models\Hr\HrEmpmfs;
use App\Models\Hr\HREmpAttach; // المرفقات
use App\Models\Hr\HRMainCmpnam; // الشركات

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\ValidationException;
use Up;

class AttachmentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param MainCompanyDataTable $dataTable
     * @return Response
     */
    public function index(AttachmentsDataTable $dataTable)
    {
        return $dataTable->render('hr.attachments.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create(Request $request)
    {
        $last = HREmpAttach::orderBy('ID_NO', 'DESC')->latest()->first(); //latest record
        if(!empty($last) || $last || $last < 0){
            $last = $last->Attch_No +1;
        }else{
            $last =  1;
        }
        $companies = HRMainCmpnam::get();   // الشركات
        $employees = HrEmpmfs::get();   // الموظفين
        return view('hr.attachments.create',compact('last','employees','companies'));
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
        
            $data = $this->validate($request,[
                'Attch_No' => 'required',
                'Photo' => 'required',
                'Cmp_No' => 'required',
                'Emp_No' => 'required',
                'Attch_Ty' => 'required',
                'Ln_No' => 'sometimes',
                'Attch_Desc' => 'sometimes',

            ],[
                'Photo' => trans('admin.photo'),
                'Cmp_No' => trans('admin.Cmp_No'),
                'Emp_No' => trans('admin.Emp_No'),
                'Attch_Ty' => trans('admin.Attch_Ty'),
            ]);

            if($request->hasFile('Photo')){
                $image = $request->Photo;
                $filePath = 'files/attachments/';
                $extension = $image->getClientOriginalExtension();
                $name = $image->getClientOriginalName(); 
                $fileName = $name . '_' . time() . '.' .$extension;
                $image->move($filePath, $fileName);
                $data['Photo'] = $filePath.$fileName;
            }

            $attachment = HREmpAttach::where('Cmp_No',  $request->Cmp_No)->where('Emp_No', $request->Emp_No)->where('Attch_Ty', $request->Attch_Ty)->first();
            
            if($attachment == null){
                HREmpAttach::create($data);
                return redirect()->route('attachments.create')->with(session()->flash('message',trans('hr.add_success')));
            }else{
                $data['Attch_No'] = $attachment->Attch_No;
                $attachment->update($data);
                return redirect()->route('attachments.create')->with(session()->flash('message',trans('hr.add_success')));
            }
            return redirect()->route('attachments.create')->withErrors(trans('hr.fill_required_data'));

            // if ($request->hasFile('Photo')) {
            //     foreach ($request->Photo as  $key => $Photo)
            //     {

            //         $filePath = 'files/attachments/';
            //         $extension = $Photo->getClientOriginalExtension();
            //         $name = $Photo->getClientOriginalName();
            //         $fileName = $name . '_' . time() . '.' .$extension;
            //         $Photo->move($filePath, $fileName);
            //         HREmpAttach::create([
            //             'Photo' => $filePath.$fileName,
            //             'Cmp_No' => $request->Cmp_No,
            //             'Emp_No' => $request->Emp_No,
            //             'Attch_No' => $request->Attch_No[$key],
            //             'Ln_No' => $request->Ln_No[$key],
            //             'Attch_Ty' => $request->Attch_Ty[$key],
            //             'Attch_Desc' => $request->Attch_Desc[$key],
            //         ]);
            //     }
            //     return redirect()->route('attachments.create')->with(session()->flash('message',trans('hr.add_success')));
            // }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($ID_NO)
    {
        $attachemployee = HREmpAttach::findOrFail($ID_NO);
        // $attachment = HREmpAttach::where('Cmp_No',  $request->Cmp_No)->where('Emp_No', $request->Emp_No)->where('Attch_Ty', $request->Attch_Ty)->first();
        $attachments = HREmpAttach::where('Emp_No', $attachemployee->Emp_No)->get();
            
        $employees = HrEmpmfs::get();
        $companies = HRMainCmpnam::get();   // الشركات
        return view('hr.attachments.show', compact('attachemployee','employees','companies','attachments'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($ID_NO)
    {
        $attachment = HREmpAttach::findOrFail($ID_NO);
        $employees = HrEmpmfs::get();
        $companies = HRMainCmpnam::get();   // الشركات
        $emp_type = HrEmpmfs::where('Emp_No', $attachment->Emp_No)->first(); 
        $emp_type = $emp_type->Emp_Type;
        return view('hr.attachments.edit', compact('emp_type','employees','companies','attachment'));
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
        $attachment = HREmpAttach::findOrFail($ID_NO);
        $data = $this->validate($request,[
            'Photo' => 'sometimes',
            'Cmp_No' => 'sometimes',
            'Emp_No' => 'sometimes',
            'Attch_No' => 'sometimes',
            'Ln_No' => 'sometimes',
            'Attch_Ty' => 'sometimes',
            'Attch_Desc' => 'sometimes',

        ],[],[
            
        ]);
            
        if($request->hasFile('Photo')){
            $image = $request->Photo;
            $filePath = 'files/attachments/';
            $extension = $image->getClientOriginalExtension();
            $name = $image->getClientOriginalName(); 
            $fileName = $name . '_' . time() . '.' .$extension;
            $image->move($filePath, $fileName);
            $data['Photo'] = $filePath.$fileName;
        }
        // dd($data);
        $attachment->update($data);
        return redirect()->route('attachments.index')->with(session()->flash('message',trans('hr.update_success')));
        // return redirect()->route('attachments.update',$ID_NO .'/edit')->with(session()->flash('message',trans('hr.update_success')));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($ID_NO)
    {
        $attachment = HREmpAttach::findOrFail($ID_NO);
        $attachment->delete();
        return  redirect()->route('attachments.index')->with(session()->flash('message', trans('hr.delete_success')));
    }


    public function getemployees(Request $request)
    {
        if($request->ajax()){
            $employees = HrEmpmfs::where('Cmp_No',  $request->Cmp_No)->get();
            return view('hr.attachments.getemployee', compact('employees'));
        }
    }

    //تصنيف العمالة
    public function getemployeeType(Request $request)
    {
        if($request->ajax()){
            $emp_type = HrEmpmfs::where('Emp_No', $request->Emp_No)->first(); 
            // dd($emp_type->Emp_Type);
            $emp_type = $emp_type->Emp_Type;
            // dd($emp_type);
            return response()->json($emp_type);
        }
    }

    

    
}
