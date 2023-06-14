<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Destination;

class DestinationController extends Controller
{
    private $page_limit = 6;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $query = \App\Destination::query();
            $keyword = $request->keyword;
            if (isset($keyword) && !empty($keyword)) {
                $query->where('name', 'LIKE', '%' . $keyword . '%');
            }
            $destinations = $query->where('status', '=', 1)->paginate($this->page_limit, ['*'], 'page', $request->page);
            $html = "";
            if (!empty($destinations)) {
                foreach ($destinations as $destination) {
                    $html .= view('front.elements.destination_card')->with(compact('destination'))->render();
                }
            }

            return response()->json([
                'data' => $html,
                'success' => true,
                'message' => 'List fetched'
            ]);
        } else {
            $destinations = \App\Destination::where('status', '=', 1)->paginate($this->page_limit);
            $activities = \App\Activity::where('status', '=', 1)->get();
            return view('front.destinations.index', compact('destinations', 'activities'));
        }
    }

    public function search(Request $request)
    {
        $keyword = $request->keyword;
        $activity_id = $request->act;
        $price_sort = $request->price;
        $query = \App\Destination::query();
        if (isset($keyword) && !empty($keyword)) {
            $query->where('name', 'LIKE', '%' . $keyword . '%');
        }

        // if (isset($activity_id) && !empty($activity_id)) {
        //     $query->where('activity_id', 'LIKE', '%' . $keyword . '%');
        // }

        // if (isset($price_sort) && !empty($price_sort)) {
        //     # code...
        // }

        $destinations = $query->where('status', '=', 1)->paginate($this->page_limit);
        $html = "";
        if (!empty($destinations)) {
            foreach ($destinations as $destination) {
                $html .= view('front.elements.destination_card')->with(compact('destination'))->render();
            }
        }

        return response()->json([
            'data' => $html,
            'pagination' => [
                'current_page' => $destinations->currentPage(),
                'total' => $destinations->total()
            ],
            'success' => true,
            'message' => 'List fetched'
        ]);
    }

	public function show($slug)
	{
        $destination = Destination::where('slug', '=', $slug)->first();
		$seo = $destination->seo;
		$destinations = \App\Destination::select('id', 'name')->get();
		$activities = \App\Activity::select('id', 'name')->get();
		return view('front.destinations.show', compact('destination', 'destinations', 'activities', 'seo'));
	}
}
