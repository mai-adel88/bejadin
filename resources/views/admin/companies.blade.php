<option value="">{{trans('admin.select')}}</option>
@if(count($companies) > 0)
    <option value={{-1}}>{{trans('admin.allCompanies')}}</option>
    @foreach($companies as $cmp)
        <option value="{{$cmp->Cmp_No}}">{{$cmp->{'Cmp_Nm'.ucfirst(session('lang'))} }}</option>
    @endforeach
@else
    <option value={{-1}}>{{trans('admin.allCompanies')}}</option>
@endif