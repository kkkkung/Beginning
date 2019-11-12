<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="author" content="">
    <meta name="description" content="">

    <title>@yield('title','Sample')</title>

    <!--Bootstrap core CSS-->
    <link rel="stylesheet" href="/css/app.css">

    <!--Custom styles for this template -->
    <link href="/css/self-defining.css" rel="stylesheet">

</head>
<body class="text-center">
<div class="d-flex w-100 h-100 p-3 mx-auto flex-column">
    @include('layouts._header')
<main role="main" class="inner cover container">
    @include('shared._messages')
    @yield('content')
</main>
    @include('layouts._footer')
</div>
    <script src="/js/app.js"></script>

</body>
</html>