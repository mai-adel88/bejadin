

<div class="row" style="margin-top: 2%">
    <div class="col-md-12">
        <div class="col-xs-4" style="display: flex;flex-direction: row">

            {{ Form::label('From', trans('admin.From'), ['class' => 'col-md-2 col-xs-3','style'=>'margin:1%']) }}
            {{ Form::text('From',null, array_merge(['class' => 'col-md-10 col-xs-9 form-control  date fromDate ','id'=>'fromDate','autocomplete'=>'off'])) }}
        </div>
        <div class="col-xs-4">
            {{ Form::label('To', trans('admin.To'), ['class' => 'col-md-2 col-xs-3']) }}
            {{ Form::text('To',null, array_merge(['class' => 'col-md-10 col-xs-9 form-control  date  toDate','id'=>'toDate'])) }}

        </div>

    </div>


</div>



