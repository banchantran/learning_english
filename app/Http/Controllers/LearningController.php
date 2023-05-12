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

        $items = $this->randomActive($lesson->items->toArray());

        return view('learning.show', [
            'lesson' => $lesson,
            'items' => $items,
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

        $activeItemIds = array_rand($items, floor(count($items) / 2));

        foreach ($items as $index => $item) {
            if ($type == 'random') {
                $items[$index]['field_to_learn'] = $hiddenField;

                if (!in_array($index, $activeItemIds)) continue;
            }

            $items[$index]['field_to_learn'] = $showField;
        }

        shuffle($items);

        return $items;
    }
}
