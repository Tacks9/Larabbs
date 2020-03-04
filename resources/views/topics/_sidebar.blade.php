<div class="card ">
  <div class="card-body">
    <a href="{{ route('topics.create') }}" class="btn btn-blue btn-block" aria-label="Left Align">
      <i class="fas fa-pencil-alt mr-2"></i>  新建帖子
    </a>
  </div>
</div>



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

@if (count($carousels))
 <div class="card mt-4">
      <div class="card-body active-users pt-2">
        <div class="text-center mt-1 mb-0 text-muted">
            <i class="fa fa-cubes" aria-hidden="true"></i>
            特色推荐
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
                    @foreach ($carousels as $carousel)

                        @if ($loop->first)
                              <div class="carousel-item active ">
                                  <a href="{{ $carousel->link}}" target="_blank">
                                         <img src="{{ $carousel->image }}">
                                          <div class="carousel-caption">
                                            <h5> <kbd>{{ $carousel->title }} </kbd></h5>
                                          </div>
                                  </a>
                              </div>
                             @else
                             <div class="carousel-item">
                                  <a href="{{ $carousel->link}}"  target="_blank" >
                                         <img src="{{ $carousel->image }}">
                                         <div class="carousel-caption">
                                            <h5> <kbd>{{ $carousel->title }} </kbd></h5>
                                          </div>
                                  </a>
                              </div>
                        @endif
                    @endforeach
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
@endif

@if (count($tags))
  <div class="card mt-4">
    <div class="card-body pt-2" style="overflow: hidden;">
      <div class="text-center mt-1 mb-0 text-muted">
        <i class="fa fa-tags" aria-hidden="true"></i>
            标签云
        </div>
      <hr class="mt-2 mb-3">

      <div class="wrapper">
        <div class="tagcloud">
            @foreach ($tags as $tag)
                <a href="#">{{ $tag->name }}&{{ $tag->post_count }}</a>
            @endforeach
        </div>
      </div>
    </div>
  </div>
@endif


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


@section('scripts')
<!-- 引入标签云js -->
  <script type="text/javascript" src="{{ asset('js/tagcloud.js') }}"></script>
  <script type="text/javascript">

     /*3D标签云*/
    tagcloud({
        selector: ".tagcloud",  //元素选择器
        fontsize: 16,       //基本字体大小, 单位px
        radius: 100,         //滚动半径, 单位px
        mspeed: "normal",   //滚动最大速度, 取值: slow, normal(默认), fast
        ispeed: "normal",   //滚动初速度, 取值: slow, normal(默认), fast
        direction: 135,     //初始滚动方向, 取值角度(顺时针360): 0对应top, 90对应left, 135对应right-bottom(默认)...
        keep: false          //鼠标移出组件后是否继续随鼠标滚动, 取值: false, true(默认) 对应 减速至初速度滚动, 随鼠标滚动
    });
  </script>
@stop
