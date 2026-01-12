<?php

namespace App\Http\Controllers;

use App\Models\Food;
use App\Models\FoodCategory;
use App\Models\Language;
use App\Models\Order;
use App\Models\TodayMeal;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{

    public function index()
    {
        $languages = Language::all();
        return view('backend.dashboard.index', compact('languages'));
    }



    public function bulkStatus(Request $request)
    {
        $request->validate([
            'status' => 'required|in:cancelled,delivered',
            'order_ids' => 'required'
        ]);

        $ids = explode(',', $request->order_ids);

        Order::whereIn('id', $ids)
            ->where('vendor_id', auth()->id())
            ->update([
                'status' => $request->status
            ]);

        return back()->with('success', 'Orders updated successfully');
    }
}
