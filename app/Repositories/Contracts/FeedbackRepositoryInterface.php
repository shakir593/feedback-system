<?php

namespace App\Repositories\Contracts;

use App\Models\Comment;
use App\Models\Feedback;
use Illuminate\Support\Collection;

interface FeedbackRepositoryInterface
{
    public function all(): Collection;

    public function find(int|string $id): Feedback;

    public function findWithDetails(int|string $id): Feedback;

    public function create(array $data): Feedback;

    public function update(int|string $id, array $data): Feedback;

    public function delete(int|string $id): bool;

    public function createComment(int|string $feedbackId, array $data, array $mentionedUserIds = []): Comment;

    public function findComment(int|string $id): Comment;

    public function deleteComment(int|string $id): bool;

    public function searchUsers(?string $term = ''): Collection;
}
