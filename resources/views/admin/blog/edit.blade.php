@extends('admin.index')
@section('title',trans('admin.edit_blog'))
@section('content')
    @hasrole('writer')
    @push('js')


        <script src="https://cloud.tinymce.com/stable/tinymce.min.js?apiKey=qagffr3pkuv17a8on1afax661irst1hbr4e6tbv888sz91jc"></script>
        <script>
            tinymce.init({
                selector: '#body',
                height: 500,
                theme: 'modern',
                plugins: 'print preview powerpaste searchreplace autolink directionality advcode visualblocks visualchars fullscreen image link media template codesample table charmap hr pagebreak nonbreaking anchor toc insertdatetime advlist lists textcolor wordcount tinymcespellchecker a11ychecker imagetools mediaembed  linkchecker contextmenu colorpicker textpattern help',
                toolbar1: 'formatselect | bold italic strikethrough forecolor backcolor | link | alignleft aligncenter alignright alignjustify  | numlist bullist outdent indent  | removeformat',
                image_advtab: true,
                templates: [
                    { title: 'Test template 1', content: 'Test 1' },
                    { title: 'Test template 2', content: 'Test 2' }
                ],
                content_css: [
                    '//fonts.googleapis.com/css?family=Lato:300,300i,400,400i',
                    '//www.tinymce.com/css/codepen.min.css'
                ],

            });
            var temp =tinymce.get('#body').getContent();
            console.log(temp);
        </script>
        <script>
            $(function () {
                'use strict'
                $('.title').keyup(function () {
                    var str = $('.title').val();
                    $('.slug').val(str.replace(/\s+/g, '-').toLowerCase());
                })
            });
        </script>
        <script type="text/javascript">
            function readURL(input) {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();

                    reader.onload = function (e) {
                        $('#profile-img-tag').attr('src', e.target.result);
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
            $("#profile-img").change(function(){
                readURL(this);
            });
        </script>
    @endpush
    @push('js')
        <link rel="stylesheet" href="{{url('/')}}/css/bootstrap-datetimepicker.min.css">
        <script src="{{url('/')}}/js/bootstrap-datetimepicker.min.js"></script>
        <script>
            $(function () {
                $('#datetimepicker1').datetimepicker({
                });
            });
        </script>
    @endpush
    <div class="box">
        @include('admin.layouts.message')
        <div class="box-header">
            <h3 class="box-title">{{$title}}</h3>
        </div>
        <div class="box-body">
            {!! Form::model($blog,['method'=>'PUT','route' => ['blog.update',$blog->id]]) !!}
            <div class="row">
                <div class="col-md-9">
                    <div class="form-group row">
                        <div class="col-md-12">
                            {{ Form::label('title', trans('admin.title_blog'), ['class' => 'control-label']) }}
                            {{ Form::text('title', $blog->title, array_merge(['class' => 'form-control title'])) }}
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                {{ Form::label(trans('admin.body'), null, ['class' => 'control-label']) }}
                                {{ Form::textarea('body', $blog->content, array_merge(['class' => 'form-control','id' => 'body'])) }}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        {{ Form::label('publish_after', trans('admin.publish_after'), ['class' => 'control-label']) }}
                        {{ Form::text('publish_after',date('d/m/Y h:i A', strtotime($blog->publish_after)), array_merge(['class' => 'form-control','id'=>'datetimepicker1'])) }}
                    </div>
                    <div class="form-group">
                        <img src="{{asset('storage/'.$blog->image)}}" id="profile-img-tag" width="200px" style="margin: 20px auto 0;" class="img-responsive" />
                        <br>
                        {!! Form::submit(trans('admin.edit'),['class' => 'btn btn-success btn-block']) !!}
                    </div>
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
    @else
        <div class="alert alert-danger">{{trans('admin.you_cannt_see_invoice_because_you_dont_have_role_to_access')}}</div>

        @endhasrole







@endsection