<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{ Feedback, FeedbackCategory, User, Comment, CommentUser };
use App\Http\Requests\{ FeedbackRequest, CommentRequest };
use Illuminate\Support\Facades\Log;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class FeedbackController extends Controller
{
   
    
    public function index()
    {
         $feedbacks = Feedback::with('feedback_category')->get();
         return view('backend.feedbacks.index',compact('feedbacks'));
    }

    public function create()
    {
        $feedback_categories = FeedbackCategory::all();
        return view('backend.feedbacks.create',compact('feedback_categories'));
    }

  
    public function store(FeedbackRequest $request)
    {
         try 
        {
            $validated = $request->validated();
            $create_feedback =  new Feedback;
            $create_feedback->title = $request->title;
            $create_feedback->detailed_description = $request->detailed_description;
            $create_feedback->feedback_category_id = $request->feedback_category_id;
            $create_feedback->user_id = Auth::id();
            if($create_feedback->save())
            {
                return redirect()->route('feedback.index')->with('success', 'Feedback Saved Successfully');
            }

        }catch(Exception $e)

        {
             Log::error("Something went wrong at FeedbackController@store: ". $e->getMessage( ));
            return redirect()->route('feedback.create')->with('failed', 'Something went wrong');

        }
    }

  
    public function show(string $id)
    {
        $feedback_details = Feedback::with([
            'feedback_category', 
            'user', 
            'comments.user', 
            'comments.mentioned_users.user'
        ])->findOrFail($id);
        return view('backend.feedbacks.show', compact('feedback_details'));
    }

   
    public function edit($id)
    {
        $feedback_categories = FeedbackCategory::all();
        $feedback_details = Feedback::find($id);
        return view('backend.feedbacks.edit',compact('feedback_details','feedback_categories'));
    }

 
    public function update(FeedbackRequest $request,$id)
    {
           try 
        {
            $update_feedback = Feedback::findOrFail($id);
            
            if (!Auth::user()->canEditFeedback($update_feedback)) {
                return redirect()->route('feedback.index')->with('failed', 'You are not authorized to edit this feedback');
            }

            $validated = $request->validated();
            $update_feedback->title = $request->title;
            $update_feedback->detailed_description = $request->detailed_description;
            $update_feedback->feedback_category_id = $request->feedback_category_id;

            if($update_feedback->save())
            {
                return redirect()->route('feedback.index')->with('success', 'Feedback Updated Successfully');
            }

        }
        catch(Exception $e)
        {
            Log::error("Something went wrong at FeedbackController@update: ". $e->getMessage( ));
            return redirect()->route('feedback.edit',$id)->with('failed', 'Something went wrong');
        }
    }

    public function destroy($id)
    {
        try 
        {
            $delete_feedback = Feedback::findOrFail($id);
            
            if (!Auth::user()->canEditFeedback($delete_feedback)) {
                return redirect()->route('feedback.index')->with('failed', 'You are not authorized to delete this feedback');
            }

            if($delete_feedback->delete())
            {
                return redirect()->route('feedback.index')->with('success', 'Feedback Deleted Successfully');
            }
        }catch(Exception $e)
        {
             Log::error("Something went wrong at FeedbackController@destroy: ". $e->getMessage( ));
            return redirect()->route('feedback.index')->with('failed', 'Something went wrong');
        }
    }

    public function add_feedback_comment($id)
    {
        $feedback_details=  Feedback::find($id);
        return view('backend.feedbacks.create_comment',compact('feedback_details'));

    }

    public function save_comment(CommentRequest $request, $id)
    {
        try
        {

            $request->validated();
            $create_comment =  new Comment;
            $create_comment->name = $request->name;
            $create_comment->descripton = $request->detailed_description;
            $create_comment->date = $request->date;
            $create_comment->feedback_id = $id;
            $create_comment->user_id = Auth::id();
            
            if($create_comment->save())
            {
                $userIds = $request->input('users_data', []);
                foreach($userIds as $index => $userId)
                {
                  
                    $add_mention_user = new CommentUser;
                    $add_mention_user->comment_id = $create_comment->id;
                    $add_mention_user->user_id = $userId['id'];
                    $add_mention_user->save();
                }
                return redirect()->route('feedback.index')->with('success', 'Comment Added Successfully');
            }
        }catch(Exception $e)
        {
             Log::error("Something went wrong at FeedbackController@save_comment: ". $e->getMessage( ));
            return redirect()->route('feedback.add_comment', $id)->with('failed', 'Something went wrong');

        }
    }


    public function fetch_user(Request $request)
    {
        $q = $request->get('q', '');
        $users = User::where('name', 'LIKE', "%{$q}%")
                    ->orWhere('email', 'LIKE', "%{$q}%")
                    ->limit(10)
                    ->get()
                    ->map(function($user) {
                        return [
                            'value' => $user->name,
                            'id' => $user->id,
                        ];
                    });

        return response()->json($users);
    }

    public function delete_comment($feedback_id, $comment_id)
    {
        try 
        {
            $comment = Comment::findOrFail($comment_id);
            
            if (!Auth::user()->canDeleteComment($comment)) {
                return redirect()->back()->with('failed', 'You are not authorized to delete this comment');
            }

            if($comment->delete())
            {
                return redirect()->route('feedback.show', $feedback_id)->with('success', 'Comment Deleted Successfully');
            }
        }catch(Exception $e)
        {
             Log::error("Something went wrong at FeedbackController@delete_comment: ". $e->getMessage( ));
            return redirect()->back()->with('failed', 'Something went wrong');
        }
    }
}
