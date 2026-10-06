<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Feedback;
use App\Models\User;
use App\Repositories\Contracts\FeedbackRepositoryInterface;
use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Support\Collection;

class FeedbackService
{
    public function __construct(private FeedbackRepositoryInterface $feedbackRepository)
    {
    }

    public function all(): Collection
    {
        return $this->feedbackRepository->all();
    }

    public function find(int|string $id): Feedback
    {
        return $this->feedbackRepository->find($id);
    }

    public function details(int|string $id): Feedback
    {
        return $this->feedbackRepository->findWithDetails($id);
    }

    public function create(array $data, int $userId): Feedback
    {
        return $this->feedbackRepository->create([
            'title' => $data['title'],
            'detailed_description' => $data['detailed_description'],
            'feedback_category_id' => $data['feedback_category_id'],
            'user_id' => $userId,
        ]);
    }

    public function update(int|string $id, array $data, User $actor): Feedback
    {
        $feedback = $this->feedbackRepository->find($id);

        if (! $actor->canEditFeedback($feedback)) {
            throw new AuthorizationException('You are not authorized to edit this feedback');
        }

        return $this->feedbackRepository->update($id, [
            'title' => $data['title'],
            'detailed_description' => $data['detailed_description'],
            'feedback_category_id' => $data['feedback_category_id'],
        ]);
    }

    public function delete(int|string $id, User $actor): bool
    {
        $feedback = $this->feedbackRepository->find($id);

        if (! $actor->canEditFeedback($feedback)) {
            throw new AuthorizationException('You are not authorized to delete this feedback');
        }

        return $this->feedbackRepository->delete($id);
    }

    public function addComment(int|string $feedbackId, array $data, int $userId): Comment
    {
        $mentionedUserIds = collect($data['users_data'] ?? [])
            ->pluck('id')
            ->filter()
            ->values()
            ->all();

        return $this->feedbackRepository->createComment($feedbackId, [
            'name' => $data['name'],
            'descripton' => $data['detailed_description'],
            'date' => $data['date'],
            'user_id' => $userId,
        ], $mentionedUserIds);
    }

    public function deleteComment(int|string $commentId, User $actor): bool
    {
        $comment = $this->feedbackRepository->findComment($commentId);

        if (! $actor->canDeleteComment($comment)) {
            throw new AuthorizationException('You are not authorized to delete this comment');
        }

        return $this->feedbackRepository->deleteComment($commentId);
    }

    public function searchUsers(?string $term = ''): Collection
    {
        return $this->feedbackRepository->searchUsers($term ?? '');
    }
}
