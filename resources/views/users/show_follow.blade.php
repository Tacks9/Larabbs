@extends('layouts.app')

@section('title',' 的个人中心')

@section('content')

<div class="row">

  <div class="col-lg-3 col-md-3 hidden-sm hidden-xs user-info">
    <div class="card ">
      <img class="card-img-top" src="{{ $user->avatar }}" alt="{{ $user->name }}">
      <div class="card-body ">
        <hr>
          <div class="clearfix text-center"  >
            <a href="{{ route('users.followings', $user->id) }}">
            <div class="float-left w-25 ml-2" >
               <span class="font-weight-bold text-muted">
                  关注
              </span>
              <p class="text-dark">{{ count($user->followings) }}</p>
            </div>
          </a>
          <a href="{{ route('users.followers', $user->id) }}">
            <div class="float-left w-25 ml-2" >
               <span class="font-weight-bold text-muted">
                  粉丝
              </span>
              <p class="text-dark">{{ count($user->followers) }}</p>
            </div>
          </a>
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

    {{-- 列表 --}}
      <div class="list-group list-group-flush">
    @foreach ($users as $user)
      <div class="list-group-item">
        <img class="mr-3" src="{{ $user->avatar }}" alt="{{ $user->name }}" width=32>
        <a href="{{ route('users.show', $user) }}">
          {{ $user->name }}
        </a>
      </div>

    @endforeach
  </div>


  </div>
</div>
@stop
