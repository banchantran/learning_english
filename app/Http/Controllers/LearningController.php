<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use App\Models\CompletedLesson;
use App\Models\Item;
use App\Models\Lesson;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        $wasCompleted = !empty(CompletedLesson::where('lesson_id', $lessonId)->first());

        $items = $this->randomActive($lesson->items->toArray());

        return view('learning.show', [
            'lesson' => $lesson,
            'items' => $items,
            'wasCompleted' => $wasCompleted,
            'bookmarkItemIds' => $bookmarkItemIds
        ]);
    }

    /**
     * @param $items
     * @param string $type random | text_source | text_destination
     * @return mixed
     */
    private function randomActive($items, $type = 'random')
    {
        $hiddenField = 'text_source';
        $showField = 'text_destination';

        if (count($items) > 1) {
            $activeItemIds = array_rand($items, floor(count($items) / 2));
            !is_array($activeItemIds) || count($items) == 1 ? $activeItemIds = [$activeItemIds] : null;
        } else {
            $activeItemIds = [0];
        }

        foreach ($items as $index => $item) {
            if (count($items) == 1) {
                $items[$index]['field_to_learn'] = [$hiddenField, $showField][array_rand([$hiddenField, $showField], 1)];

                break;
            }
            if ($type == 'random') {
                $items[$index]['field_to_learn'] = $hiddenField;

                if (!in_array($index, $activeItemIds)) continue;
            }

            $items[$index]['field_to_learn'] = $showField;
        }

        shuffle($items);

        return $items;
    }

    public function markCompleted($lessonId)
    {
        $responseObj = ['success' => false, 'data' => ['was_completed' => false]];

        if (empty($lessonId)) {
            return response()->json($responseObj);
        }

        try {
            $lesson = CompletedLesson::where('lesson_id', $lessonId)->first();

            if (empty($lesson)) {
                CompletedLesson::create([
                    'lesson_id' => $lessonId,
                ])->save();

                $responseObj['data']['was_completed'] = true;
            } else {
                CompletedLesson::where('lesson_id', $lessonId)->delete();
            }

            $responseObj['success'] = true;

            return response()->json($responseObj);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }

        request()->session()->flash('error', config('messages.SYSTEM_ERROR'));

        return response()->json($responseObj);
    }
}
