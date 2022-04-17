<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Item::orderBy('created_at', 'desc')->get();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newItem = new Item;
        $newItem->name = $request->item["name"];
        $newItem->save();

        return [
            'success' => true,
            'message' => 'Item created successfully',
            'item' => $newItem
        ];
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $existingItem = Item::find($id);

        if ($existingItem) {
            $existingItem->completed = $request->item["completed"] ? true : false;
            $existingItem->completed_at = $request->item["completed"] ? Carbon::now() : null;
            $existingItem->save();
            return [
                "success" => true,
                "message" => "Item updated successfully",
                "item" => $existingItem
            ];
        }

        return ["error" => "Item not found"];
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $existingItem = Item::find($id);

        if ($existingItem) {
            $existingItem->delete();
            return ["success" => "Item deleted"];
        }

        return ["error" => "Item not found"];
    }
}
