<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    /**
     * @param $items
     * @param string $displayType random | text_source | text_destination
     * @param integer $maxItem
     * @return mixed
     */
    protected function randomActive($items, $displayType = 'random', $maxItem = 100)
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
            if ($displayType == 'random') {
                $items[$index]['field_to_learn'] = $hiddenField;

                if (!in_array($index, $activeItemIds)) continue;

                $items[$index]['field_to_learn'] = $showField;
            } else {
                $items[$index]['field_to_learn'] = $displayType;
            }
        }

        shuffle($items);

        $items = array_slice($items, 0, $maxItem);

        return $items;
    }

}
