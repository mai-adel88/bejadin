<div class="row">
    <div class="col-xs-10">
        {{ Form::label('tree','من مركز تكلفه', ['class' => 'col-xs-3']) }}
        <select name="fromtree" id="fromtree" class="col-xs-8  fromtreee">
            <option >{{trans('admin.select')}}</option>
            @foreach($costcntrc as $mts)
                <option value="{{$mts->Costcntr_No}}">{{$mts->Costcntr_Nmar}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-xs-2">
        {{ Form::text('fromtree_Acc_No',null, array_merge(['class' => ' form-control acc_fromtree'])) }}
    </div>
</div>
<br>
<div class="row">
    <div class="col-xs-10">
        {{ Form::label('tree','الى مركز تكلفه', ['class' => 'col-xs-3']) }}
        <select name="totree" id="totree" class="col-xs-8">
            <option >{{trans('admin.select')}}</option>
            @foreach($costcntrc as $mts)
                <option value="{{$mts->Costcntr_No}}">{{$mts->Costcntr_Nmar}}</option>
            @endforeach
        </select>
    </div>
    <div class="col-xs-2">
        {{ Form::text('totree_Acc_No',null, array_merge(['class' => 'form-control acc_totree'])) }}
    </div>
</div>
