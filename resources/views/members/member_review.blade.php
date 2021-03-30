<div class="card mt-5">
    <div class="card-header">レビュー</div>
    <div class="col">
    <form class="mb-4" method="POST" action="{{ route('profile.review', [$user->id]) }}">
        @csrf
    
        <input
            name="user_id"
            type="hidden"
            value="{{ $user->id }}"
        >
    
        <div class="form-group">
            <label for="review" class="mt-2">
                このメンバーに対して評価を投稿してください。
            </label>
    
            <textarea
                id="review"
                name="review"
                class="form-control {{ $errors->has('review') ? 'is-invalid' : '' }}"
                rows="2"
            >{{ old('review') }}</textarea>
            @if ($errors->has('review'))
                <div class="invalid-feedback">
                    {{ $errors->first('review') }}
                </div>
            @endif
        </div>
    
        <div class="mt-4">
            <button type="submit" class="btn btn-primary">
                投稿する
            </button>
        </div>
    </form>
        @if(isset($reviews))
            @foreach($reviews as $review)
                <div class="border-top py-3 px-2">
                    <div class="d-flex">
                    <time class="text-secondary">
                        {{ $review->created_at->format('Y.m.d') }}
                    </time>
                    <p class="ml-2">
                        {!! nl2br(e($review->name)) !!}
                    </p>
                    </div>
                    <p class="mt-2">
                        {!! nl2br(e($review->review)) !!}
                    </p>
                </div>
            @endforeach
        @else
            <p>レビューはまだありません。</p>
        @endif
        </div>
</div>
