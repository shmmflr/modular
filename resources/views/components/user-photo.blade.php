<div class="profile__info border cursor-pointer text-center">

    <div class="avatar__img">
        <img src="{{auth()->user()->image?auth()->user()->image->thumb :asset('panel/img/pro.jpg')}}"
             class="avatar___img">
        <form action="{{route('users.photo')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" accept="image/*" class="hidden avatar-img__input"
                   name="photo"
                   onchange="this.form.submit()"
            >
            <div class="v-dialog__container" style="display: block;"></div>
            <div class="box__camera default__avatar"></div>
        </form>
    </div>

    <span class="profile__name">
        کاربر :
        {{auth()->user()->name}}
    </span>

</div>
