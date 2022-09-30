<div class="file-upload">
    <div class="i-file-upload">
        <span>آپلود بنر دوره</span>
        <input type="file" class="file-upload" id="files" name="{{$name}}"/>
    </div>
    <span class="filesize"></span>
    <span class="selectedFiles">فایلی انتخاب نشده است</span>
</div>

<x-validation-error filed="{{$name}}"/>
