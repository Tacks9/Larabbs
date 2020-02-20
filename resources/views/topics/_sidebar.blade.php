<!-- <div class="card ">
  <div class="card-body">
    <a href="{{ route('topics.create') }}" class="btn btn-blue btn-block" aria-label="Left Align">
      <i class="fas fa-pencil-alt mr-2"></i>  新建帖子
    </a>
  </div>
</div>
 -->


@if (count($active_users))
  <div class="card mt-4">
    <div class="card-body active-users pt-2">
      <div class="text-center mt-1 mb-0 text-muted">
          <i class="fa fa-diamond" aria-hidden="true"></i>
          活跃用户
        </div>
      <hr class="mt-2">
      @foreach ($active_users as $active_user)
        <a class="media mt-2" href="{{ route('users.show', $active_user->id) }}">
          <div class="media-left media-middle mr-2 ml-1">
            <img src="{{ $active_user->avatar }}" width="24px" height="24px" class="media-object">
          </div>
          <div class="media-body">
            <small class="media-heading text-secondary">{{ $active_user->name }}</small>
          </div>
        </a>
      @endforeach
    </div>
  </div>
@endif

 <div class="card mt-4">
      <div class="card-body active-users pt-2">
        <div class="text-center mt-1 mb-0 text-muted">
            <i class="fa fa-diamond" aria-hidden="true"></i>
            轮播图
          </div>
        <hr class="mt-2">
            <div id="demo" class="carousel slide" data-ride="carousel">
              <!-- 指示符 -->
              <!-- <ul class="carousel-indicators">
                <li data-target="#demo" data-slide-to="0" class="active"></li>
                <li data-target="#demo" data-slide-to="1"></li>
                <li data-target="#demo" data-slide-to="2"></li>
              </ul> -->

              <!-- 轮播图片 自动 data-ride="carousel" -->
              <div class="carousel-inner" style="height: 200px;" data-ride="carousel" data-interval="5000">
                <div class="carousel-item active">
                  <img src="https://static.runoob.com/images/mix/img_fjords_wide.jpg">
                </div>
                <div class="carousel-item">
                  <img src="https://static.runoob.com/images/mix/img_nature_wide.jpg">
                </div>
                <div class="carousel-item">
                  <img src="https://static.runoob.com/images/mix/img_mountains_wide.jpg">
                </div>
              </div>

              <!-- 左右切换按钮 -->
              <a class="carousel-control-prev" href="#demo" data-slide="prev">
                <span class="carousel-control-prev-icon"></span>
              </a>
              <a class="carousel-control-next" href="#demo" data-slide="next">
                <span class="carousel-control-next-icon"></span>
              </a>

            </div>
      </div>
    </div>

@if (count($links))
  <div class="card mt-4">
    <div class="card-body pt-2">
      <div class="text-center mt-1 mb-0 text-muted">
        <i class="fa fa-link" aria-hidden="true"></i>
            资源推荐
        </div>
      <hr class="mt-2 mb-3">
      @foreach ($links as $link)
        <a class="media mt-1" href="{{ $link->link }}">
          <div class="media-body">
            <span class="media-heading text-muted">{{ $link->title }}</span>
          </div>
        </a>
      @endforeach
    </div>
  </div>
@endif
