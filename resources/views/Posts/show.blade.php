@extends('Layouts.app')

@section('title', 'Show')

@section('content')

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center mb-4">
            <div>
                <a href="{{ route('posts.index') }}" class="btn btn-secondary me-2">Back to Posts</a>
                <a href="{{ route('posts.edit', $posts->id) }}" class="btn btn-primary me-2">Edit</a>
            </div>
            <form action="{{ route('posts.destroy', $posts->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"
                        onclick="return confirm('Are you sure you want to delete this post?')">
                    Delete
                </button>
            </form>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card mb-4 shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Post Info</h5>
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">{{ $posts->title }}</h4>
                        <p class="card-text">{{ $posts->description }}</p>

                        {{-- Improved image handling --}}
                        @php
                            $imagePath = $posts->image ?? $posts->image_path ?? null;
                        @endphp

                        @if($imagePath)
                            <div class="mb-3">
                                <img
                                    src="{{ asset('storage/' . $imagePath) }}"
                                    alt="{{ $posts->title }} image"
                                    class="img-fluid rounded border"
                                    style="max-height: 400px; object-fit: cover; width: 100%;"
                                    onerror="this.style.display='none'; this.nextElementSibling.style.display='block';">
                                <div class="alert alert-warning" style="display: none;">
                                    <i class="fas fa-exclamation-triangle"></i> Image could not be loaded
                                </div>
                            </div>
                        @endif

                        <div class="row mt-3">
                            <div class="col-md-6">
                                <p class="text-muted mb-2">Views: {{ $posts->views }}</p>
                                <form action="{{ route('posts.toggleLike', $posts->id) }}" method="POST" class="mt-2">
                                    @csrf
                                    <button type="submit"
                                            class="btn btn-sm {{ $posts->isLikedBy(auth()->user()) ? 'btn-danger' : 'btn-outline-primary' }}">
                                        {{ $posts->isLikedBy(auth()->user()) ? 'Unlike' : 'Like' }}
                                    </button>
                                    <span class="ms-2">{{ $posts->likes()->count() }} Likes</span>
                                </form>
                            </div>
                            <div class="col-md-6">
                                <div class="border-start ps-3">
                                    <h6 class="text-muted mb-2">Created by:</h6>
                                    <p class="mb-1"><b>{{ $posts->user_creator->name ?? 'NOT FOUND' }}</b></p>
                                    <p class="mb-1 text-muted">{{ $posts->user_creator->email ?? 'NOT FOUND' }}</p>
                                    <p class="mb-0 text-muted small">{{ $posts->created_at->format('Y-m-d H:i') }}</p>
                                </div>
                            </div>
                        </div>

                        @if($posts->likes()->count())
                            <div class="mt-3 pt-3 border-top">
                                <span class="fw-bold">Liked by:</span>
                                @foreach($posts->likes as $like)
                                    <span
                                        class="badge bg-info text-dark me-1">{{ $like->user->name ?? 'Unknown' }}</span>
                                @endforeach
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="card shadow-sm mb-4">
            <div class="card-header bg-light">
                <h6 class="mb-0">Comments</h6>
            </div>
            <div class="card-body">
                @if($posts->comments->isEmpty())
                    <p class="text-muted">No comments yet.</p>
                @else
                    @foreach($posts->comments as $comment)
                        <div class="border rounded p-3 mb-3 bg-light">
                            <div class="d-flex justify-content-between align-items-center mb-1">
                                <strong>{{ $comment->user->name ?? 'Anonymous' }}</strong>
                                <small class="text-muted">{{ $comment->created_at->diffForHumans() }}</small>
                            </div>
                            <p class="mb-2">{{ $comment->content }}</p>
                            @if(auth()->id() === $comment->user_id)
                                <form action="{{ route('comments.destroy', $comment->id) }}" method="POST"
                                      class="d-inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-sm btn-outline-danger"
                                            onclick="return confirm('Are you sure you want to delete this comment?')">
                                        Delete
                                    </button>
                                </form>
                            @endif
                        </div>
                    @endforeach
                @endif

                <form action="{{ route('posts.comments.store', $posts->id) }}" method="POST" class="mt-3">
                    @csrf
                    <div class="mb-3">
                        <label for="content" class="form-label fw-bold">Add a Comment</label>
                        <textarea class="form-control" id="content" name="content" rows="3"
                                  placeholder="Write your comment..."></textarea>
                        <input type="hidden" name="post_id" value="{{ $posts->id }}">
                    </div>
                    <button type="submit" class="btn btn-primary">Submit Comment</button>
                </form>
            </div>
        </div>
    </div>
@endsection
