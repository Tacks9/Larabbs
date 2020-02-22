@extends('layouts.app')

@section('title', $user->name . ' 的个人中心')

@section('content')

<div class="row">

  <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
      <!-- 左侧个人信息 -->
      @include('users._user_info')


  </div>
  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
<!--     <div class="card ">
      <div class="card-body">
          <h1 class="mb-0" style="font-size:22px;">{{ $user->name }} <small>{{ $user->email }}</small></h1>
      </div>
    </div>
    <hr> -->

    {{-- 用户发布的内容 --}}
    <div class="card ">
      <div class="card-body">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link bg-transparent {{ active_class(if_query('tab', null)) }}" href="{{ route('users.show', $user->id) }}">
              Ta 的话题
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link bg-transparent {{ active_class(if_query('tab', 'replies')) }}" href="{{ route('users.show', [$user->id, 'tab' => 'replies']) }}">
              Ta 的回复
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link bg-transparent {{ active_class(if_query('tab', 'followings')) }}" href="{{ route('users.show', [$user->id, 'tab' => 'followings']) }}">
              Ta 的关注
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link bg-transparent {{ active_class(if_query('tab', 'followers')) }}" href="{{ route('users.show', [$user->id, 'tab' => 'followers']) }}">
              Ta 的粉丝
            </a>
          </li>
        </ul>
        @if (if_query('tab', 'replies'))
          @include('users._replies', ['replies' => $user->replies()->with('topic')->recent()->paginate(10)])

        @elseif (if_query('tab', 'followings'))
          @include('users._user_followers',['users' => $usersFollowings])

        @elseif (if_query('tab', 'followers'))
          @include('users._user_followers',['users' => $usersFollowers])

        @else
          @include('users._topics', ['topics' => $user->topics()->recent()->paginate(10)])
        @endif
      </div>
    </div>


  </div>
</div>
@stop
