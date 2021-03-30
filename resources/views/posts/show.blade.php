@extends('layouts.app')

@section('title')
    {{$post->title}}|投稿内容詳細
@endsection

@section('content')
    <div class="container mt-4">
        <div class="mb-4">
            <a class="btn btn-primary" href="{{ route('posts.index') }}">
                戻る
            </a>
        </div>
        <div class="border p-4">
            @if(Auth::check())
            @if(Auth::id() == $post->user_id)
            <div class="mb-4 text-right">
                <form
                    style="display: inline-block;"
                    method="POST"
                    action="{{ route('posts.destroy', [$post->id]) }}">
                    @csrf
                
                    <button class="btn btn-danger mr-2">削除する</button>
                </form>
                <a class="btn btn-primary" href="{{ route('posts.edit', [$post->id]) }}">
                    編集する
                </a>
            </div>
            @endif
            @endif
            <h1 class="h5 mb-4">
                {{ $post->title }}
            </h1>
            <div class="d-flex align-items-center">
                <time class="text-secondary mr-3">
                    {{ $post->created_at->format('Y-m-d H:i') }}
                </time>
                <div> {{ $post->name}}</div>
            </div>
            

            <p class="mb-5">
                {!! nl2br(e($post->body)) !!}
            </p>
            
            <section>
                
            <form class="mb-4" method="POST" action="{{ route('comments.store') }}">
                @csrf
            
                <input
                    name="post_id"
                    type="hidden"
                    value="{{ $post->id }}"
                >
                <input
                    name="user_id"
                    type="hidden"
                    value="{{ Auth::user()->id }}"
                >
            
                <div class="form-group">
                    <label for="comment">
                        コメント投稿
                    </label>
            
                    <textarea
                        id="comment"
                        name="comment"
                        class="form-control {{ $errors->has('comment') ? 'is-invalid' : '' }}"
                        rows="4"
                    >{{ old('comment') }}</textarea>
                    @if ($errors->has('comment'))
                        <div class="invalid-feedback">
                            {{ $errors->first('comment') }}
                        </div>
                    @endif
                </div>
            
                <div class="mt-4">
                    <button type="submit" class="btn btn-primary">
                        コメントする
                    </button>
                </div>
            </form>
                @forelse($comments as $comment)
                    <div class="border-top p-4">
                        <div class="d-flex align-items-center">
                            <time class="text-secondary mr-3">
                                {{ $comment->created_at->format('Y-m-d H:i') }}
                            </time>
                            <div> {{ $comment->name}}</div>
                        </div>
                        <p class="mt-2">
                            {!! nl2br(e($comment->comment)) !!}
                        </p>
                    </div>
                @empty
                    <p>コメントはまだありません。</p>
                @endforelse
            </section>
        </div>
    </div>
@endsection