@if (count($topics))
  <ul class="list-unstyled">
    @foreach ($topics as $topic)
      <li class="media">
        <div class="media-left">
          <a href="{{ route('users.show', [$topic->user_id]) }}">
            <img class="media-object img-thumbnail mr-3" style="width: 52px; height: 52px;" src="{{ $topic->user->avatar }}" title="{{ $topic->user->name }}">
          </a>
        </div>

        <div class="media-body">

          <div class="media-heading mt-0 mb-1">
            @if ($topic->top == 1)
            <span class="text-white p-1 mr-1" style="border-radius: 3px;background-color: #5a73cc;">置顶</span>
            @endif
             <a href="{{ $topic->link() }}" title="{{ $topic->title }}">
                {{ $topic->title }}
             </a>
           <!--  <a class="float-right" href="{{ route('topics.show', [$topic->id]) }}">
              <span class="badge badge-secondary badge-pill"> {{ $topic->reply_count }} </span>
            </a> -->
          </div>

          <small class="media-body meta text-secondary">
<!-- 按照分类展示帖子 -->
             <a class="text-secondary" href="{{ route('categories.show', $topic->category_id) }}" title="{{ $topic->category->name }}">
              <i class="far fa-folder"></i>
              {{ $topic->category->name }}
            </a>

            <span> • </span>

            <a class="text-secondary" href="{{ route('users.show', [$topic->user_id]) }}" title="{{ $topic->user->name }}">
              <i class="far fa-user"></i>
              {{ $topic->user->name }}
            </a>

            <span> • </span>

            <i class="far fa-clock"></i>
            <span class="timeago" title="最后活跃于：{{ $topic->updated_at }}">
              {{ $topic->updated_at->diffForHumans() }}
            </span>

            <!-- 阅读数 评论数  -->
             <a class="float-right float-right-space" href="{{ route('topics.show', [$topic->id]) }}">
              <span class="badge badge-secondary badge-pill">
                <i class="fa fa-eye" aria-hidden="true"></i>
                {{ $topic->view_count }}
              </span>
            </a>
             <a class="float-right float-right-space" href="{{ route('topics.show', [$topic->id]) }}">
              <span class="badge badge-secondary badge-pill">
                <i class="fa fa-comments-o" aria-hidden="true"></i>
                {{ $topic->reply_count }}
                </span>
            </a>
            <a class="float-right" href="{{ route('topics.show', [$topic->id]) }}">
              <span class="badge badge-secondary badge-pill">
                <i class="fa fa-star-o" aria-hidden="true"></i>
                {{ $topic->favorite_count }}
                </span>
            </a>
          </small>

        </div>
      </li>

      @if ( ! $loop->last)
        <hr>
      @endif

    @endforeach
  </ul>

@else
  <div class="empty-block">暂无数据 ~_~ </div>
@endif
