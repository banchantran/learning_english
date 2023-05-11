<?php

namespace App\Http\Controllers;

use App\Models\Bookmark;
use Illuminate\Support\Facades\Log;

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
        $responseObj = ['success' => false, 'data' => ''];

        try {
            $itemIds = Bookmark::select(['id'])->get()->pluck('id');

            $responseObj['success'] = true;
            $responseObj['data'] = $itemIds;

            return response()->json($responseObj);

        } catch (\Exception $e) {
            Log::error($e->getMessage());

            $responseObj['message'] = $e->getMessage();
        }

        return response()->json($responseObj);
    }
}
