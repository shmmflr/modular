<select name="{{$name}}" {{$attributes}}>
    {{$slot}}
</select>
<x-validation-error filed="{{$name}}"/>

