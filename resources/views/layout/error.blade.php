<!DOCTYPE html>
<html lang="ja">
<head>
    @include('elements.meta')
</head>
<body>
<div class="wrapper-container">
    <a id="pagetop"></a>
    <div id="header">
        @include('elements.header')
    </div>

    <div class="row">
        <div class="col-12">
            @yield('content')
        </div>
    </div>
</div>
@include('elements.footer')
</body>
</html>
