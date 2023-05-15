<!DOCTYPE html>
<html lang="ja">
<head>
    @include('elements.meta')
</head>
<body>
<div class="wrapper-container">
    @include('elements.flash-messages')
    @yield('content')
</div>
@yield('script')
</body>
</html>
