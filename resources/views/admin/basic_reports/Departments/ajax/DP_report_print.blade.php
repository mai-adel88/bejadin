
    {!! Form::open(array('route' => 'Dep_report_pdf', 'method' => 'POST', 'target' => '_blank')) !!}
    {{Form::hidden('mainCompany',$mainCompany)}}
    {{Form::hidden('myradio',$myradio)}}
    {{Form::hidden('selecd_input',$selecd_input)}}
    {{Form::hidden('active',$active)}}
    {{Form::hidden('notactive',$notactive)}}
    <div class="col-md-2"  style='margin: 47px 102px 0 0;'><input type="submit" target = "_blank" class="btn btn-primary" value="طباعه"></div>

    {!! Form::close() !!}







