<?php

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

    foreach ($MtsItmfsunit as $key => $item) {
        if ($item['Unit_No'] == null || $item['Unit_Ratio'] == null){
            continue;
        }

        MtsItmfsunit::create([
            'Actvty_No' => $request->Actvty_No,
            'Cmp_No' => $request->Cmp_No,
            'Itm_No' => $request->Itm_No,
            'Ln_No' => $item['Ln_No'],
            'Unit_No' => $item['Unit_No'],
            'Unit_Ratio' => $item['Unit_Ratio'],
            'Unit_Sal1' => $item['Unit_Sal1'],
            'Unit_Pur' => $item['Unit_Pur'],
            'Unit_Cost' => $item['Unit_Cost'],
            'Label_No' => $item['Label_No'],

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
        $path = 'uploads/other_items/'.$otherItems->ID_No;
        $file->move($path, $filename);
        $otherItems->update(['Itm_Picture' => $path.'/'.$filename]);
    }

    session(['updatedComNo', $request->Cmp_No,'updatedActiveNo', $request->Actvty_No]);
    return response()->json(['status' => 1, 'message' => trans('admin.success_add')]);

}
