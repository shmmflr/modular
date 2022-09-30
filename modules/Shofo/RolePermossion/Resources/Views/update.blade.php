@extends('Dashboard::master')
@section('breadcrumb')
    <li><a href="{{route('role_permissions.index')}}" title="نقش های کاربری">نقش های کاربری</a></li>
    <li><a href="#" title=" ویرایش نقش کاربری"> ویرایش نقش کاربری</a></li>
@endsection
@section('content')
    <div class="col-8 bg-white" style="margin: 0 auto">
        <p class="box__title">ویرایش نقش کاربری</p>
        <form action="{{route('role_permissions.update',$role->id)}}" method="post" class="padding-30">
            @csrf
            @method('PATCH')
            <input type="hidden" name="id" value="{{ $role->id }}">
            <input type="text"
                   name="name"
                   placeholder="نام نقش کاربری"
                   class="text "
                   value="{{$role->name}}">
            @error('name')
            <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
            </span>
            @enderror

            <p class="box__title margin-bottom-15">انتخاب مجوزها</p>
            @foreach($permissions as $permission)
                <label class="ui-checkbox pt-1 pr-3">
                    <input type="checkbox"
                           name="permissions[{{ $permission->name }}]"
                           class="sub-checkbox"
                           data-id="2"
                           @if($role->hasPermissionTo($permission->name)) checked @endif
                           value="{{ $permission->name }}"
                           @if(is_array(old('permissions')) && array_key_exists($permission->name, old('permissions'))) checked @endif
                    >
                    <span class="checkmark"></span>
                    @lang($permission->name)
                </label>
            @endforeach

            @error("permissions")
            <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
    </span>
            @enderror
            <button class="btn btn-brand" style="margin-top: 20px">ویرایش کردن</button>
        </form>
    </div>
@endsection
@section('js')
    <script>
        @include('Common::layout.toast')
    </script>
@endsection
