@extends('layouts.app')

@section('title', '公告')

@section('js_app_layouts')
    <script src="/js/app.js"></script>
@endsection

@section('js_app_promise')
    <script src="/ckeditor/ckeditor.js"></script>
@endsection

@section('content')
<style>
    #cke_22{ display: none;}
</style>
<div class="container">
    <form>
        标题：
        <input type="text" value="title"><br>
        内容：
        <textarea name="notice_cont"></textarea>
        <script>
            CKEDITOR.replace('notice_cont');
        </script>

    </form>
</div>
@endsection