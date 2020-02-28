@extends('layouts.app')

@section('title', $topic->title)
@section('description', $topic->excerpt)

@section('content')

  <div class="row">

    <div class="col-lg-3 col-md-3 hidden-sm hidden-xs author-info">
           <!-- 左侧个人信息 -->
          @include('users._user_info',['user'=>$topic->user])
    </div>

    <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12 topic-content">
        @if ( $is_status == 0)
            <div class="alert alert-warning" role="alert">正在审核中，通过后其他人方可看到，并进行回复~</div>
        @endif
      <div class="card">
        <div class="card-body">
          <h1 class="text-center mt-3 mb-3">
            {{ $topic->title }}
          </h1>

          <div class="article-meta text-center text-secondary">
            {{ $topic->created_at->diffForHumans() }}
            ⋅
            <i class="fa fa-eye" aria-hidden="true"></i>
            {{ $topic->view_count }}
            ⋅
             <i class="fa fa-comments-o" aria-hidden="true"></i>
            {{ $topic->reply_count }}
            ⋅
             <!--  <i class="fa fa-heart-o" aria-hidden="true"></i>
              {{ $topic->favorite_count }}
 -->
             <!-- 收藏 -->
            @if (Auth::check())
                @include('topics._favorit_form',['user'=>$topic->user])
              @endif

          </div>

          <div class="topic-body mt-4 mb-4">
            {!! $topic->body !!}
          </div>

          @can('update', $topic)
            <div class="operate">
              <hr>
              <a href="{{ route('topics.edit', $topic->id) }}" class="btn btn-outline-secondary btn-sm" role="button">
                <i class="far fa-edit"></i> 编辑
              </a>
              <form action="{{ route('topics.destroy', $topic->id) }}" method="post"
                    style="display: inline-block;"
                    onsubmit="return confirm('您确定要删除吗？');">
                {{ csrf_field() }}
                {{ method_field('DELETE') }}
                <button type="submit" class="btn btn-outline-secondary btn-sm">
                  <i class="far fa-trash-alt"></i> 删除
                </button>
              </form>

            </div>
          @endcan

        </div>
      </div>

      {{-- 用户回复列表 --}}

      @if ( $is_status == 0)
        <!-- 正在审核 看不到回复 -->
      @else
      <div class="card topic-reply mt-4">
          <div class="card-body">
              @includeWhen(Auth::check(), 'topics._reply_box', ['topic' => $topic])
              @include('topics._reply_list', ['replies' => $topic->replies()->with('user')->get()])
          </div>
      </div>
      @endif

    </div>
  </div>
@stop
