@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('course.index')}}" title="دوره ها">دوره ها</a></li>
@endsection
@section('content')

    <div class="col-12 bg-white margin-bottom-15 border-radius-3">
        <p class="box__title">سرفصل ها</p>
        <form action="{{route('sections.update',$section->id)}}" method="post" class="padding-30">
            @csrf
            @method('PATCH')
            <x-input type="text" placeholder="عنوان سرفصل" value="{{$section->title}}" name="title" class="text"/>
            <x-input type="text" placeholder="شماره سرفصل" value="{{$section->number}}" name="number" class="text"/>
            <button class="btn btn-brand">اضافه کردن</button>
        </form>
    </div>

@endsection

