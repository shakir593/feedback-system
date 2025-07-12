<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\FeedbackCategory;

class FeedbackCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $feedback_categories = array("bug report","feature request","improvement");

        foreach($feedback_categories as $feedback_category)
        {

            FeedbackCategory::create(["name"=>$feedback_category]);

        }
    }
}
