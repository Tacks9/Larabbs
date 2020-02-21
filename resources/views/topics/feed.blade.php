@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="col-lg-9 col-md-9 topic-list">
            <div class="card">
                  <div class="card-header d-flex justify-content-between text-muted">
                   您和您关注的用户的帖子都会在这里出现，时刻关注动态！
                  </div>

                <div class="card-body">
                  <!-- {{-- 搜索结果 --}} -->
                    @if ($count > 0)
                        @include('topics._topic_list',$topics)
                    @else
                        未搜索到结果!
                    @endif
                  <!-- {{-- 分页 --}} -->
                  <div class="mt-5">
                    {!! $topics->render() !!}
                  </div>
                </div>
            </div>

        </div>
        <!-- 右侧 -->
         <div class="col-lg-3 col-md-3 sidebar">
          @include('topics._sidebar')
        </div>
    </div>
@stop
