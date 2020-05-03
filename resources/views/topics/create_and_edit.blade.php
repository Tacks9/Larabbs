@extends('layouts.app')

@section('content')

  <div class="container">
    <div class="col-md-10 offset-md-1">
      <div class="card ">

        <div class="card-body">
          <h2 class="">
            <i class="fa fa-paper-plane-o" aria-hidden="true"></i>
            @if($topic->id)
            编辑帖子
            @else
            新建帖子
            @endif
          </h2>

          <hr>

          @if($topic->id)
            <form action="{{ route('topics.update', $topic->id) }}" method="POST" accept-charset="UTF-8">
              <input type="hidden" name="_method" value="PUT">
          @else
            <form action="{{ route('topics.store') }}" method="POST" accept-charset="UTF-8">
          @endif

              <input type="hidden" name="_token" value="{{ csrf_token() }}">

              @include('shared._error')

              <div class="row">
                  <div class="form-group col-sm-3">
                    <select class="form-control" name="category_id" required>
                      <option value="" hidden disabled {{ $topic->id ? '' : 'selected' }}>请选择分类</option>
                        @foreach ($categories as $value)
                          <option value="{{ $value->id }}" {{ $topic->category_id == $value->id ? 'selected' : '' }}>
                            {{ $value->name }}
                          </option>
                        @endforeach
                    </select>
                  </div>


                  <div class="col-sm-9">
                      <select id="select_tag" name="select_tag" class="selectpicker show-tick form-control" multiple data-live-search="true" data-max-options="3"
                       title="最多选择三个标签" >
                        @foreach ($tags as $value)
                              <option value="{{ $value->id }}"
                                 data-tokens="{{ $value->description }}">
                                 {{ $value->name }}</option>
                        @endforeach
                      </select>
                  </div>
                  <input type="text" id="input_tag" style="display:none;" name="input_tag"/>
              </div>



              <div class="form-group">
                <div class="form-group">
                    <input class="form-control" type="text" name="title" value="{{ old('title', $topic->title ) }}" placeholder="请填写标题" required />
                  </div>
              </div>
              <div class="form-group">
                <textarea name="body" class="form-control" id="editor" rows="6" placeholder="至少三个字符的内容...." required>{{ old('body', $topic->body ) }}</textarea>
              </div>

              <div class="well well-sm">
                <button type="submit" class="btn btn-primary"><i class="far fa-save mr-2" aria-hidden="true"></i> 保存</button>
              </div>
            </form>
        </div>
      </div>
    </div>
  </div>

@endsection


@section('styles')
  <link rel="stylesheet" type="text/css" href="{{ asset('css/simditor.css') }}">
 <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/css/bootstrap-select.min.css">
@stop

@section('scripts')
  <script type="text/javascript" src="{{ asset('js/module.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/hotkeys.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/uploader.js') }}"></script>
  <script type="text/javascript" src="{{ asset('js/simditor.js') }}"></script>

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/bootstrap-select.min.js"></script>

    <!-- (Optional) Latest compiled and minified JavaScript translation files -->
    <!-- <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.9/dist/js/i18n/defaults-*.min.js"></script> -->

  <script>
    // 编辑器
    $(document).ready(function() {
      var editor = new Simditor({
        textarea: $('#editor'),
        toolbar: ['title', 'bold', 'italic', 'underline', 'strikethrough', 'fontScale', 'color', '|', 'ol', 'ul', 'blockquote', 'code', 'table', '|', 'link', 'image', 'hr', '|', 'indent', 'outdent', 'alignment'],
        upload: {
          url: '{{ route('topics.upload_image') }}',
          params: {
            _token: '{{ csrf_token() }}'
          },
          fileKey: 'upload_file', // 服务器端获取图片的键值
          connectionCount: 3,     // 多只能同时上传 3 张图片
          leaveConfirm: '文件上传中，关闭此页面将取消上传。'
        },
        pasteImage: true,// 设定是否支持图片黏贴上传，这里我们使用 true 进行开启
      });
    });


    // 下拉选择标签
    $(window).on('load', function () {
        $('#select-tag').selectpicker({
            'selectedText': 'cat'
        });
        // 数据传输
        // 新建
        $('#select_tag').on('changed.bs.select', function(e) {
           $("#input_tag").val($(this).val());
        });
        // 编辑
        response_edit = '{{ $tags_str ? $tags_str : ''  }}'
        if(response_edit) {
           $("#select_tag").val(response_edit.split(","));
          $("#input_tag").val(response_edit);
          $("#select_tag").selectpicker('refresh');
        }

    });


  </script>


@stop
