@if (count($users))

  <ul class="list-group mt-4 border-0">
     @foreach ($users as $user)
      <div class="list-group-item">
        <img class="mr-3" src="{{ $user->avatar }}" alt="{{ $user->name }}" width=32>
        <a href="{{ route('users.show', $user) }}">
          {{ $user->name }}
        </a>
      </div>
    @endforeach

  </ul>

@else
  <div class="empty-block">暂无数据 ~_~ </div>
@endif

{{-- 分页 --}}
<div class="mt-4 pt-1">
  {!! $users->appends(Request::except('page'))->render() !!}
</div>
