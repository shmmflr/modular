@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('course.index')}}" title="دوره ها">دوره ها</a></li>
@endsection
@section('content')
    <div class=" padding-0 categories">
        <div class="row no-gutters  ">
            <div class="col-12 margin-left-10 margin-bottom-15 border-radius-3">

                <a href="{{route('course.create')}}">ایجاد دوره جدید</a>
                <p class="box__title">دسته بندی ها</p>
                <div class="table__box">
                    <table class="table">
                        <thead role="rowgroup">
                        <tr role="row" class="title-row">
                            <th>تصویر</th>
                            <th>شناسه</th>
                            <th>اولویت</th>
                            <th>نام دوره</th>
                            <th>جزئیات</th>
                            <th>نام مدرس</th>
                            <th>وضعیت</th>
                            <th>وضعیت تایید</th>
                            <th>قیمت</th>
                            <th>درصد مدرس</th>
                            <th>عملیات</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($courses as $course)
                            <tr role="row" class="">
                                <td>
                                    <img src="{{$course->banner->thumb}}" alt="">
                                </td>
                                <td><a href="">{{$course->id}}</a></td>
                                <td><a href="">{{$course->priority}}</a></td>
                                <td><a href="">{{$course->title}}</a></td>
                                <td><a href="{{route('course.details',$course->id)}}">
                                        مشاهده</a>
                                </td>
                                <td><a href="">{{$course->teacher->name}}</a></td>
                                <td>@lang($course->status)</td>
                                <td>@lang($course->confirmation)</td>
                                <td>{{$course->price}}</td>
                                <td>{{$course->percent}}%</td>
                                <td>
                                    <a
                                        onclick="deleteItem(event,'{{route('course.destroy',$course->id)}}')"
                                        class="item-delete mlg-15" title="حذف"></a>
                                    <a href="" target="_blank" class="item-eye mlg-15" title="مشاهده"></a>
                                    <a href="{{route('course.edit',$course->id)}}" class="item-edit mlg-15 "
                                       title="ویرایش"></a>
                                    <a href="" onclick="updateConfirmationStatus(event,
                                        '{{ route('course.reject', $course->id) }}',
                                        'آیا از رد این آیتم اطمینان دارید؟' , 'رد شده')"
                                       class="item-reject mlg-15" title="رد"></a>
                                    <a href="" onclick="updateConfirmationStatus(event,
                                        '{{ route('course.accept', $course->id) }}',
                                        'آیا از تایید این آیتم اطمینان دارید؟' , 'تایید شده')"
                                       class="item-confirm mlg-15" title="تایید"></a>
                                </td>
                            </tr>
                        @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('js')
    <script>
        @include('Common::layout.toast')
    </script>
@endsection
