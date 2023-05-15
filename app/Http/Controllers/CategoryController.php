<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryRequest;
use App\Models\Category;
use App\Models\Item;
use App\Models\Lesson;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    public function index()
    {
        $data = Category::where('del_flag', 0)->orderBy('id')->get();

        return view('category.index', ['data' => $data]);
    }

    public function delete($id)
    {
        $responseObj = ['success' => false, 'data' => []];

        if (empty($id)) {
            return response()->json($responseObj);
        }

        DB::beginTransaction();

        try {
            Category::where('id', $id)->update(['del_flag' => 1]);
            Lesson::where('category_id', $id)->update(['del_flag' => 1]);
            Item::where('category_id', $id)->update(['del_flag' => 1]);

            $responseObj['success'] = true;

            request()->session()->flash('success', config('messages.DELETE_SUCCESS'));

            DB::commit();

            return response()->json($responseObj);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            DB::rollBack();

            request()->session()->flash('error', config('messages.SYSTEM_ERROR'));
        }

        return response()->json($responseObj);
    }

    public function store(CategoryRequest $request)
    {
        // if validate successful => save data
        if (!empty($request->id)) {
            $category = Category::find($request->id);
            $category->name = $request->name;

            $category->save();
            request()->session()->flash('success', config('messages.UPDATE_SUCCESS'));
        } else {
            $category = Category::create([
                'name' => $request->name,
            ]);

            $category->save();
            request()->session()->flash('success', config('messages.CREATE_SUCCESS'));
        }


        return response()->json(['success' => true]);
    }

    public function show($id)
    {
        $responseObj = ['success' => false, 'data' => []];

        if (empty($id)) {
            return response()->json($responseObj);
        }

        try {
            $data = Category::where('id', $id)->where('del_flag', 0)->first()->toArray();

            $responseObj['success'] = true;
            $responseObj['data'] = $data;

            return response()->json($responseObj);

        } catch (\Exception $e) {
            Log::error($e->getMessage());
            $responseObj['message'] = $e->getMessage();

            request()->session()->flash('error', config('messages.SYSTEM_ERROR'));
        }

        return response()->json($responseObj);
    }
}
