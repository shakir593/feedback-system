<?php

namespace App\Repositories;

use App\Models\Comment;
use App\Models\CommentUser;
use App\Models\Feedback;
use App\Models\User;
use App\Repositories\Contracts\FeedbackRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class FeedbackRepository implements FeedbackRepositoryInterface
{
    public function all(): Collection
    {
        return Feedback::with('feedback_category')->get();
    }

    public function find(int|string $id): Feedback
    {
        return Feedback::findOrFail($id);
    }

    public function findWithDetails(int|string $id): Feedback
    {
        return Feedback::with([
            'feedback_category',
            'user',
            'comments.user',
            'comments.mentioned_users.user',
        ])->findOrFail($id);
    }

    public function create(array $data): Feedback
    {
        $feedback = new Feedback;
        $feedback->title = $data['title'];
        $feedback->detailed_description = $data['detailed_description'];
        $feedback->feedback_category_id = $data['feedback_category_id'];
        $feedback->user_id = $data['user_id'];
        $feedback->save();

        return $feedback;
    }

    public function update(int|string $id, array $data): Feedback
    {
        $feedback = $this->find($id);
        $feedback->title = $data['title'];
        $feedback->detailed_description = $data['detailed_description'];
        $feedback->feedback_category_id = $data['feedback_category_id'];
        $feedback->save();

        return $feedback;
    }

    public function delete(int|string $id): bool
    {
        return (bool) $this->find($id)->delete();
    }

    public function createComment(int|string $feedbackId, array $data, array $mentionedUserIds = []): Comment
    {
        return DB::transaction(function () use ($feedbackId, $data, $mentionedUserIds) {
            $comment = new Comment;
            $comment->name = $data['name'];
            $comment->descripton = $data['descripton'];
            $comment->date = $data['date'];
            $comment->feedback_id = $feedbackId;
            $comment->user_id = $data['user_id'];
            $comment->save();

            foreach ($mentionedUserIds as $userId) {
                $mention = new CommentUser;
                $mention->comment_id = $comment->id;
                $mention->user_id = $userId;
                $mention->save();
            }

            return $comment;
        });
    }

    public function findComment(int|string $id): Comment
    {
        return Comment::findOrFail($id);
    }

    public function deleteComment(int|string $id): bool
    {
        return (bool) $this->findComment($id)->delete();
    }

    public function searchUsers(?string $term = ''): Collection
    {
        $term = $term ?? '';

        return User::query()
            ->where('name', 'LIKE', "%{$term}%")
            ->orWhere('email', 'LIKE', "%{$term}%")
            ->limit(10)
            ->get()
            ->map(function (User $user) {
                return [
                    'value' => $user->name,
                    'id' => $user->id,
                ];
            });
    }
}
