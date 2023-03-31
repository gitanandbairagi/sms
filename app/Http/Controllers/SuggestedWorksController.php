<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\Comment;
use App\Models\Upvote;
use Validator;
use Carbon\Carbon;

class SuggestedWorksController extends Controller
{
    public function index() {
        $work = Work::where(['status' => 1, 'type' => 'suggested_work'])->with('user:first_name,last_name,profile_pic,id')->first();
        $work_id = isset($work->id) ? $work->id : 0;
        $comments = Comment::where('work_id', $work_id)->with('user:first_name,last_name,profile_pic,id')->orderBy('id', 'DESC')->get();
        $upvotes = Upvote::where('work_id', $work_id)->get();
        $upvote_user = $upvotes->firstWhere('user_id', session('id'));
        // echo "<pre>";
        // echo print_r($upvote_user)."<br>";
        // die;
        $data = [
            'work' => $work,
            'comments' => $comments, 
            'comments_count' => $comments->count(),
            'upvotes_count' => $upvotes->count(),
            'upvote_user' => ($upvote_user != null) ? true : false,
        ];
        return view('sms.pages.suggested_works.index', compact('data'));
    }

    public function history(Request $request) {
        // if params are set then assigned param value else assigned empty string
        $keywords = isset($request->keywords) ? $request->keywords : '####';
        $from = isset($request->from) ? $request->from : today()->addMinutes(2280);
        $to = isset($request->to) ? $request->to : '2023-03-26';
        $data = [];
        // fetching results from db
        $data['works'] = Work::where(['type' => 'suggested_work', 'status' => 0])
                                ->where('title', 'LIKE', '%'.$keywords.'%')
                                ->orWhere('description', 'LIKE', '%'.$keywords.'%')
                                ->orWhere('created_at', '>=', $from)
                                ->orWhere('created_at', '<=', $to)
                                ->with('upvotes', 'comments.user:first_name,last_name,profile_pic,id')
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
        return view('sms.pages.suggested_works.history', compact('data'));
    }

    public function add(Request $request) {
        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'deadline' => 'required | date',
            'description' => 'required',
        ], [
            'title.required' => '* Title is Required',
            'deadline.required' => '* Deadline is Required',
            'deadline.date' => '* Dealine must contain Valid Date',
            'description.required' => '* Description is Required',
        ]);

        if (!now()->addDays(7)->gt($request->deadline)) {
            $validator->errors()->add('deadline', '* Maximum of 7 Days are Allowed in Deadline');
            return response()->json($validator->messages(), 400);
        } 
        else if ($validator->fails()) {
            return response()->json($validator->messages(), 400);
        }

        // Adding subject of suggested work to works table
        $work = new Work;
        $work->user_id = session('id');
        $work->type = 'suggested_work';
        $work->title = $request->title;
        $work->description = $request->description;
        $work->deadline = $request->deadline;
        $work->created_at = now();
        $saved = $work->save();
        // Check if model got saved or not
        if (!$saved) {
            return response()->json(['message' => 'Something went wrong at server'], 500);
        }
        return response()->json(['message' => 'Subject of suggested work posted successfully. Please reload the page to see the post.'], 200);
    }

    public function upvote(Request $request) {
        $work_id = $request->workId;
        $upvote = Upvote::where(['user_id' => session('id'), 'work_id' => $work_id]);
        if ($upvote->exists()) {
            // Remove vote from upvotes table
            $upvote->delete();
            return response()->json([
                'message' => 'Upvote removed',
                'bool' => 0
            ], 200);
        }
        // Store vote from upvotes table
        $upvote = new Upvote;
        $upvote->work_id = $work_id;
        $upvote->user_id = session('id');
        $upvote->save();
        return response()->json([
            'message' => 'Upvoted successfully',
            'bool' => 1
        ], 200);
    }

    public function comment(Request $request) {
        $validator = Validator::make($request->all(), [
            'description' => 'required',
        ], [
            'description.required' => '* Description is Required',
        ]);

        // if validator fails, return with error and old input else proceed
        if ($validator->fails()) {
            return redirect()->route('suggested.works')->withErrors($validator->messages())->withInput();
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
            return redirect()->route('suggested.works');
        }
        session()->flash('success', 'Comment posted successfully.');
        return redirect()->route('suggested.works');
    }
}
