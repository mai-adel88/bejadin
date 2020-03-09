@if (\Illuminate\Support\Facades\Session::has('error'))
    <div class="alert alert-danger">{{ \Illuminate\Support\Facades\Session::get('error') }}</div>
@endif
{{--@if ($errors->all())--}}
{{--    @foreach($errors->all() as $error)--}}
{{--    <div class="alert alert-danger">{{ $error }}</div>--}}
{{--    @endforeach--}}
{{--@endif--}}
