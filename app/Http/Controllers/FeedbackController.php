<?php

namespace App\Http\Controllers;

use App\Http\Requests\CommentRequest;
use App\Http\Requests\FeedbackRequest;
use App\Models\FeedbackCategory;
use App\Services\FeedbackService;
use Exception;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class FeedbackController extends Controller
{
    public function __construct(private FeedbackService $feedbackService)
    {
    }

    public function index()
    {
        $feedbacks = $this->feedbackService->all();

        return view('backend.feedbacks.index', compact('feedbacks'));
    }

    public function create()
    {
        $feedback_categories = FeedbackCategory::all();

        return view('backend.feedbacks.create', compact('feedback_categories'));
    }

    public function store(FeedbackRequest $request)
    {
        try {
            $this->feedbackService->create($request->validated(), Auth::id());

            return redirect()->route('feedback.index')->with('success', 'Feedback Saved Successfully');
        } catch (Exception $e) {
            Log::error('Something went wrong at FeedbackController@store: '.$e->getMessage());

            return redirect()->route('feedback.create')->with('failed', 'Something went wrong');
        }
    }

    public function show(string $id)
    {
        $feedback_details = $this->feedbackService->details($id);

        return view('backend.feedbacks.show', compact('feedback_details'));
    }

    public function edit($id)
    {
        $feedback_categories = FeedbackCategory::all();
        $feedback_details = $this->feedbackService->find($id);

        return view('backend.feedbacks.edit', compact('feedback_details', 'feedback_categories'));
    }

    public function update(FeedbackRequest $request, $id)
    {
        try {
            $this->feedbackService->update($id, $request->validated(), Auth::user());

            return redirect()->route('feedback.index')->with('success', 'Feedback Updated Successfully');
        } catch (AuthorizationException $e) {
            return redirect()->route('feedback.index')->with('failed', $e->getMessage());
        } catch (Exception $e) {
            Log::error('Something went wrong at FeedbackController@update: '.$e->getMessage());

            return redirect()->route('feedback.edit', $id)->with('failed', 'Something went wrong');
        }
    }

    public function destroy($id)
    {
        try {
            $this->feedbackService->delete($id, Auth::user());

            return redirect()->route('feedback.index')->with('success', 'Feedback Deleted Successfully');
        } catch (AuthorizationException $e) {
            return redirect()->route('feedback.index')->with('failed', $e->getMessage());
        } catch (Exception $e) {
            Log::error('Something went wrong at FeedbackController@destroy: '.$e->getMessage());

            return redirect()->route('feedback.index')->with('failed', 'Something went wrong');
        }
    }

    public function add_feedback_comment($id)
    {
        $feedback_details = $this->feedbackService->find($id);

        return view('backend.feedbacks.create_comment', compact('feedback_details'));
    }

    public function save_comment(CommentRequest $request, $id)
    {
        try {
            $this->feedbackService->addComment($id, $request->validated() + [
                'users_data' => $request->input('users_data', []),
            ], Auth::id());

            return redirect()->route('feedback.index')->with('success', 'Comment Added Successfully');
        } catch (Exception $e) {
            Log::error('Something went wrong at FeedbackController@save_comment: '.$e->getMessage());

            return redirect()->route('feedback.add_comment', $id)->with('failed', 'Something went wrong');
        }
    }

    public function fetch_user(Request $request)
    {
        $users = $this->feedbackService->searchUsers($request->get('q', ''));

        return response()->json($users);
    }

    public function delete_comment($feedback_id, $comment_id)
    {
        try {
            $this->feedbackService->deleteComment($comment_id, Auth::user());

            return redirect()->route('feedback.show', $feedback_id)->with('success', 'Comment Deleted Successfully');
        } catch (AuthorizationException $e) {
            return redirect()->back()->with('failed', $e->getMessage());
        } catch (Exception $e) {
            Log::error('Something went wrong at FeedbackController@delete_comment: '.$e->getMessage());

            return redirect()->back()->with('failed', 'Something went wrong');
        }
    }
}
