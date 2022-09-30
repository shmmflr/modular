<div class="sidebar__nav border-top border-left  ">
    <span class="bars d-none padding-0-18"></span>
    <a class="header__logo  d-none" href=""></a>
    <div class="profile__info border cursor-pointer text-center">
        <div class="avatar__img"><img src="{{asset('panel/img/pro.jpg')}}" class="avatar___img">
            <input type="file" accept="image/*" class="hidden avatar-img__input">
            <div class="v-dialog__container" style="display: block;"></div>
            <div class="box__camera default__avatar"></div>
        </div>
        <span class="profile__name">کاربر :
        {{auth()->user()->name}}
               </span></div>

    <ul>
        @foreach(config('sidebar.items') as $item)
{{--            @can()--}}
                <li class="item-li {{$item['icon']}}
                @if($item['url']==request()->url()) is-active @endif">
                    <a href="{{$item['url']}}">{{$item['title']}}</a>
                </li>
{{--            @endcan--}}
        @endforeach
    </ul>

</div>
