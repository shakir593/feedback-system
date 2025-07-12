@extends('backend.layout.layout')
@php
    $title='Feedback Details';
    $subTitle = 'View Feedback Details';
    $script = '<script>
                    $(".remove-button").on("click", function() {
                        $(this).closest(".alert").addClass("d-none")
                    });
               </script>';
@endphp

@section('content')

<div class="row">
    <!-- Feedback Details Card -->
    <div class="col-lg-8">
        <div class="card basic-data-table">
            <div class="card-header d-flex align-items-center flex-wrap gap-3 justify-content-between">
                <h5 class="card-title mb-0">Feedback Details</h5>
                <div class="d-flex gap-2">
                    <a href="{{ route("feedback.add_comment", $feedback_details->id) }}" class="btn btn-success text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center gap-2">
                        <iconify-icon icon="iconamoon:comment" class="icon text-xl line-height-1"></iconify-icon>
                        Add Comment
                    </a>
                    @if(Auth::user()->canEditFeedback($feedback_details))
                        <a href="{{ route("feedback.edit", $feedback_details->id) }}" class="btn btn-primary text-sm btn-sm px-12 py-12 radius-8 d-flex align-items-center justify-content-center gap-2">
                            <iconify-icon icon="lucide:edit" class="icon text-xl line-height-1"></iconify-icon>
                            Edit Feedback
                        </a>
                    @endif
                </div>
            </div>
            <div class="card-body">
                @if(Session::has('success'))
                    <div class="alert alert-success bg-primary-50 text-success-600 border-success-50 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between my-2" role="alert">
                        {{ Session::get('success') }}
                        <button class="remove-button text-success-600 text-xxl line-height-1">
                            <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                        </button>
                    </div>
                @endif
                @if(Session::has('failed'))
                    <div class="alert alert-danger bg-danger-50 text-danger-600 border-danger-50 px-24 py-11 mb-0 fw-semibold text-lg radius-8 d-flex align-items-center justify-content-between my-2" role="alert">
                        {{ Session::get('failed') }}
                        <button class="remove-button text-danger-600 text-xxl line-height-1">
                            <iconify-icon icon="iconamoon:sign-times-light" class="icon"></iconify-icon>
                        </button>
                    </div>
                @endif

                <!-- Feedback Information -->
                <div class="feedback-info mb-4">
                    <div class="row">
                        <div class="col-md-8">
                            <h4 class="text-xl fw-bold text-dark mb-2">{{ $feedback_details->title }}</h4>
                            <div class="d-flex align-items-center gap-3 mb-3">
                                <span class="badge bg-primary px-12 py-6 radius-6 text-sm">
                                    {{ $feedback_details->feedback_category->name ?? 'No Category' }}
                                </span>
                                <span class="text-muted text-sm">
                                    <iconify-icon icon="lucide:calendar" class="icon"></iconify-icon>
                                    {{ $feedback_details->created_at->format('M d, Y') }}
                                </span>
                            </div>
                        </div>
                        <div class="col-md-4 text-end">
                            <div class="d-flex align-items-center justify-content-end gap-2">
                               
                                <div class="text-start">
                                    <p class="text-sm fw-medium mb-0">{{ $feedback_details->user->name ?? 'Unknown User' }}</p>
                                    <p class="text-xs text-muted mb-0">{{ $feedback_details->user->email ?? '' }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="feedback-description mt-4">
                        <h6 class="text-md fw-semibold mb-2">Detailed Description</h6>
                        <div class="bg-light p-16 radius-8">
                            <p class="text-sm text-dark mb-0">{{ $feedback_details->detailed_description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Comments Section -->
                <div class="comments-section">
                    <h5 class="text-lg fw-semibold mb-3">
                        Comments ({{ $feedback_details->comments->count() }})
                    </h5>
                    
                    @if($feedback_details->comments->count() > 0)
                        <div class="comments-list">
                            @foreach($feedback_details->comments as $comment)
                            <div class="comment-item border-bottom pb-3 mb-3">
                             
                                <div class="d-flex gap-3">
                                    <!-- <div class="avatar avatar-sm flex-shrink-0">
                                        <img src="{{ asset('backend/assets/images/avatar/avatar-1.png') }}" alt="User Avatar" class="rounded-circle">
                                    </div> -->
                                    <div class="flex-grow-1">
                                        <div class="d-flex align-items-center justify-content-between mb-2">
                                            <div class="d-flex align-items-center gap-2">
                                                <h6 class="text-sm fw-semibold mb-0">{{ $comment->name }}</h6>
                                                <span class="text-xs text-muted">{{ $comment->date }}</span>
                                                @if($comment->user)
                                                    <span class="text-xs text-primary">({{ $comment->user->name }})</span>
                                                @endif
                                            </div>
                                            @if(Auth::user()->canDeleteComment($comment))
                                                <a href="javascript:void(0)" class="w-24-px h-24-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center" onclick="event.preventDefault(); document.getElementById('delete-comment-{{ $comment->id }}').submit();">
                                                    <iconify-icon icon="mingcute:delete-2-line" class="icon text-sm"></iconify-icon>
                                                </a>
                                                <form id="delete-comment-{{ $comment->id }}" action="{{ route('feedback.delete_comment', [$feedback_details->id, $comment->id]) }}" method="POST" class="d-none">
                                                    @csrf
                                                </form>
                                            @endif
                                        </div>
                                        <div class="comment-content bg-light p-12 radius-6 mb-2">
                                        @if($comment->mentioned_users->count() > 0)
                                    <div class="mentioned-users mb-2">
                                        <div class="d-flex flex-wrap gap-1">
                                            @foreach($comment->mentioned_users as $mentioned)
                                                @if($mentioned->user)
                                                    <span class="badge bg-primary-light text-primary-600 px-8 py-4 radius-4 text-xs d-flex align-items-center gap-1">
                                                        <iconify-icon icon="lucide:user" class="icon text-xs"></iconify-icon>
                                                        {{ $mentioned->user->name }}
                                                    </span>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                @endif
                                            <p class="text-sm text-dark mb-0">{!! $comment->descripton !!}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <div class="empty-state">
                                <p class="text-muted mb-0">No comments yet. Be the first to add a comment!</p>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>

    <!-- Sidebar Information -->
    <div class="col-lg-4">
        <div class="card">
            <div class="card-header">
                <h6 class="card-title mb-0">Feedback Information</h6>
            </div>
            <div class="card-body">
                <div class="info-item d-flex justify-content-between align-items-center py-2 border-bottom">
                    <span class="text-sm text-muted">Status:</span>
                    <span class="badge bg-success px-8 py-4 radius-4 text-xs">Active</span>
                </div>
                <div class="info-item d-flex justify-content-between align-items-center py-2 border-bottom">
                    <span class="text-sm text-muted">Category:</span>
                    <span class="text-sm fw-medium">{{ $feedback_details->feedback_category->name ?? 'No Category' }}</span>
                </div>
                <div class="info-item d-flex justify-content-between align-items-center py-2 border-bottom">
                    <span class="text-sm text-muted">Created:</span>
                    <span class="text-sm">{{ $feedback_details->created_at->format('M d, Y') }}</span>
                </div>
                <div class="info-item d-flex justify-content-between align-items-center py-2 border-bottom">
                    <span class="text-sm text-muted">Updated:</span>
                    <span class="text-sm">{{ $feedback_details->updated_at->format('M d, Y') }}</span>
                </div>
                <div class="info-item d-flex justify-content-between align-items-center py-2 border-bottom">
                    <span class="text-sm text-muted">Comments:</span>
                    <span class="text-sm fw-medium">{{ $feedback_details->comments->count() }}</span>
                </div>
                @php
                    $totalMentions = $feedback_details->comments->sum(function($comment) {
                        // Only count mentions from active comments (not deleted)
                        return $comment->exists ? $comment->mentioned_users->count() : 0;
                    });
                @endphp
                <div class="info-item d-flex justify-content-between align-items-center py-2 border-bottom">
                    <span class="text-sm text-muted">Total Mentions:</span>
                    <span class="text-sm fw-medium">{{ $totalMentions }}</span>
                </div>
                <div class="info-item d-flex justify-content-between align-items-center py-2">
                    <span class="text-sm text-muted">Author:</span>
                    <span class="text-sm fw-medium">{{ $feedback_details->user->name ?? 'Unknown' }}</span>
                </div>
            </div>
        </div>

        <!-- Mentioned Users -->
        @php
            $allMentionedUsers = collect();
            foreach($feedback_details->comments as $comment) {
                // Only include mentioned users from active comments (not deleted)
                if($comment->exists) {
                    foreach($comment->mentioned_users as $mentioned) {
                        if($mentioned->user) {
                            $allMentionedUsers->push($mentioned->user);
                        }
                    }
                }
            }
            $uniqueMentionedUsers = $allMentionedUsers->unique('id');
        @endphp
        
       

        <!-- Quick Actions -->
        <div class="card mt-3">
            <div class="card-header">
                <h6 class="card-title mb-0">Quick Actions</h6>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('feedback.add_comment', $feedback_details->id) }}" class="btn btn-outline-success btn-sm">
                        <iconify-icon icon="iconamoon:comment" class="icon"></iconify-icon>
                        Add Comment
                    </a>
                    @if(Auth::user()->canEditFeedback($feedback_details))
                        <a href="{{ route('feedback.edit', $feedback_details->id) }}" class="btn btn-outline-primary btn-sm">
                            <iconify-icon icon="lucide:edit" class="icon"></iconify-icon>
                            Edit Feedback
                        </a>
                    @endif
                    <a href="{{ route('feedback.index') }}" class="btn btn-outline-secondary btn-sm">
                        <iconify-icon icon="lucide:arrow-left" class="icon"></iconify-icon>
                        Back to List
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection 