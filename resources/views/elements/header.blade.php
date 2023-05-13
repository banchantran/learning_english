{{--<div class="container-fluid">--}}
{{--    <div class="row">--}}
{{--        <div class="col-1">--}}
{{--            <a href="{{url('/')}}"><img src="{{url('img/speak_english.png')}}" alt="logo" width="100px" class="logo-top"></a>--}}
{{--        </div>--}}
{{--        <div class="col-2 offset-9 group-search">--}}
{{--            <input type="text" class="form-control" placeholder="Keyword..." aria-label="" aria-describedby="basic-addon1">--}}
{{--            <button class="btn btn-info">Search</button>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="#"><img src="{{url('img/speak_english.png')}}" alt="logo" width="100px" class="logo-top"></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item active">
                    <a class="nav-link" href="#">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="/">Category</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{url(route('bookmark.learn'))}}">Bookmark</a>
                </li>
                {{--<li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        Category
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="#">Lesson</a>
                    </div>
                </li>--}}
            </ul>
            <form class="form-inline my-2 my-lg-0 group-search">
                <input class="form-control mr-sm-2" type="search" placeholder="Keyword..." aria-label="Search">
                <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
            </form>
        </div>
    </div>
</nav>
