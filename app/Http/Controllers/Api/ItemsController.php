<?php

namespace App\Http\Controllers\Api;

use App\Models\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ItemsController extends Controller
{
    public function changeAvaibility(Item $item)
    {

        $item->is_available = request('is_available');

        $item->save();

        return response(['status' => 'success', 'message' => 'Item Avaibility updated successfully!']);

    }
}
