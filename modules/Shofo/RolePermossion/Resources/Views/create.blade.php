<p class="box__title">ایجاد نقش کاربری</p>
<form action="{{route('role_permissions.store')}}" method="post" class="padding-30">
    @csrf
    <input type="text" name="name" placeholder="نام نقش کاربری" class="text">
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
    <button class="btn btn-brand" style="margin-top: 20px">اضافه کردن</button>
</form>
