<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Event;

class FullCalendarController extends Controller
{
    public function index(Request $request){
        if($request->ajax()){
            $data = Event::whereDate('start', '>=', $request->start)
                        ->whereDate('end', '<=', $request->end)
                        ->get(['id', 'title', 'start', 'end']);
            return response()->json($data);
        }
        return view('full-calendar');
    }
    
    public function action(Request $request){
        if($request->ajax()){
            if($request->type == 'add'){
                $event = Event::create([
                    'title' => $request->title,
                    'start' => $request->start,
                    'end' => $request->end
                ]);
                return response()->json($event);
            }
        }
    }
}
