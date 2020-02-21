@can('follow', $user)
  <!-- 是自己的个人页面时 关注表单不应该被显示出来 -->
  <div class="text-center mt-2 mb-4">
    <!-- 判断用户是否已被关注 -->
    @if (Auth::user()->isFollowing($user->id))
      <form action="{{ route('followers.destroy', $user->id) }}" method="post">
        {{ csrf_field() }}
        {{ method_field('DELETE') }}
        <button type="submit" class="btn btn-sm btn-outline-primary w-75">
          <i class="fa fa-minus-square-o" aria-hidden="true"></i> 取关
        </button>
      </form>
    @else
      <form action="{{ route('followers.store', $user->id) }}" method="post">
        {{ csrf_field() }}
        <button type="submit" class="btn btn-sm btn-primary w-75">
          <i class="fa fa-plus" aria-hidden="true"></i>关注
        </button>
      </form>
    @endif
  </div>
@endcan
