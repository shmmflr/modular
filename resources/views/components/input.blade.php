<div class="w-100 mx-5">
    <input type="{{$type}}" class="text" placeholder="{{$placeholder}}" name="{{$name}}"
           value="{{old($name)}}"
        {{$attributes->merge(['class'=>'text w-100'])}}
    >
    <x-validation-error filed="{{$name}}"/>
</div>
