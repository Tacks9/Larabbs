<!DOCTYPE html>
<!-- 获取的是 config/app.php 中的 locale 选项 -->
<html lang="{{ app()->getLocale() }}">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- CSRF Token csrf-token 标签是为了方便前端的 JavaScript 脚本获取 CSRF 令牌。 -->
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <!-- @yield('title', 'LaraBBS') 继承此模板的页面  是否有设置title变量 -->
  <title>@yield('title', 'LaraBBS') - Laravel 进阶教程</title>

  <!-- Styles mix('css/app.css') 会根据 webpack.mix.js 的逻辑来生成 CSS 文件链接。 -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">

</head>

<body>
  <!-- route_class() 辅助函数  针对某个页面做页面样式定制 -->
  <div id="app" class="{{ route_class() }}-page">
    <!-- 加载顶部导航区块的子模板。 -->
    @include('layouts._header')

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
</body>

</html>
