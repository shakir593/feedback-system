<?php

namespace App\Services;

class FeedbackCategoryService
{
    public function __construct(private FeedbackCategoryRepository $feedbackCategoryRepository)
    {
    }

    public function all()
    {
        return $this->feedbackCategoryRepository->all();
    }
}