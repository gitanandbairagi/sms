<?php

namespace App\Http\Controllers;

use App\Models\FundRaisingCollection;
use App\Models\Transaction;
use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\Comment;
use Validator;

class FundRaisingController extends Controller
{
    public function index() {
        $work = Work::where(['status' => 1, 'type' => 'fund_raising'])->with('user:first_name,last_name,profile_pic,id')->first();
        $work_id = isset($work->id) ? $work->id : 0;
        $comments = Comment::where('work_id', $work_id)->with('user:first_name,last_name,profile_pic,id')->orderBy('id', 'DESC')->get();
        $frc = FundRaisingCollection::where('work_id', $work_id)->get();
        if (count($frc->toArray()) > 0) {
            $transaction = Transaction::where('order_id', $frc[0]->order_id)->first();
            $collection = money_format_india(collect($frc)->sum('amount')).' '.$transaction->order_currency;
        }
        else {
            $collection = 0;
        }
        $data = [
            'work' => $work,
            'comments' => $comments, 
            'comments_count' => $comments->count(), 
            'collection' => $collection, 
            'members_helped' => $frc->unique('user_id')->count(), 
        ];
        return view('sms.pages.fund_raising.index', compact('data'));
    }

    public function history(Request $request) {
        // if params are set then assigned param value else assigned empty string
        $keywords = isset($request->keywords) ? $request->keywords : '####';
        $from = isset($request->from) ? $request->from : today()->addMinutes(2280);
        $to = isset($request->to) ? $request->to : '2023-03-26';
        $data = [];
        // fetching results from db
        $data['works'] = Work::where(['type' => 'fund_raising', 'status' => 0])
                                ->where('title', 'LIKE', '%'.$keywords.'%')
                                ->orWhere('description', 'LIKE', '%'.$keywords.'%')
                                ->orWhere('created_at', '>=', $from)
                                ->orWhere('created_at', '<=', $to)
                                ->with('comments.user:first_name,last_name,profile_pic,id')
                                ->withCount('comments')
                                ->get();
        $result_count = $data['works']->count();
        // if $result_count is between 0 to 1 spell 'result' else spell 'results' in the string $result_count." result found";
        if ($result_count == 0 || $result_count == 1) {
            $data['message'] = $result_count." result found";
        }
        else {
            $data['message'] = $result_count." results found";
        }
        session()->flashInput($request->input());
        return view('sms.pages.fund_raising.history', compact('data'));
    }

    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'deadline' => 'required | date',
            'description' => 'required',
        ], [
            'title.required' => '* Title is Required',
            'deadline.required' => '* Deadline is Required',
            'deadline.date' => '* Dealine must contain Valid Date.',
            'description.required' => '* Description is Required',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }
        // Adding subject of fund raising to works Table
        $work = new Work;
        $work->user_id = session('id');
        $work->type = 'fund_raising';
        $work->title = $request->title;
        $work->description = $request->description;
        $work->deadline = $request->deadline;
        $work->created_at = now();
        $saved = $work->save();
        // Check if model got saved or not
        if (!$saved) {
            return response()->json(['message' => 'Something went wrong at server'], 500);
        }
        return response()->json(['message' => 'Subject of fund raising posted successfully. Please reload the page to see the post'], 200);
    }

    public function move(Request $request) {
        Work::where('id', $request->id)->update([
            'status' => 0,
        ]);
        session()->flash('success', 'Subject of fund raising moved successfully.');
        return redirect()->route('fund.raising');
    }

    public function comment(Request $request) {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
        ], [
            'description.required' => '* Description is Required',
        ]);

        // if validator fails, return with error and old input else proceed
        if ($validator->fails()) {
            return redirect()->route('fund.raising')->withErrors($validator->messages())->withInput();
        }

        $comment = new Comment;
        $comment->user_id = session('id');
        $comment->work_id = $request->work_id;
        $comment->description = $request->description;
        $comment->created_at = now();
        $saved = $comment->save();
        // Check if model got saved or not
        if (!$saved) {
            session()->flash('error', 'Something went wrong at server.');
            return redirect()->route('fund.raising');
        }
        session()->flash('success', 'Comment posted successfully.');
        return redirect()->route('fund.raising');
    }
}
