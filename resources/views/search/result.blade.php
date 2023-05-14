@extends('layout.default')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            {{--            <li class="breadcrumb-item"><a href="{{url(route('home'))}}">{{$category->name}}</a></li>--}}
            <li class="breadcrumb-item active" aria-current="page">Search</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="container">

        <div class="row mt-4 mb-4">
            <div class="col-8 offset-2">
                <form class="form-inline my-2 my-lg-0 d-flex group-search align-items-center justify-content-center">
                    <div class="form-group w-75">
                        <input type="password" class="form-control" id="inputPassword2" placeholder="Password">
                    </div>
                    <button type="submit" class="btn btn-outline-success my-2 my-sm-0 ml10">Search</button>
                </form>
            </div>
        </div>
        <div class="row mb-20">
            <div class="col-lg-6">
                <div class="records">Showing: <b>1-20</b> of <b>200</b> result</div>
            </div>
        </div>
        <div class="list-result container">
            <div class="row result-item">
                <div class="col-6">
                    <div class="learning-text">
                        <p class="text-source">to need a lot of imagination</p>
                        <p class="text-destination">cần nhiều sự tưởng tượng</p>
                    </div>
                </div>
                <div class="col-5">
                    <div class="category-lesson">
                        <p class="link-category">Vocabulary for IELTS</p>
                        <p class="link-lesson">Lesson 1</p>
                    </div>
                </div>
                <div class="col-1 text-end">
                    <img src="{{url('img/play.png')}}" alt="play" width="20px" class="mr-10">
                    <img src="{{url('img/bookmark.png')}}" alt="bookmark" width="20px">
                </div>
            </div>
            <div class="row result-item">
                <div class="col-6">
                    <div class="learning-text">
                        <p class="text-source">to need a lot of imagination</p>
                        <p class="text-destination">cần nhiều sự tưởng tượng</p>
                    </div>
                </div>
                <div class="col-5">
                    <div class="category-lesson">
                        <p class="link-category">Vocabulary for IELTS</p>
                        <p class="link-lesson">Lesson 1</p>
                    </div>
                </div>
                <div class="col-1 text-end">
                    <img src="{{url('img/play.png')}}" alt="play" width="20px" class="mr-10">
                    <img src="{{url('img/bookmark.png')}}" alt="bookmark" width="20px">
                </div>
            </div>
        </div>
        <nav class="d-flex justify-content-center pb-3 mt-5">
            <ul class="pagination pagination-base pagination-boxed pagination-square mb-0">
                <li class="page-item">
                    <a class="page-link no-border" href="#">
                        <span aria-hidden="true">«</span>
                        <span class="sr-only">Previous</span>
                    </a>
                </li>
                <li class="page-item active"><a class="page-link no-border" href="#">1</a></li>
                <li class="page-item"><a class="page-link no-border" href="#">2</a></li>
                <li class="page-item"><a class="page-link no-border" href="#">3</a></li>
                <li class="page-item"><a class="page-link no-border" href="#">4</a></li>
                <li class="page-item">
                    <a class="page-link no-border" href="#">
                        <span aria-hidden="true">»</span>
                        <span class="sr-only">Next</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
@endsection
