<div class="file-upload">
    <div class="i-file-upload">
        <span>آپلود بنر دوره</span>
        <input type="file" class="file-upload" id="files" name="{{$name}}" {{$attributes}}/>
    </div>
    @if(isset($value))
        <span class="selectedFiles">
        <img src="{{$value->thumb}}"/>
        </span>
    @else
        <span class="filesize"></span>
        <span class="selectedFiles">فایلی انتخاب نشده است</span>
    @endif
</div>

<x-validation-error filed="{{$name}}"/>
