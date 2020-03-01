<div class="list-group">
    @if( Auth::user()->id == $user->id)
    <a href="{{ route('password.request') }}" class="list-group-item">
        密码重置
    </a>
    @endif
    <a href="{{ route('users.show', $user->id) }}"
       class="list-group-item {{ active_class(if_query('tab', null)) }}">
      @if( Auth::user()->id == $user->id)
            我的帖子
             <span class="badge">{{Auth::user()->topics()->where('status',1)->count()}}</span>
        @else
            Ta 的帖子
      @endif
   </a>
     @if( Auth::user()->id == $user->id)
    <a href="{{ route('users.show', [$user->id, 'tab' => 'status']) }}"
       class="list-group-item  {{ active_class(if_query('tab', 'status')) }} ">
       <span class="badge">{{Auth::user()->topics()->where('status',0)->count()}}</span>
            正在审核
    </a>
    @endif

    <a href="{{ route('users.show', [$user->id, 'tab' => 'replies']) }}"
       class="list-group-item  {{ active_class(if_query('tab', 'replies')) }} ">

     @if( Auth::user()->id == $user->id)
            我的回复
            <span class="badge">{{Auth::user()->replies()->count()}}</span>
        @else
            Ta 的回复
      @endif
   </a>
   <a href="{{ route('users.show', [$user->id, 'tab' => 'favorites']) }}"
       class="list-group-item  {{ active_class(if_query('tab', 'favorites')) }} ">
     @if( Auth::user()->id == $user->id)
            我的收藏
            <span class="badge">{{Auth::user()->favorites()->count()}}</span>
        @else
            Ta 的收藏
      @endif
   </a>
    <a href="{{ route('users.show', [$user->id, 'tab' => 'followings']) }}"
       class="list-group-item  {{ active_class(if_query('tab', 'followings')) }} ">
     @if( Auth::user()->id == $user->id)
            我的关注
            <span class="badge">{{Auth::user()->followings()->count()}}</span>
        @else
            Ta 的关注
      @endif
   </a>
   <a href="{{ route('users.show', [$user->id, 'tab' => 'followers']) }}"
       class="list-group-item  {{ active_class(if_query('tab', 'followers')) }} ">
     @if( Auth::user()->id == $user->id)
            我的粉丝
            <span class="badge">{{Auth::user()->followers()->count()}}</span>
        @else
            Ta 的粉丝
      @endif
   </a>

</div>
