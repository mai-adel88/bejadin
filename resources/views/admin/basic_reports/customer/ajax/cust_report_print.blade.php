<div class="row">

    {!! Form::open(array('route' => 'cust_report_pdf', 'method' => 'POST', 'target' => '_blank')) !!}
    {{Form::hidden('mainCompany',$mainCompany)}}
    {{Form::hidden('myradio',$myradio)}}
    {{Form::hidden('selecd_input',$selecd_input)}}
    {{Form::hidden('active',$active)}}
    {{Form::hidden('notactive',$notactive)}}
    <div class="col-md-2" style='margin: 47px 102px 0 0;'><button type="submit" class="btn btn-primary">طباعه</button></div>

    {!! Form::close() !!}

</div>

