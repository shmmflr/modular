<textarea placeholder="{{$placeholder}}" class="text h" name="{{$name}}">{!! old('body')??$value!!}</textarea>
<x-validation-error filed="{{$name}}"/>
<br>
