@extends('layouts.app')

@section('title', $user->name . ' 的个人中心')

@section('content')

<div class="row">

  <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
    <div class="card ">
      <img class="card-img-top" src="{{ $user->avatar }}" alt="{{ $user->name }}">
      <div class="card-body ">
        <hr>
          <div class="clearfix text-center"  >
            <div class="float-left w-25 ml-2" >
               <span class="font-weight-bold text-muted">
                  关注
              </span>
              <p class="text-dark">{{ count($user->followings) }}</p>
            </div>
            <div class="float-left w-25 ml-2" >
               <span class="font-weight-bold text-muted">
                  粉丝
              </span>
              <p class="text-dark">{{ count($user->followers) }}</p>
            </div>
            <div class="float-left w-25  ml-2">
               <span class="font-weight-bold text-muted">
                  帖子
              </span>
              <p class="text-dark">{{ $user->topics()->count() }}</p>
            </div>
          </div>
        <hr>

        <div class="text-secondary">
            <h5>
              <i class="fa fa-home" style="width: 20px;" aria-hidden="true"></i>
              <strong>{{ $user->name }}</strong>
            </h5>
              <i class="fa fa-envelope-o" style="width: 20px;" aria-hidden="true"></i>
                {{ $user->email }}

              <br>
              <i class="fa fa-clock-o" style="width: 20px;" aria-hidden="true"></i>
              注册时间：{{ $user->created_at->diffForHumans() }}
              <br>
              <i class="fa fa-fire" style="width: 20px;" aria-hidden="true"></i>
              最近活跃：{{ $user->last_actived_at->diffForHumans() }}
        </div>

        <br>
              <i class="fa fa-angellist" style="width: 20px; " aria-hidden="true"></i>
                {{ $user->introduction }}
      </div>

    </div>
  </div>
  <div class="col-lg-9 col-md-9 col-sm-12 col-xs-12">
   <!--  <div class="card ">
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
        </ul>
        @if (if_query('tab', 'replies'))
          @include('users._replies', ['replies' => $user->replies()->with('topic')->recent()->paginate(5)])
        @else
          @include('users._topics', ['topics' => $user->topics()->recent()->paginate(5)])
        @endif
      </div>
    </div>


  </div>
</div>
@stop
