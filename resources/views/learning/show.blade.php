@extends('layout.default')
@section('breadcrumb')
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item"><a href="{{url(route('lesson.index', ['categoryId' => $lesson->category->id]))}}">{{$lesson->category->name}}</a></li>
            <li class="breadcrumb-item active" aria-current="page">{{$lesson->name}}</li>
        </ol>
    </nav>
@endsection
@section('content')
    <div class="ajax-form">
        <input type="hidden" name="id" value="">
        <div class="form-group">
            <label for="nameLesson">Lesson name</label>
            <input type="text" class="form-control mt05" name="name" id="nameLesson" aria-describedby="nameLesson" placeholder="...">
        </div>
        <hr>
        <div class="form-group form-lesson form-learning">
            @foreach($lesson->items as $item)
                <input type="hidden" name="id" value="{{$item->id}}">
                <div class="row root-row">
                    <div class="col-11">
                        <div class="row">
                            <div class="col-6">
                                <input type="text" placeholder="Text source" name="source[]" value="{{$item->text_source}}">
                            </div>
                            <div class="col-6">
                                <input type="text" placeholder="Text destination" name="destination[]" value="{{$item->text_destination}}">
                            </div>
                        </div>
                    </div>
                    <div class="col-1 d-flex">
                        <div class="row">
                            <div class="play-audio hidden">
                                <audio controls>
                                    <source src="{{!empty($item->audio_path) ? url($item->audio_path) : ''}}" type="audio/mpeg">
                                    Your browser does not support the audio element.
                                </audio>
                            </div>
                            <div class="action col-6 d-flex align-items-center">
                                <img class="bookmark-icon {{in_array($item->id, $bookmarkItemIds) ? 'checked' : ''}} w-100" src="{{url('img/bookmark.png')}}" alt="trash" onclick="System.playAudio(this)">
                            </div>
                            <div class="action col-6 d-flex align-items-center">
                                <img class="play-icon {{!empty($item->audio_path) ? '' : 'no-file'}} w-100" src="{{url('img/play.png')}}" alt="trash" onclick="System.playAudio(this)">
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
