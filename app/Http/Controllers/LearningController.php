<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\Lesson;

class LearningController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function show($lessonId)
    {
        $lesson = Lesson::with(['items'])->where('id', $lessonId)->first();
        $bookmarkItemIds = Bookmark::select(['item_id'])->get()->pluck('item_id')->toArray();

        return view('learning.show', ['lesson' => $lesson, 'bookmarkItemIds' => $bookmarkItemIds]);
    }
}
