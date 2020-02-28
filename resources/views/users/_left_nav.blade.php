<div class="list-group">
    <a href="{{ route('users.show', $user->id) }}"
       class="list-group-item {{ active_class(if_query('tab', null)) }}">
      @if( Auth::user()->id == $user->id)
            我的帖子
        @else
            Ta 的帖子
      @endif
   </a>
    <a href="{{ route('users.show', [$user->id, 'tab' => 'replies']) }}"
       class="list-group-item  {{ active_class(if_query('tab', 'replies')) }} ">
     @if( Auth::user()->id == $user->id)
            我的回复
        @else
            Ta 的回复
      @endif
   </a>
   <a href="{{ route('users.my_favorites', ['tab' => 'my_favorites']) }}"
       class="list-group-item  {{ active_class(if_query('tab', 'my_favorites')) }} ">
     @if( Auth::user()->id == $user->id)
            我的收藏
        @else
            Ta 的收藏
      @endif
   </a>
    <a href="#" class="list-group-item">Vestibulum at eros</a>
</div>
