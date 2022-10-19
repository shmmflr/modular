<div class="sidebar__nav border-top border-left  ">
    <span class="bars d-none padding-0-18"></span>
    <a class="header__logo  d-none" href=""></a>

        <x-user-photo/>


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
