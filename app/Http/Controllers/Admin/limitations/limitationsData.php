<?php

namespace App\Http\Controllers\Admin\limitations;

use App\DatabaseStorageModel;
use App\Department;
use App\employee;
use App\Http\Controllers\Controller;
use App\limitationReceipts;
use App\limitations;
use App\limitationsType;
use App\operation;
use App\subscription;
use App\supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class limitationsData extends Controller
{
    public function create(Request $request)
    {
       if($request->ajax()){
//           DB::beginTransaction();
//           try {
            $operation = $request->operation;
           $limitations = $request->limitations;
           $limitationType = new \App\limitationsType();
           switch ($request->type){
                    case '1':
                        $limitationType->name_ar = supplier::where('id',$request->tree)->first()->name_ar;
                        $limitationType->name_en = supplier::where('id',$request->tree)->first()->name_en;
                        $limitationType->tree_id = supplier::where('id',$request->tree)->first()->tree_id;
                    break;
                    case '4':
                        $limitationType->name_ar = Department::where('id',$request->tree)->first()->dep_name_ar;
                        $limitationType->name_en = Department::where('id',$request->tree)->first()->dep_name_en;
                        $limitationType->tree_id = Department::where('id',$request->tree)->first()->id;
                    break;
                    case '5':
                        $limitationType->name_ar = employee::where('id',$request->tree)->first()->name_ar;
                        $limitationType->name_en = employee::where('id',$request->tree)->first()->name_en;
                        $limitationType->tree_id = employee::where('id',$request->tree)->first()->tree_id;
                        $limitationType->cc_id = employee::where('id',$request->tree)->first()->cc_id;
                    break;
                   case '2':
                       $limitationType->name_ar = subscription::where('id',$request->tree)->first()->name_ar;
                       $limitationType->name_en = subscription::where('id',$request->tree)->first()->name_en;
                       $limitationType->tree_id = subscription::where('id',$request->tree)->first()->tree_id;
                       $limitationType->cc_id = subscription::where('id',$request->tree)->first()->cc_id;
                   break;
                }
           $limitationType->operation_id = $request->operation;
           if ($request->cc){
               $limitationType->cc_id = $request->cc;
           }
           $limitationType->relation_id = $request->tree;
//           dd($request->dbt,$request->crd);
           if ($request->dbt != null){
               $limitationType->debtor = $request->dbt;
           }else{
               $limitationType->debtor = 0;
           }
           if ($request->crd != null){
               $limitationType->creditor = $request->crd;
           }else{
               $limitationType->creditor = 0;
           }
           $limitationType->note = $request->note_debtor;
           $limitationType->month_for = $request->month_for;
           $limitationType->invoice_id = $request->invoice;
           $limitationType->save();
           $data = \App\limitationsType::where('invoice_id',$request->invoice)->get();
//            } catch (\Exception $e) {
//                DB::rollback();
//            throw $e;
//            } catch (\Throwable $e) {
//                DB::rollback();
//            throw $e;
//            }
           $contents = view('admin.limitations.data_table', ['data' => $data,'limitations' => $limitations])->render();
           return $contents;

        }
    }
    public function editdatatable(Request $request)
    {
       if($request->ajax()){
            $operation = $request->type;
           $limitations = $request->limitations;
           $limitationType = new \App\limitationsType();
           switch ($request->type){
                    case '1':
                        $limitationType->name_ar = supplier::where('id',$request->tree)->first()->name_ar;
                        $limitationType->name_en = supplier::where('id',$request->tree)->first()->name_en;
                        $limitationType->tree_id = supplier::where('id',$request->tree)->first()->tree_id;
                    break;
                    case '4':
                        $limitationType->name_ar = Department::where('id',$request->tree)->first()->dep_name_ar;
                        $limitationType->name_en = Department::where('id',$request->tree)->first()->dep_name_en;
                        $limitationType->tree_id = Department::where('id',$request->tree)->first()->id;
                    break;
                    case '5':
                        $limitationType->name_ar = employee::where('id',$request->tree)->first()->name_ar;
                        $limitationType->name_en = employee::where('id',$request->tree)->first()->name_en;
                        $limitationType->tree_id = employee::where('id',$request->tree)->first()->tree_id;
                        $limitationType->cc_id = employee::where('id',$request->tree)->first()->cc_id;
                    break;
                    case '2':
                        $limitationType->name_ar = subscription::where('id',$request->tree)->first()->name_ar;
                        $limitationType->name_en = subscription::where('id',$request->tree)->first()->name_en;
                        $limitationType->tree_id = subscription::where('id',$request->tree)->first()->tree_id;
                        $limitationType->cc_id = subscription::where('id',$request->tree)->first()->cc_id;
                    break;
                }
           $limitationType->operation_id = $operation;
           if ($request->cc){
               $limitationType->cc_id = $request->cc;
           }
           $limitationType->relation_id = $request->tree;
           if ($request->dbt != null){
               $limitationType->debtor = $request->dbt;
           }else{
               $limitationType->debtor = 0;
           }
           if ($request->crd != null){
               $limitationType->creditor = $request->crd;
           }else{
               $limitationType->creditor = 0;
           }
           $limitationType->note = $request->note_debtor;
           $limitationType->month_for = $request->month_for;
           $limitationType->invoice_id = $request->invoice;
           $limitationType->save();
           $data = \App\limitationsType::where('invoice_id',$request->invoice)->get();
           $contents = view('admin.limitations.edit.data_table', ['data' => $data,'limitations' => $limitations])->render();
           return $contents;

        }
    }
    public function store(Request $request)
    {
        $data = $this->validate($request,[
            'branche_id'=>'required',
            'date'=>'required',
            'limitations'=>'required',
            'type'=>'required',
        ],[],[
            'branche_id'=>trans('admin.branche'),
            'date'=>trans('admin.date'),
            'limitations'=>trans('admin.limitations'),
            'type'=>trans('admin.account_type'),
        ]);

        $limitations_id = limitationReceipts::where('id',$request->limitations)->first()->limitationReceiptsId;
        $assigned = auth()->guard('admin')->user()->name;
        $type = $request->type;
        $tree = $request->tree;
        $limitations = $limitations_id;
        $limitation = new limitations();
        $limitation->branche_id = $request->branche_id;
        $limitation->date = $request->date;
        $limitation->invoice_id = $request->invoice;
        $limitation->limitationsType_id = $request->limitations;
        $limitation->limitationId = checkIdLimitation($request->limitations);
        $limitation->save();
        $limitationData = new \App\limitationsData();
//        $limitationData->limitations_id = $limitation->id;
        $limitationData->debtor = $request->debtor;
        $limitationData->creditor = $request->creditor;
        $limitationData->invoice_id = $request->invoice;
        $limitationData->save();
        $id = $request->invoice;
        $data = limitationsType::where('invoice_id',$request->invoice)->get();
        return Redirect::route('limitations.invoice')->with( ['data'=>$data,'limitations'=>$limitations,'id' => $id,'type'=>$type] );
    }
    public function index(Request $request)
    {
        if (session()->get('id')){
            $id = session()->get('id');
            $type = session()->get('type');
            $limitationType = session()->get('limitations');
            $limitation = limitations::where('invoice_id',$id)->first();
            $data = limitationsType::where('invoice_id',$id)->get();
                return view('admin.limitations.invoice.invoice',compact('data','id','type','limitationType','limitation'));
        }else{
            return redirect()->route('limitations.create');
        }
    }
        public function invoice(Request $request)
        {
            if($request->ajax()){


                if($request->id){
                    $limitations = limitations::where('id','=',$request->id)->first();
                    $limitations->status = 1;
                    $limitations->save();
                    DB::table('limitations_type')->where('invoice_id',$request->invoice)->update(['limitations_id'=>$request->id,'status'=>1]);
                    DB::table('limitations_datas')->where('invoice_id',$request->invoice)->update(['status'=>1,'limitations_id'=>$request->id]);
                    $limitationsData = \App\limitationsData::where('invoice_id',$limitations->invoice_id)->first();
                    $limitationsType = limitationsType::where('invoice_id',$limitations->invoice_id)->get();
                    $operations = limitationsType::where('invoice_id',$limitations->invoice_id)->pluck('operation_id');
                    $limitationsData->limitationsType()->attach($limitationsType);

//                for receiptsType departement
                    $tree_id = limitationsType::where('invoice_id',$request->invoice)->whereIn('operation_id',$operations)->pluck('tree_id');
                    $limitationsTypetree = limitationsType::where('invoice_id',$request->invoice)->whereIn('tree_id',$tree_id)->get();
                    if (count($limitationsTypetree) > 1){
                    foreach ($limitationsTypetree as $type){
                        DB::table('departments')->where('id',$type->tree_id)->update(['debtor' => DB::raw('debtor + '.$type->debtor),'creditor' => DB::raw('creditor + '.$type->creditor)]);
                        getSitioPadre($type->tree_id,$type->debtor,$type->creditor);
                    }
                    }elseif (count($limitationsTypetree) == 1){
                        $limitationType = limitationsType::where('invoice_id',$limitations->invoice_id)->first();
                        DB::table('departments')->where('id',$limitationType->tree_id)->update(['debtor' => DB::raw('debtor + '.$limitationType->debtor),'creditor' => DB::raw('creditor + '.$limitationType->creditor)]);
                        getSitioPadre($limitationType->tree_id,$limitationType->debtor,$limitationType->creditor);
                    }
//                for receiptsType glcc
                    $cc_id = limitationsType::where('invoice_id',$request->invoice)->whereIn('operation_id',$operations)->pluck('cc_id');
                    $limitationsTypecc = limitationsType::where('invoice_id',$request->invoice)->whereIn('cc_id',$cc_id)->get();
                    foreach ($limitationsTypecc as $type){
                        DB::table('glccs')->where('id',$type->cc_id)->update(['debtor' => DB::raw('debtor + '.$type->debtor),'creditor' => DB::raw('creditor + '.$type->creditor)]);
                        getSitiocc($type->cc_id,$type->debtor,$type->creditor);
                    }
                    return ' ';
                }
            }
        }
        public function show($id)
        {
            $limitations = limitations::findOrFail($id);
            $limitationsData= $limitations->limitationsData;
            $data = $limitations->limitations_type;
                return view('admin.limitations.invoice.show',compact('limitationsData','data','limitations'));
        }
        public function select(Request $request)
        {
            if($request->ajax()){
                $type = $request->type;
                $operation = operation::where('id',$type)->first();
                $limitation = $request->limitations;
                    if ($type == 4){
                        $tree = Department::where('levelType','=',1)->pluck('dep_name_'.session('lang'),'id');
                        $contents = view('admin.limitations.edit.detailsselect', ['tree'=>$tree,'type'=>$type,'operation'=>$operation,'limitation'=>$limitation])->render();
                        return $contents;
                    }elseif ($type == 1){
                        $tree = $operation->suppliers->pluck('name_'.session('lang'),'id');
                        $contents = view('admin.limitations.edit.detailsselect', ['tree'=>$tree,'type'=>$type,'operation'=>$operation,'limitation'=>$limitation])->render();
                        return $contents;
                    }elseif ($type == 5){
                        $tree = $operation->drivers->pluck('name_'.session('lang'),'id');
                        $contents = view('admin.limitations.edit.detailsselect', ['tree'=>$tree,'type'=>$type,'operation'=>$operation,'limitation'=>$limitation])->render();
                        return $contents;
                    }elseif ($type == 2){
                        $tree = $operation->subscribers->pluck('name_'.session('lang'),'id');
                        $contents = view('admin.limitations.edit.detailsselect', ['tree'=>$tree,'type'=>$type,'operation'=>$operation,'limitation'=>$limitation])->render();
                        return $contents;
                    }
            }
        }
        public function destroy(Request $request)
        {
            if($request->ajax()){
                $id = $request->id;
                $invoice = $request->invoice;
                $limitationType = limitationsType::where('id',$id)->where('invoice_id',$invoice)->first();
                $limitationsData = \App\limitationsData::where('invoice_id',$invoice)->first();
                if ($limitationType->cc_id != null){
                    DB::table('glccs')->where('id',$limitationType->cc_id)->update(['debtor' => DB::raw('debtor - '.$limitationType->debtor),'creditor' => DB::raw('creditor - '.$limitationType->creditor)]);
                    getSitiocc($limitationType->cc_id,-$limitationType->debtor,-$limitationType->creditor);
                }
                DB::table('departments')->where('id',$limitationType->tree_id)->update(['debtor' => DB::raw('debtor - '.$limitationType->debtor),'creditor' => DB::raw('creditor - '.$limitationType->creditor)]);
                getSitioPadre($limitationType->tree_id,-$limitationType->debtor,-$limitationType->creditor);
//                $limitationsData->debtor = $limitationsData->debtor - $limitationType->debtor;
//                $limitationsData->creditor = $limitationsData->creditor - $limitationType->creditor;
//                $limitationsData->save();
                if ($limitationType->limitationsData() != null){
                    $limitationType->limitationsData()->detach($limitationsData);
                }
                $limitationType->delete();
                $data = limitationsType::where('invoice_id',$invoice)->get();

                $contents = view('admin.limitations.edit.data_table', ['data' => $data,'limitationType' => $limitationType])->render();
                return $contents;
            }
        }
        public function softdelete(Request $request)
        {
            if($request->ajax()){
                $id = $request->id;
                $invoice = $request->invoice;
                $limitationType = limitationsType::where('id',$id)->where('invoice_id',$invoice)->first();
                $limitationsData = \App\limitationsData::where('invoice_id',$invoice)->first();

                $limitationType->delete();
                $data = limitationsType::where('invoice_id',$invoice)->get();

                $contents = view('admin.limitations.data_table', ['data' => $data,'limitationType' => $limitationType])->render();
                return $contents;
            }
        }
        public function pdf($id,Request $request){
            $limitations = limitations::where('id','=',$id)->first();
            $limitations->status = 1;
            $limitations->save();
            DB::table('limitations_type')->where('invoice_id',$request->invoice_id)->update(['limitations_id'=>$request->id,'status'=>1]);
            DB::table('limitations_datas')->where('invoice_id',$request->invoice_id)->update(['status'=>1,'limitations_id'=>$request->id]);
            $limitationsData = \App\limitationsData::where('invoice_id',$limitations->invoice_id)->first();
            $limitationsType = limitationsType::where('invoice_id',$limitations->invoice_id)->get();
            $operations = limitationsType::where('invoice_id',$limitations->invoice_id)->pluck('operation_id');
            $limitationsData->limitationsType()->attach($limitationsType);

//                for receiptsType departement
            $tree_id = limitationsType::where('invoice_id',$request->invoice_id)->whereIn('operation_id',$operations)->pluck('tree_id');
            $limitationsTypetree = limitationsType::where('invoice_id',$request->invoice_id)->whereIn('tree_id',$tree_id)->get();
            foreach ($limitationsTypetree as $type){
                DB::table('departments')->where('id',$type->tree_id)->update(['debtor' => DB::raw('debtor + '.$type->debtor),'creditor' => DB::raw('creditor + '.$type->creditor)]);
                getSitioPadre($type->tree_id,$type->debtor,$type->creditor);
            }
//                for receiptsType glcc
            $cc_id = limitationsType::where('invoice_id',$request->invoice_id)->whereIn('operation_id',$operations)->pluck('cc_id');
            $limitationsTypecc = limitationsType::where('invoice_id',$request->invoice_id)->whereIn('cc_id',$cc_id)->get();
            foreach ($limitationsTypecc as $type){
                DB::table('glccs')->where('id',$type->cc_id)->update(['debtor' => DB::raw('debtor + '.$type->debtor),'creditor' => DB::raw('creditor + '.$type->creditor)]);
                getSitiocc($type->cc_id,$type->debtor,$type->creditor);
            }


            $data = $limitations->limitations_type;
            $config = ['instanceConfigurator' => function($mpdf) {
                $mpdf->SetHTMLFooter('
                    <div dir="ltr" style="text-align: right">{DATE j-m-Y H:m}</div>
                    <div dir="ltr" style="text-align: center">{PAGENO} of {nbpg}</div>'
                );
            }];
            $pdf = PDF::loadView('admin.limitations.pdf.report', compact('limitations','data'),[],['format' => 'A4'], $config);
            return $pdf->stream();
        }
        public function print($id,Request $request){
            $limitations = limitations::where('id',$id)->first();
            $data = $limitations->limitations_type;
            $config = ['instanceConfigurator' => function($mpdf) {
                $mpdf->SetHTMLFooter('
                    <div dir="ltr" style="text-align: right">{DATE j-m-Y H:m}</div>
                    <div dir="ltr" style="text-align: center">{PAGENO} of {nbpg}</div>'
                );
            }];
            $pdf = PDF::loadView('admin.limitations.pdf.report', compact('limitations','data'),[],['format' => 'A4'], $config);
            return $pdf->stream();
        }

}
