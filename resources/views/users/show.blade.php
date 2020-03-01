@extends('layouts.app')

@section('title', $user->name . ' 的个人中心')

@section('content')

<div class="row">
  <!-- 左侧部分 -->
  <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
      <!-- 左侧个人信息 -->
      @include('users._user_info')
      <hr>
      <!-- 左侧导航 -->
      @include('users._left_nav')
  </div>
  <!-- 右侧部分 -->
  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">

    <div class="card ">
      <div class="card-body">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link bg-transparent {{ active_class(if_query('tab', null)) }}" href="{{ route('users.show', $user->id) }}">
              @if( Auth::user()->id == $user->id)
                我的帖子
              @else
                Ta 的帖子
              @endif
            </a>
          </li>
          @if( Auth::user()->id == $user->id)

          <li class="nav-item">
            <a class="nav-link bg-transparent {{ active_class(if_query('tab', 'status')) }}" href="{{ route('users.show',  [$user->id, 'tab' => 'status']) }}">
                正在审核
            </a>
          </li>
          @endif

          <li class="nav-item">
            <a class="nav-link bg-transparent {{ active_class(if_query('tab', 'replies')) }}" href="{{ route('users.show', [$user->id, 'tab' => 'replies']) }}">
              @if( Auth::user()->id == $user->id)
                我的回复
              @else
                Ta 的回复
              @endif
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link bg-transparent {{ active_class(if_query('tab', 'favorites')) }}" href="{{ route('users.show', [$user->id, 'tab' => 'favorites']) }}">
              @if( Auth::user()->id == $user->id)
                我的收藏
              @else
                Ta 的收藏
              @endif
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link bg-transparent {{ active_class(if_query('tab', 'followings')) }}" href="{{ route('users.show', [$user->id, 'tab' => 'followings']) }}">
              @if( Auth::user()->id == $user->id)
                我的关注
              @else
                Ta 的关注
              @endif
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link bg-transparent {{ active_class(if_query('tab', 'followers')) }}" href="{{ route('users.show', [$user->id, 'tab' => 'followers']) }}">
              @if( Auth::user()->id == $user->id)
                我的粉丝
              @else
                Ta 的粉丝
              @endif
            </a>
          </li>
        </ul>
        @if (if_query('tab', 'replies'))
          @include('users._replies', ['replies' => $user->replies()->with('topic')->recent()->paginate(10)])

        @elseif (if_query('tab', 'status'))
          @include('users._topics',['topics' => $user->topics()->where('status',0)->recent()->paginate(10)])

        @elseif (if_query('tab', 'followings'))
          @include('users._user_follow',['users' => $user->followings()->paginate(10) ])

        @elseif (if_query('tab', 'followers'))
          @include('users._user_follow',['users' => $user->followers()->paginate(10)])

        @elseif (if_query('tab', 'favorites'))
          @include('users._topics',['topics' =>
          $user->favorites()->where('status',1)->recent()->paginate(10)])

        @else
          @include('users._topics', ['topics' => $user->topics()->where('status',1)->recent()->paginate(10)])
        @endif
      </div>
    </div>


  </div>
</div>
@stop
