@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('course.index')}}" title="دوره ها">دوره ها</a></li>
    <li><a href="#" title="ایجاد دوره"> ویرایش دوره</a></li>
@endsection
@section('content')
    <div class=" padding-0 categories">
        <div class="col-12 bg-white" style="margin-right: auto;margin-left: auto">
            <form action="{{route('course.update',$course->id)}}" method="POST" class="padding-30"
                  enctype="multipart/form-data">
                @csrf
                @method('PATCH')
                <x-input type="text" class="text" placeholder="عنوان دوره" name="title"
                         value="{{$course->title}}"
                         required/>

                <x-input type="text" class="text text-left " placeholder="نام انگلیسی دوره" name="slug"
                         value="{{$course->slug}}" required/>
                <div class="d-flex multi-text">
                    <x-input type="text" class="text-left mlg-15" placeholder="ردیف دوره" name="priority"
                             value="{{$course->priority}}"
                    />
                    <x-input type="text" placeholder="مبلغ دوره" class="text-left mx-5 mlg-15" name="price" required
                             value="{{$course->price}}"
                    />
                    <x-input type="number" placeholder="درصد مدرس" class="text-left" name="percent" required
                             value="{{$course->percent}}"
                    />
                </div>
                <x-select name="teacher_id" required>
                    <option value="">انتخاب مدرس دوره</option>
                    @foreach($teachers as $teacher)
                        <option value="{{$teacher->id}}"
                                @if($teacher->id == $course->teacher_id) selected @endif
                        >{{$teacher->name}}</option>
                    @endforeach
                </x-select>

                <x-tag-select name="tag" placeholder="لطفا تگ را وارد کنید"/>

                <x-select name="type" required>
                    <option value="">نوع دوره</option>
                    @foreach(\Shofo\Course\Models\Course::$types as $type)
                        <option value="{{$type}}"
                                @if($type == $course->type) selected @endif
                        >@lang($type)</option>
                    @endforeach
                </x-select>

                <x-select name="status" required>
                    <option value="">وضعیت دوره</option>
                    @foreach(\Shofo\Course\Models\Course::$statuses as $status)
                        <option value="{{$status}}"
                                @if($status == $course->status)selected @endif
                        >@lang($status)</option>
                    @endforeach
                </x-select>

                <x-select name="category_id" required>
                    <option value="">انتخاب دسته بندی</option>
                    @foreach($categories as $cat)
                        <option value="{{$cat->id}}"
                                @if($cat->id == $course->category_id)selected @endif
                        >{{$cat->title}}</option>
                    @endforeach
                </x-select>

                <x-file-upload name="image" :value="$course->banner"/>

                <x-text-area placeholder="توضیحات دوره" value="{{$course->body}}" name="body"/>

                <button class="btn btn-brand">بروزرسانی دوره</button>
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
