@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('course.index')}}" title="درس ها">درس ها</a></li>
    <li><a href="{{route('course.details',$course->id)}}" title="{{$course->title}}">{{$course->title}}</a></li>
    <li><a href="#" title="ایجاد درس"> ایجاد درس</a></li>
@endsection
@section('content')
    <div class=" padding-0 categories">
        <div class="col-12 bg-white" style="margin-right: auto;margin-left: auto">
            <form action="{{route('lesson.store',$course->id)}}" method="POST" class="padding-30" enctype="multipart/form-data">
                @csrf
                <x-input type="text" class="text" placeholder="عنوان درس" name="title" required/>

                <x-input type="text" class="text text-left " placeholder="نام انگلیسی درس اختیاری" name="slug"/>
                <x-input type="number" class="text text-left " placeholder="مدت زمان درس" name="time"/>
                <x-input type="number" class="text text-left " placeholder="اولیت نمایش درس" name="priority"/>
                @if($sections)

                    <x-select name="section_id" required class="mt-2">
                        <option value="">انتخاب سرفصل درس</option>
                        @foreach($sections as $section)
                            <option value="{{$section->id}}"
                                    @if($section->id == old('section_id')) selected @endif
                            >{{$section->title}}</option>
                        @endforeach
                    </x-select>
                @endif


                <div class="w-50">
                    <p class="box__title">ایا این درس رایگان است ؟ </p>
                    <div class="notificationGroup">
                        <input id="lesson-upload-field-1"
                               name="type" value="off" type="radio" checked="">
                        <label for="lesson-upload-field-1">خیر</label>
                    </div>
                    <div class="notificationGroup">
                        <input id="lesson-upload-field-2"
                               name="type" value="on" type="radio">
                        <label for="lesson-upload-field-2">بله</label>
                    </div>
                </div>

                <x-file-upload name="media"/>

                <x-text-area placeholder="توضیحات درس" name="body"/>

                <button class="btn btn-brand">ایجاد درس</button>
            </form>
        </div>
    </div>
@endsection

@section('js')
    <script>
        @include('Common::layout.toast')
    </script>
    <script src="{{asset('panel/js/tagsInput.js')}}"></script>
@endsection
