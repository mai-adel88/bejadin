<?php

namespace App\Http\Controllers\Admin\categories;

use App\Models\Admin\ActivityTypes;
use App\Models\Admin\MainCompany;
use App\Models\Admin\MtsItmfsunit;
use App\Models\Admin\MtsItmmfs;
use App\Models\Admin\MtsItmOthr;
use App\Models\Admin\MtsSuplir;
use App\Models\Admin\Units;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;

class MainCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(){

        if (session('Cmp_No') == -1) {
            $cmps = MainCompany::get();
        } else {
            $cmps = MainCompany::where('Cmp_No', session('Cmp_No'))->first();
        }

        $activity = ActivityTypes::all();
        $suppliers = MtsSuplir::all();
        $units = Units::all();
        $itemToEdit = null;

        return view('admin.categories.main_categories.index', ['title' => trans('admin.basic_types'),
            'cmps' => $cmps, 'activity' => $activity, 'suppliers' => $suppliers, 'itemToEdit' => $itemToEdit, 'units' => $units]);

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'Cmp_No' => 'required',
            'Actvty_No' => 'required',
            'Itm_No' => 'required',
            'Level_No' => 'required',
            'Level_Status' => 'required',
            'Sup_No' => 'required',
            'Itm_NmAr' => 'required',
            'Itm_NmEn' => 'sometimes',
            'Unit_No' => 'required',
        ],[], [
            'Cmp_No' => trans('admin.na_Comp'),
            'Actvty_No' => trans('admin.activity'),
            'Itm_No' => trans('admin.item_no'),
            'Level_No' => trans('admin.level_no'),
            'Level_Status' => trans('admin.level_number'),
            'Sup_No' => trans('admin.Suppliers'),
            'Itm_NmAr' => trans('admin.name_ar'),
            'Itm_NmEn' => trans('admin.name_en'),
            'Unit_No' => trans('admin.unit_no'),
        ]);

        if ($validation->fails()){
            return  response()->json(['status' => 0, 'message' => $validation->getMessageBag()->first()]);
        }

        $itemIfExist = MtsItmmfs::where('Itm_No', $request->Itm_No)->first();

        if ($itemIfExist){
            return response()->json(['status' => 0, 'message' => trans('admin.found_data')]);
        }

        $item = MtsItmmfs::create($request->except(
            [
                'ItmUnit_No',
                'Unit_Ratio',
                'Unit_Sal1',
                'Unit_Pur',
                'Unit_Cost',
                'Label_No',
                'Itm_LengthSteel',
                'Itm_WidthSteel',
                'Itm_Durability',
                'Itm_LengthPaper',
                'Itm_WidthPaper',
                'Itm_WghtPaper',
                'Mdcn_Grup1',
                'Mdcn_Grup2',
                'Mdcn_Grup3',
                'ItmRplc_No1',
                'ItmRplc_No4',
                'ItmRplc_No3',
                'Shelf_No',
                'Itm_Othr1',
                'Itm_Othr2',
                'Itm_Picture',
            ]
        ));

        $item->update(['Level_Status' => 0, 'Level_No' => 1]);

        $MtsItmfsunit = [
            [
                'Ln_No' => 0,
                'Unit_No' =>$request->ItmUnit_No[0],
                'Unit_Ratio' =>$request->Unit_Ratio[0],
                'Unit_Sal1' =>$request->Unit_Sal1[0],
                'Unit_Pur' =>$request->Unit_Pur[0],
                'Unit_Cost' =>$request->Unit_Cost[0],
                'Label_No' =>$request->Label_No[0],
            ],
            [
                'Ln_No' => 1,
                'Unit_No' =>$request->ItmUnit_No[1],
                'Unit_Ratio' =>$request->Unit_Ratio[1],
                'Unit_Sal1' =>$request->Unit_Sal1[1],
                'Unit_Pur' =>$request->Unit_Pur[1],
                'Unit_Cost' =>$request->Unit_Cost[1],
                'Label_No' =>$request->Label_No[1],
            ],
            [
                'Ln_No' => 2,
                'Unit_No' =>$request->ItmUnit_No[2],
                'Unit_Ratio' =>$request->Unit_Ratio[2],
                'Unit_Sal1' =>$request->Unit_Sal2[2],
                'Unit_Pur' =>$request->Unit_Pur[2],
                'Unit_Cost' =>$request->Unit_Cost[2],
                'Label_No' =>$request->Label_No[2],
            ]
        ];

        foreach ($MtsItmfsunit as $key => $itemUnit) {
            if ($itemUnit['Unit_No'] == null || $itemUnit['Unit_Ratio'] == null){
                continue;
            }

            MtsItmfsunit::create([
                'Actvty_No' => $request->Actvty_No,
                'Cmp_No' => $request->Cmp_No,
                'Itm_No' => $request->Itm_No,
                'Ln_No' => $itemUnit['Ln_No'],
                'Unit_No' => $itemUnit['Unit_No'],
                'Unit_Ratio' => $itemUnit['Unit_Ratio'],
                'Unit_Sal1' => $itemUnit['Unit_Sal1'],
                'Unit_Pur' => $itemUnit['Unit_Pur'],
                'Unit_Cost' => $itemUnit['Unit_Cost'],
                'Label_No' => $itemUnit['Label_No'],

            ]);

        }

        $otherItems = MtsItmOthr::create(
            $request->all([
                'Actvty_No',
                'Cmp_No',
                'Itm_No',
                'Itm_LengthSteel',
                'Itm_WidthSteel',
                'Itm_Durability',
                'Itm_LengthPaper',
                'Itm_WidthPaper',
                'Itm_WghtPaper',
                'Mdcn_Grup1',
                'Mdcn_Grup2',
                'Mdcn_Grup3',
                'ItmRplc_No1',
                'ItmRplc_No4',
                'ItmRplc_No3',
                'Shelf_No',
                'Itm_Othr1',
                'Itm_Othr2'
            ])
        );

        if($request->hasFile('Itm_Picture')){
            $file = $request->file('Itm_Picture');
            $filename = time().'_'.md5(Str::random(16)).'.'.$file->getClientOriginalExtension();
            $path = 'public/uploads/other_items/'.$otherItems->ID_No;
            $file->move($path, $filename);
            $otherItems->update(['Itm_Picture' => $path.'/'.$filename]);
        }

        session(['updatedComNo', $request->Cmp_No,'updatedActiveNo', $request->Actvty_No]);
        return response()->json(['status' => 1, 'message' => trans('admin.success_add')]);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    // Update child or root
    public function updateRootOrChildOrCreateChild(Request $request){

        $validation = Validator::make($request->all(), [
            'Cmp_No' => 'required',
            'Actvty_No' => 'required',
            'Itm_No' => 'required',
            'Level_No' => 'required',
            'Level_Status' => 'required',
            'Sup_No' => 'required',
            'Itm_NmAr' => 'required',
            'Itm_NmEn' => 'sometimes',
            'Unit_No' => 'required',
        ],[], [
            'Cmp_No' => trans('admin.na_Comp'),
            'Actvty_No' => trans('admin.activity'),
            'Itm_No' => trans('admin.item_no'),
            'Level_No' => trans('admin.level_no'),
            'Level_Status' => trans('admin.level_number'),
            'Sup_No' => trans('admin.Suppliers'),
            'Itm_NmAr' => trans('admin.name_ar'),
            'Itm_NmEn' => trans('admin.name_en'),
            'Unit_No' => trans('admin.unit_no'),
        ]);

        if ($validation->fails()){
            return  response()->json(['status' => 0, 'message' => $validation->getMessageBag()->first()]);
        }
        $item = MtsItmmfs::where('Itm_No', $request->Itm_No)->first();
        $MtsItmfsunit = [
            [
                'Ln_No' => 0,
                'Unit_No' =>$request->ItmUnit_No[0],
                'Unit_Ratio' =>$request->Unit_Ratio[0],
                'Unit_Sal1' =>$request->Unit_Sal1[0],
                'Unit_Pur' =>$request->Unit_Pur[0],
                'Unit_Cost' =>$request->Unit_Cost[0],
                'Label_No' =>$request->Label_No[0],
            ],
            [
                'Ln_No' => 1,
                'Unit_No' =>$request->ItmUnit_No[1],
                'Unit_Ratio' =>$request->Unit_Ratio[1],
                'Unit_Sal1' =>$request->Unit_Sal1[1],
                'Unit_Pur' =>$request->Unit_Pur[1],
                'Unit_Cost' =>$request->Unit_Cost[1],
                'Label_No' =>$request->Label_No[1],
            ],
            [
                'Ln_No' => 2,
                'Unit_No' =>$request->ItmUnit_No[2],
                'Unit_Ratio' =>$request->Unit_Ratio[2],
                'Unit_Sal1' =>$request->Unit_Sal1[2],
                'Unit_Pur' =>$request->Unit_Pur[2],
                'Unit_Cost' =>$request->Unit_Cost[2],
                'Label_No' =>$request->Label_No[2],
            ]
        ];

        if (!$item){
            MtsItmmfs::create($request->except(
                [
                    'ItmUnit_No',
                    'Unit_Ratio',
                    'Unit_Sal1',
                    'Unit_Pur',
                    'Unit_Cost',
                    'Label_No',
                    'Itm_LengthSteel',
                    'Itm_WidthSteel',
                    'Itm_Durability',
                    'Itm_LengthPaper',
                    'Itm_WidthPaper',
                    'Itm_WghtPaper',
                    'Mdcn_Grup1',
                    'Mdcn_Grup2',
                    'Mdcn_Grup3',
                    'ItmRplc_No1',
                    'ItmRplc_No4',
                    'ItmRplc_No3',
                    'Shelf_No',
                    'Itm_Othr1',
                    'Itm_Othr2',
                    'Itm_Picture',
                ]
            ));
            foreach ($MtsItmfsunit as $key => $itemUnit) {
                if ($itemUnit['Unit_No'] == null || $itemUnit['Unit_Ratio'] == null){
                    continue;
                }

                MtsItmfsunit::create([
                    'Actvty_No' => $request->Actvty_No,
                    'Cmp_No' => $request->Cmp_No,
                    'Itm_No' => $request->Itm_No,
                    'Ln_No' => $itemUnit['Ln_No'],
                    'Unit_No' => $itemUnit['Unit_No'],
                    'Unit_Ratio' => $itemUnit['Unit_Ratio'],
                    'Unit_Sal1' => $itemUnit['Unit_Sal1'],
                    'Unit_Pur' => $itemUnit['Unit_Pur'],
                    'Unit_Cost' => $itemUnit['Unit_Cost'],
                    'Label_No' => $itemUnit['Label_No'],

                ]);

            }

            $otherItems = MtsItmOthr::create(
                $request->all([
                    'Actvty_No',
                    'Cmp_No',
                    'Itm_No',
                    'Itm_LengthSteel',
                    'Itm_WidthSteel',
                    'Itm_Durability',
                    'Itm_LengthPaper',
                    'Itm_WidthPaper',
                    'Itm_WghtPaper',
                    'Mdcn_Grup1',
                    'Mdcn_Grup2',
                    'Mdcn_Grup3',
                    'ItmRplc_No1',
                    'ItmRplc_No4',
                    'ItmRplc_No3',
                    'Shelf_No',
                    'Itm_Othr1',
                    'Itm_Othr2'
                ])
            );

            if($request->hasFile('Itm_Picture')){
                $file = $request->file('Itm_Picture');
                $filename = time().'_'.md5(Str::random(16)).'.'.$file->getClientOriginalExtension();
                $path = 'public/uploads/other_items/'.$otherItems->ID_No;
                $file->move($path, $filename);
                $otherItems->update(['Itm_Picture' => $path.'/'.$filename]);
            }

            session(['updatedComNo', $request->Cmp_No,'updatedActiveNo', $request->Actvty_No]);
            return response()->json(['status' => 1, 'message' => trans('admin.success_add')]);
        } else {
            $item->update($request->except(
                [
                    'Level_Status',
                    'Level_No',
                    'Itm_No',
                    'ItmUnit_No',
                    'Unit_Ratio',
                    'Unit_Sal1',
                    'Unit_Pur',
                    'Unit_Cost',
                    'Label_No',
                    'Itm_LengthSteel',
                    'Itm_WidthSteel',
                    'Itm_Durability',
                    'Itm_LengthPaper',
                    'Itm_WidthPaper',
                    'Itm_WghtPaper',
                    'Mdcn_Grup1',
                    'Mdcn_Grup2',
                    'Mdcn_Grup3',
                    'ItmRplc_No1',
                    'ItmRplc_No4',
                    'ItmRplc_No3',
                    'Shelf_No',
                    'Itm_Othr1',
                    'Itm_Othr2',
                    'Itm_Picture',
                ]
            ));
            $checkBoxes = [
                'Invt_Active',
                'Itm_Req',
                'Itm_Relation',
                'Prct_Discount',
                'Chk_Qty2',
                'Chk_Qty3',
                'Sale_Active'
                ,'Itm_Active'
            ];

            foreach ($checkBoxes as $key => $checkBox) {
                if ($request->{$checkBox} == null){
                    $item->update([
                        $checkBox => null
                    ]);
                }
            }

            if ($item->units != null){
                foreach ($item->units as $unit) {
                    $unit->delete();
                }
            }


            foreach ($MtsItmfsunit as $key => $itemUnit) {
                if ($itemUnit['Unit_No'] == null || $itemUnit['Unit_Ratio'] == null){
                    continue;
                }

                MtsItmfsunit::create([
                    'Actvty_No' => $request->Actvty_No,
                    'Cmp_No' => $request->Cmp_No,
                    'Itm_No' => $request->Itm_No,
                    'Ln_No' => $itemUnit['Ln_No'],
                    'Unit_No' => $itemUnit['Unit_No'],
                    'Unit_Ratio' => $itemUnit['Unit_Ratio'],
                    'Unit_Sal1' => $itemUnit['Unit_Sal1'],
                    'Unit_Pur' => $itemUnit['Unit_Pur'],
                    'Unit_Cost' => $itemUnit['Unit_Cost'],
                    'Label_No' => $itemUnit['Label_No'],

                ]);

            }

            if($item->others != null){
                $otherItems = $item->others->first();
                $otherItems->update($request->all([
                    'Actvty_No',
                    'Cmp_No',
                    'Itm_No',
                    'Itm_LengthSteel',
                    'Itm_WidthSteel',
                    'Itm_Durability',
                    'Itm_LengthPaper',
                    'Itm_WidthPaper',
                    'Itm_WghtPaper',
                    'Mdcn_Grup1',
                    'Mdcn_Grup2',
                    'Mdcn_Grup3',
                    'ItmRplc_No1',
                    'ItmRplc_No4',
                    'ItmRplc_No3',
                    'Shelf_No',
                    'Itm_Othr1',
                    'Itm_Othr2'
                ]));
                if($request->hasFile('Itm_Picture')){
                    File::delete($otherItems->Itm_Picture);
                    $file = $request->file('Itm_Picture');
                    $filename = time().'_'.md5(Str::random(16)).'.'.$file->getClientOriginalExtension();
                    $path = 'public/uploads/other_items/'.$otherItems->ID_No;
                    $file->move($path, $filename);
                    $otherItems->update(['Itm_Picture' => $path.'/'.$filename]);
                }
            } else {
                $otherItems = MtsItmOthr::create($request->all([
                    'Actvty_No',
                    'Cmp_No',
                    'Itm_No',
                    'Itm_LengthSteel',
                    'Itm_WidthSteel',
                    'Itm_Durability',
                    'Itm_LengthPaper',
                    'Itm_WidthPaper',
                    'Itm_WghtPaper',
                    'Mdcn_Grup1',
                    'Mdcn_Grup2',
                    'Mdcn_Grup3',
                    'ItmRplc_No1',
                    'ItmRplc_No4',
                    'ItmRplc_No3',
                    'Shelf_No',
                    'Itm_Othr1',
                    'Itm_Othr2'
                ]));
                if($request->hasFile('Itm_Picture')){
                    File::delete($otherItems->Itm_Picture);
                    $file = $request->file('Itm_Picture');
                    $filename = time().'_'.md5(Str::random(16)).'.'.$file->getClientOriginalExtension();
                    $path = 'public/uploads/other_items/'.$otherItems->ID_No;
                    $file->move($path, $filename);
                    $otherItems->update(['Itm_Picture' => $path.'/'.$filename]);
                }
            }



        }
        session(['updatedComNo', $request->Cmp_No,'updatedActiveNo', $request->Actvty_No]);
        return response()->json(['status' => 1, 'message' => trans('admin.success_add')]);


    }

    // Delete child or root
    public function deleteRootOrChild(Request $request){

        $validation = Validator::make($request->all(), [
            'Itm_No' => 'required',
        ],[], [
            'Itm_No' => trans('admin.item_no'),
        ]);

        if ($validation->fails()){
            return  response()->json(['status' => 0, 'message' => $validation->getMessageBag()->first()]);
        }
        $item = MtsItmmfs::where('Itm_No', $request->Itm_No)->first();
        if(count($item->children) > 0){
            return response()->json(['status' => 0, 'message' => trans('admin.cant_delete_category')]);
        }
        if($item){
            $item->delete();
            foreach ($item->units as $unit) {
                $unit->delete();
            }
            $otherItems = $item->others->first();
            File::delete($otherItems->Itm_Picture);
            File::deleteDirectory(public_path('uploads/other_items/'.$otherItems->ID_No));
            $otherItems->delete();
            return response()->json(['status' => 1, 'message' => trans('admin.success_deleted')]);
        } else {
            return response()->json(['status' => 0, 'message' => trans('admin.not_found_data')]);
        }


    }

    // Fire when change company number or activity number
    public function getCategoryItem(Request $request){
        if($request->ajax()){
            session(['updatedComNo' => $request->Cmp_No , 'updatedActiveNo' => $request->Actvty_No]);
            $tree = load_item('Itm_Parnt', '', $request->Cmp_No, $request->Actvty_No);
            return $tree;
        }
    }

    // Create child
    public function returnCreateChildBlade(Request $request)
    {
        if ($request->ajax() && $request->parent){
            $item = MtsItmmfs::where('Itm_No', $request->parent)->first();
            if (session('Cmp_No') == -1) {
                $cmps = MainCompany::get();
            } else {
                $cmps = MainCompany::where('Cmp_No', session('Cmp_No'))->first();
            }

            $activity = ActivityTypes::all();
            $suppliers = MtsSuplir::all();
            $units  = Units::all();

            $lastChild = null;

            if (count($item->children) > 0){
                $lastChild = $item->children[count($item->children)-1];
            }

            return view('admin.categories.main_categories.create_child.index', compact(['cmps', 'activity', 'suppliers', 'units', 'lastChild', 'item']));



        }
    }

    // get root or child for edit
    public function getRootOrChildForEdit(Request $request)
    {
        if (session('Cmp_No') == -1) {
            $cmps = MainCompany::get();
        } else {
            $cmps = MainCompany::where('Cmp_No', session('Cmp_No'))->first();
        }

        $activity = ActivityTypes::all();
        $suppliers = MtsSuplir::all();
        $units  = Units::all();
        $itemToEdit = null;

        if ($request->ajax() && ($request->Itm_No || $request->parent)){
            $itemToEdit = MtsItmmfs::where('Itm_No', $request->Itm_No)->orWhere('Itm_No', $request->parent)->first();
            return view('admin.categories.main_categories.edit.edit_parent_or_child', ['title' => trans('admin.basic_types'),
                'cmps' => $cmps, 'activity' => $activity, 'suppliers' => $suppliers, 'itemToEdit' => $itemToEdit, 'units' => $units]);
        }
    }

    // Generate Child number depend on parent number
    public function generateChildNo(Request $request){
        $parentId = $request->parent;
        $parent = MtsItmmfs::where('Itm_No', $parentId)->first();
        if($parent){
            if (count($parent->children) > 0){
                // last + 1 if has children
                $index = count($parent->children)-1;
                session(['ItemNoGenerated' => $parent->children[$index]->Itm_No+1]);
                return $parent->children[$index]->Itm_No+1;
            } else {
                return (int)$parentId.'001';
            }


        }
    }
}
