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
        <div class="row mb-20">
            <div class="col-4 d-flex align-items-center">
                <span class="direction">&laquo; Prevous lesson</span>
            </div>
            <div class="col-4 text-center">
                <h2 class="lesson-name">{{$lesson->name}}</h2>
            </div>
            <div class="col-4 text-end  d-flex align-items-center justify-content-end">
                <span class="direction">Next lesson &raquo;</span>
            </div>
        </div>
        <hr class="default">

        <div class="group-actions mb20">
            <div class="row">
                <div class="col-6">
                    <select class="form-select show-type d-inline-block" name="show_type" aria-label="Default select">
                        <option value="source">Show source</option>
                        <option value="destination">Show destination</option>
                        <option value="random">Random</option>
                    </select>
                    <button type="button" class="btn btn-outline-success" onclick="System.showSuggestion(this)">
                        <p class="d-flex align-items-center">
                            <img src="{{url('img/open-eye.png')}}" alt="reload" width="18px" class="mr-10 hidden open-eye">
                            <img src="{{url('img/close-eye.png')}}" alt="reload" width="18px" class="mr-10 close-eye">
                            <span>Show suggestions</span>
                        </p>
                    </button>

                    <button type="button" class="btn btn-outline-success btn-reload">
                        <p class="d-flex align-items-center">
                            <img src="{{url('img/reload.png')}}" alt="reload" width="15px" class="mr-10">
                            <span>Reload</span>
                        </p>
                    </button>
                </div>
                <div class="col-6">
                    <div class="float-end">
                        <button type="button" class="btn btn-outline-success" onclick="System.checkResult()">
                            <p class="d-flex align-items-center">
                                <img src="{{url('img/signal.png')}}" alt="reload" width="15px" class="mr-10">
                                <span>Check result</span>
                            </p>
                        </button>
                        <button type="button" class="btn btn-outline-success"
                                data-url="{{url(route('learning.mark_completed', ['lessonId' => $lesson->id]))}}"
                                onclick="System.markCompleted(this)">
                            <p class="d-flex align-items-center">
                                <img src="{{url('img/complete_icon.png')}}"
                                     alt="reload" width="15px"
                                     class="mark-complete mr-10 {{$wasCompleted ? '' : 'hidden'}}">
                                <span>Mark completed</span>
                            </p>
                        </button>
                    </div>
                </div>
                <div class="col-12">
                    <p class="text-result hidden mt-3">Correct: <span class="point-result">3/10</span> <span class="status-result">(Excellent)</span></p>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="border border-dark p-4 rounded-3">
            <div class="form-group form-lesson form-learning">
                @foreach($items as $item)
                    <input type="hidden" name="id" value="{{$item['id']}}">
                    <div class="row root-row">
                        <div class="col-11">
                            <div class="row">
                                <div class="col-6">
                                    @if ($item['field_to_learn'] == 'text_source')
                                        <input class="input-learning" type="text" placeholder="" name="source[]" value="">
                                        <p class="text-suggest">{{$item['text_source']}}</p>
                                    @else
                                        <p class="plain-text">{{$item['text_source']}}</p>
                                    @endif
                                </div>
                                <div class="col-6">
                                    @if ($item['field_to_learn'] == 'text_destination')
                                        <input class="input-learning" type="text" placeholder="" name="destination[]" value="">
                                        <p class="text-suggest">{{$item['text_destination']}}</p>
                                    @else
                                        <p class="plain-text">{{$item['text_destination']}}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-1 d-flex">
                            <div class="row">
                                <div class="play-audio hidden">
                                    <audio controls>
                                        <source src="{{!empty($item['audio_path']) ? url($item['audio_path']) : ''}}" type="audio/mpeg">
                                        Your browser does not support the audio element.
                                    </audio>
                                </div>
                                <div class="action col-6 d-flex align-items-center">
                                    <img class="play-icon {{!empty($item['audio_path']) ? '' : 'no-file'}} w-100"
                                         src="{{url('img/play.png')}}" alt="audio"
                                         onclick="System.playAudio(this)">
                                </div>
                                <div class="action col-6 d-flex align-items-center">
                                    <img class="bookmark-icon {{in_array($item['id'], $bookmarkItemIds) ? 'checked' : ''}} w-100"
                                         src="{{url('img/bookmark.png')}}" alt="bookmark"
                                         data-url="{{url(route('bookmark.store', ['itemId' => $item['id']]))}}"
                                         onclick="System.setBookmark(this)">
                                </div>
                                <p class="text-suggest">&nbsp;</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
