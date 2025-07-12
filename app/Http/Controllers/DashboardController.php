<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\{FeedbackCategory};

class DashboardController extends Controller
{
    
    public function index()
    {
        return view('backend.index');
    }

    public function feedback_categories()
    {

        $feedback_categories = FeedbackCategory::all();
        return view('backend.feedback-categories.index',compact('feedback_categories'));

    }
}
