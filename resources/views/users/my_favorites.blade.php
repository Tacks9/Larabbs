@extends('layouts.app')

@section('title', $user->name . ' 的个人中心')

@section('content')

<div class="row">

  <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
      <!-- 左侧个人信息 -->
      @include('users._user_info')
      <hr>
      @include('users._left_nav')
  </div>
  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

    {{-- 用户发布的内容 --}}
    <div class="card ">
      <div class="card-body">
@if (count($myFavorites))

  <ul class="list-group mt-4 border-0">
    @foreach ($myFavorites as $topic)
      <li class="list-group-item pl-2 pr-2 border-right-0 border-left-0 @if($loop->first) border-top-0 @endif">
        <a href="{{ $topic->link() }}" title="{{ $topic->title }}">
                {{ $topic->title }}
        </a>
        <span class="meta float-right text-secondary">
          {{ $topic->reply_count }} 回复
          <span> ⋅ </span>
          {{ $topic->created_at->diffForHumans() }}
        </span>
      </li>
    @endforeach
  </ul>

@else
  <div class="empty-block">暂无数据 ~_~ </div>
@endif

{{-- 分页 --}}
<div class="mt-4 pt-1">
  {!! $myFavorites->render() !!}
</div>

      </div>
    </div>

  </div>


</div>
@stop
