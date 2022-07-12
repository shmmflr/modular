@extends('Dashboard::master')

@section('content')
    <div class=" padding-0 categories">
        <div class="col-6 bg-white" style="margin-right: auto;margin-left: auto">
            <p class="box__title">ایجاد دسته بندی جدید</p>
            <form action="{{route('category.update',$category->id)}}" method="post" class="padding-30">
                @csrf
                @method('PATCH')
                <input type="text" name="title" value="{{$category->title}}" placeholder="نام دسته بندی" class="text">
                @error('title')
                <span class="invalid-feedback" role="alert">
                      <strong>{{ $message }}</strong>
                </span>
                @enderror
                <input type="text" name="slug" value="{{$category->slug}}" placeholder="نام انگلیسی دسته بندی"
                       class="text">
                @error('slug')
                <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                </span>
                @enderror
                <p class="box__title margin-bottom-15">انتخاب دسته پدر</p>
                <select name="parent_id" id="parent_id">
                    <option value="">ندارد</option>
                    @foreach($categories as $item)
                        <option
                            @if($item->id == $category->parent_id) selected @endif
                        value="{{$item->id}}">
                            {{$item->title}}
                        </option>
                    @endforeach
                </select>
                @error('parent_id')
                <span class="invalid-feedback" role="alert">
                     <strong>{{ $message }}</strong>
                </span>
                @enderror
                <button class="btn btn-brand">ویرایش</button>
            </form>
        </div>
    </div>
@endsection

