<!-- 左侧用户的基本信息 -->

<div class="card ">
  <!-- 头像 -->

  <img class="card-img-top" src="{{ $user->avatar }}" alt="{{ $user->name }}">
  <!-- 关注按钮 -->
  @if (Auth::check())
    @include('users._follow_form')
  @endif

  <!-- 关注 粉丝 帖子 -->
  <div class="acard-body mt-2">
      <div class="clearfix text-center border-bottom">
        <a href="{{ route('users.show', [$user->id, 'tab' => 'followings']) }}">
        <div class="float-left w-25 ml-3" >
           <span class="font-weight-bold text-muted">
              关注
          </span>
          <p class="text-dark">{{ count($user->followings) }}</p>
        </div>
      </a>
      <a href="{{ route('users.show', [$user->id, 'tab' => 'followers']) }}">
        <div class="float-left w-25 ml-2" >
           <span class="font-weight-bold text-muted">
              粉丝
          </span>
          <p class="text-dark">{{ count($user->followers) }}</p>
        </div>
      </a>
      <a href="{{ route('users.show', $user->id) }}">
        <div class="float-left w-25  ml-2">
           <span class="font-weight-bold text-muted">
              帖子
          </span>
          <p class="text-dark">{{ $user->topics()->count() }}</p>
        </div>
      </a>
      </div>
    <!-- 个人信息 -->
    <div class="text-secondary p-3">
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
          <br>
          <i class="fa fa-angellist" style="width: 20px; " aria-hidden="true"></i>
            {{ $user->introduction }}
    </div>

  </div>
</div>
