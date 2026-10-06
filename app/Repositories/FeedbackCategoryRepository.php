<?php
namespace App\Repositories;

class FeedbackCategoryRepository implements FeedbackCategoryRepositoryInterface
{
    public function all()
    {
        return FeedbackCategory::all();
    }
}