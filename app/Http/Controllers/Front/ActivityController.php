<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Activity;

class ActivityController extends Controller
{
    private $page_limit = 6;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = Activity::query();
            $keyword = $request->keyword;
            if (isset($keyword) && !empty($keyword)) {
                $query->where('name', 'LIKE', '%' . $keyword . '%');
            }
            $activities = $query->where('status', '=', 1)->paginate($this->page_limit, ['*'], 'page', $request->page);
            $html = "";
            if (!empty($activities)) {
                foreach ($activities as $activity) {
                    $html .= view('front.elements.activity-card')->with(compact('activity'))->render();
                }
            }

            return response()->json([
                'data' => $html,
                'success' => true,
                'message' => 'List fetched'
            ]);
        } else {
            $activities = \App\Activity::where('status', '=', 1)->paginate($this->page_limit);
            return view('front.activities.index', compact('activities'));
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $activity_id = $request->act;
        $price_sort = $request->price;
        $query = Activity::query();
        if (isset($keyword) && !empty($keyword)) {
            $query->where('name', 'LIKE', '%' . $keyword . '%');
        }

        $activities = $query->where('status', '=', 1)->paginate($this->page_limit);
        $html = "";
        if (!empty($activities)) {
            foreach ($activities as $activity) {
                $html .= view('front.elements.activity-card')->with(compact('activity'))->render();
            }
        }

        return response()->json([
            'data' => $html,
            'pagination' => [
                'current_page' => $activities->currentPage(),
                'total' => $activities->total()
            ],
            'success' => true,
            'message' => 'List fetched'
        ]);
    }

	public function show($slug)
	{
		$activity = Activity::where('slug', '=', $slug)->first();
		$seo = $activity->seo;
		$destinations = \App\Destination::select('id', 'name')->get();
		$activities = \App\Activity::select('id', 'name')->get();

		return view('front.activities.show', compact('activity', 'destinations', 'activities', 'seo'));
	}
}
