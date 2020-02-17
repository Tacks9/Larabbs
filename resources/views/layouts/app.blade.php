<!DOCTYPE html>
<!-- 获取的是 config/app.php 中的 locale 选项 -->
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token csrf-token 标签是为了方便前端的 JavaScript 脚本获取 CSRF 令牌。 -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>@yield('title', 'LaraBBS') - {{ setting('site_name', 'Laravel 进阶教程') }}</title>
  <meta name="description" content="@yield('description', setting('seo_description', 'LaraBBS 爱好者社区。'))" />
  <meta name="keyword" content="@yield('keyword', setting('seo_keyword', 'LaraBBS,社区,论坛,开发者论坛'))" />

  <!-- Styles mix('css/app.css') 会根据 webpack.mix.js 的逻辑来生成 CSS 文件链接。 -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">

  <!-- 加载发布帖子需要的样式 -->
   @yield('styles')
</head>

<body>
  <!-- route_class() 辅助函数  针对某个页面做页面样式定制 -->
  <div id="app" class="{{ route_class() }}-page">
    <!-- 加载顶部导航区块的子模板。 文章分类的自动缓存加载 -->
   @include('layouts._header', ['categories' => app(\App\Models\Category::class)->categories()])

    <div class="container">

      @include('shared._messages')
      <!-- yield('content') 占位符声明，允许继承此模板的页面注入内容。 -->
      @yield('content')

    </div>
      <!-- 加载页面尾部导航区块的子模板 -->
    @include('layouts._footer')
  </div>

  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}"></script>

    @if (app()->isLocal())
      @include('sudosu::user-selector')
    @endif

  <!-- Scripts -->
  <!-- 加载 新建帖子的时候需要的编辑器 -->
  @yield('scripts')
</body>

</html>
