<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class BookmarkController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function getList()
    {
        $responseObj = ['success' => false, 'data' => []];

        try {
            $itemIds = Bookmark::select(['id'])->get()->pluck('id');

            $responseObj['success'] = true;
            $responseObj['data'] = $itemIds;

            return response()->json($responseObj);

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            $responseObj['message'] = $e->getMessage();
        }

        request()->session()->flash('error', config('messages.SYSTEM_ERROR'));

        return response()->json($responseObj);
    }

    public function store($itemId)
    {
        $responseObj = ['success' => false, 'data' => []];

        try {
            $bookmark = Bookmark::where('item_id', $itemId)->first();

            if (empty($bookmark)) {
                Bookmark::create([
                    'item_id' => $itemId
                ])->save();

                $responseObj['data']['is_bookmark'] = true;
            } else {
                Bookmark::where('item_id', $itemId)->delete();

                $responseObj['data']['is_bookmark'] = false;
            }

            $responseObj['success'] = true;
            return response()->json($responseObj);

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            $responseObj['message'] = $e->getMessage();
        }

        request()->session()->flash('error', config('messages.SYSTEM_ERROR'));

        return response()->json($responseObj);
    }
}
