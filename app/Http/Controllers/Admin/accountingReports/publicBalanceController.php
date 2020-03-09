<?php

namespace App\Http\Controllers\Admin\accountingReports;

use App\Department;
use App\levels;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use niklasravnsborg\LaravelPdf\Facades\Pdf;

class publicBalanceController extends Controller
{
    public function index(){
        $title = trans('admin.public_balance');
        $departments = Department::where('type','0')->pluck('dep_name_'.session('lang'),'id');
        $level = levels::where('type','1')->pluck('levelId','id');
        return view('admin.accountingReports.publicbalance.index',compact('title','departments','level'));
    }

    public function level(Request $request){
        if($request->ajax()){


            $department = $request->departments;
            $level = levels::where('type','1')->pluck('levelId','id');

//            if ($from && $to){

                return $data2 =  view('admin.accountingReports.publicbalance.level',compact('department','level'))->render();
//            }elseif($from && $to && $department){
//                return view('admin.accountingReports.publicbalance.level',compact('department'))->render();
//            }elseif($from && $to && $level){
//                return view('admin.accountingReports.publicbalance.level',compact('department'))->render();
//            }elseif($from && $to && $department && $level){
//                return view('admin.accountingReports.publicbalance.level',compact('department'))->render();
//            }
        }
    }
    public function show(Request $request){
        if($request->ajax()){
            $from = $request->from;
            $to = $request->to;
            $department = $request->departments;
            $level = $request->level;

            $level = $request->level;

            if ($from && $to){

                 $data2 =  view('admin.accountingReports.publicbalance.level',compact('department','level'))->render();

                $data =view('admin.accountingReports.publicbalance.show',compact('from','to','department','level'))->render();
            }elseif($from && $to && $department){
                $data2 =  view('admin.accountingReports.publicbalance.level',compact('department','level'))->render();

                $data = view('admin.accountingReports.publicbalance.show',compact('from','to','department','level'))->render();
            }elseif($from && $to && $level){
                $data2 =  view('admin.accountingReports.publicbalance.level',compact('department','level'))->render();

                $data = view('admin.accountingReports.publicbalance.show',compact('from','to','department','level'))->render();
            }elseif($from && $to && $department && $level){
                $data2 =  view('admin.accountingReports.publicbalance.level',compact('department','level'))->render();

                $data =  view('admin.accountingReports.publicbalance.show',compact('from','to','department','level'))->render();
            }
            return $dataa = [$data,$data2];
        }
    }


    public function pdf(Request $request){

            $from = $request->from;
            $to = $request->to;
            $department = $request->department;
            $level = $request->level;


//            from && to
        if ($from && $to && !$department && !$level){
            $departments = Department::all();
            $depart = [];
//            $from && $to && $department
        }elseif($from && $to && $department && !$level){

            $value = [];
            $depart = \App\Department::findOrFail($department);
            $pros = [];
            $products = [];
            $categories = $depart->children;

            while(count($categories) > 0){
                $nextCategories = [];
                foreach ($categories as $category) {

                    $products = array_merge($products, $category->children->all());


                    $nextCategories = array_merge($nextCategories, $category->children->all());

                }
                $categories = $nextCategories;
            }
            $pro = new Collection($products); //Illuminate\Database\Eloquent\Collection

            $pros = $depart->children->pluck('id');

            $plucks = $pro->pluck('id');
            $values = $pros->concat($plucks);

            $departments = \App\Department::whereIn('id',$values)->orderBy('code','asc')->get();
//            $from && $to && $level
        }elseif($from && $to && $level && !$department){
            $depart = null;
            $departments = Department::where('level_id','<=',$level)->orderBy('code','asc')->get();
//            $from && $to && $department && $level
        }elseif($from && $to && $department && $level){
            $depart = [];
            $categories = [];
            $pros = [];
            $products = [];
            $departments =[];
            if($level == 1){

                $departments = Department::where('id','=',$department)->get();

//                $departments = $depart->children;
            }else if( $level == 2){


                $depart = \App\Department::findOrFail($department);

                $departments = $depart->children;




//                $departments = new Collection([$depart,$categories]);
//dd($departments);


            }else if( $level == 3)
            {

                $value = [];
                $depart = \App\Department::findOrFail($department);

                $pros = [];
                $products = [];
                $categories = $depart->children;

                while(count($categories) > 0){
                    $nextCategories = [];
                    foreach ($categories as $category) {

                        $products = array_merge($products, $category->children->all());


//                        $nextCategories = array_merge($nextCategories, $category->children->all());

                    }
                    $categories = $nextCategories;
                }

                $pro = new Collection($products); //Illuminate\Database\Eloquent\Collection

                $pros = $depart->children->pluck('id');

                $plucks = $pro->pluck('id');
                $values = $pros->concat($plucks);

                $departments = \App\Department::whereIn('id',$values)->orderBy('code','asc')->get();

//
            }else
            {

                $value = [];
                $depart = \App\Department::findOrFail($department);

                $pros = [];
                $products = [];
                $categories = $depart->children;

                while(count($categories) > 0){
                    $nextCategories = [];
                    foreach ($categories as $category) {

                        $products = array_merge($products, $category->children->all());


                        $nextCategories = array_merge($nextCategories, $category->children->all());

                    }
                    $categories = $nextCategories;
                }

                $pro = new Collection($products); //Illuminate\Database\Eloquent\Collection

                $pros = $depart->children->pluck('id');

                $plucks = $pro->pluck('id');
                $values = $pros->concat($plucks);

                $departments = \App\Department::whereIn('id',$values)->orderBy('code','asc')->get();

            }




        }
        $config = ['instanceConfigurator' => function($mpdf) {
            $mpdf->SetHTMLFooter('
                    <div style="font-size:10px;width:25%;float:right">Print Date: {DATE j-m-Y H:m}</div>
                    <div style="font-size:10px;width:25%;float:left;direction:ltr;text-align:left">Page {PAGENO} of {nbpg}</div>'
            );
        }];
        $pdf = PDF::loadView('admin.accountingReports.publicbalance.pdf.pdf', ['from'=>$from,'to'=>$to,'departments'=>$departments,'categories'=>$categories,'depart'=>$depart,'level'=>$level], [] , $config);
        return $pdf->stream();
    }
}
