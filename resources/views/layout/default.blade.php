<!DOCTYPE html>
<html lang="ja">
<head>
    @include('elements.meta')
</head>
<body>
<a id="pagetop"></a>
<div id="header">
    @include('elements.header')
</div>
<div class="container-fluid">
    <div id="breadcrumbWrap" class="alert-secondary alert">
        @yield('breadcrumb')
    </div>
</div>
@include('elements.flash-messages')
<div id="Contentwrap">
    @yield('content')
</div>
@include('elements.dialog')
@include('elements.footer')
</body>
</html>
