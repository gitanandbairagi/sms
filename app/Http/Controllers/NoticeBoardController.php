<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notice;
use Validator;

class NoticeBoardController extends Controller
{
    public function index() {
        $data = [
            'notice' => Notice::where(['status' => 1, 'society_id' => session('society_id')])->with('user:first_name,last_name,profile_pic,id')->first(),
        ];
        return view('sms.pages.notice_board.index', compact('data'));
    }

    public function history(Request $request) {
        // if params are set then assigned param value else assigned empty string
        $keywords = isset($request->keywords) ? $request->keywords : '789456';
        $from = isset($request->from) ? $request->from : today()->addMinutes(2280);
        $to = isset($request->to) ? $request->to : '2023-03-26';
        $data = [];
        // fetching results from db
        $data['notices'] = Notice::where(['status' => 0, 'society_id' => session('society_id')])
                                ->where('title', 'LIKE', '%'.$keywords.'%')
                                ->orWhere('description', 'LIKE', '%'.$keywords.'%')
                                ->orWhere('created_at', '>=', $from)
                                ->orWhere('created_at', '<=', $to)
                                ->with('user:first_name,last_name,profile_pic,id')
                                ->get();
        $result_count = $data['notices']->count();
        // if $result_count is between 0 to 1 spell 'result' else spell 'results' in the string $result_count." result found";
        if ($result_count == 0 || $result_count == 1) {
            $data['message'] = $result_count." result found";
        }
        else {
            $data['message'] = $result_count." results found";
        }
        session()->flashInput($request->input());
        return view('sms.pages.notice_board.history', compact('data'));
    }

    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
        ], [
            'title.required' => '* Title is Required',
            'description.required' => '* Description is Required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }
        // Adding Notice to notices table
        $notice = new Notice;
        $notice->user_id = session('id');
        $notice->society_id = session('society_id');
        $notice->title = $request->title;
        $notice->description = $request->description;
        $notice->created_at = now();
        $saved = $notice->save();
        // Check if model got saved or not
        if (!$saved) {
            return response()->json(['message' => 'Something went wrong at server'], 500);
        }
        return response()->json(['message' => 'Notice posted successfully.'], 200);
    }

    public function move(Request $request) {
        Notice::where('id', $request->id)->update([
            'status' => 0,
        ]);
        session()->flash('success', 'Notice moved successfully.');
        return redirect()->route('notice.board');
    }
}
