<div class="card-body">
    <article class="post">
        <p class="text">{{ $post->body }}</p>
        <p>Posted by
            <a href={{ $post->author_id }}>{{ $post->user->name }}</a>
            on
            <strong>{{ $post->created_at }}</strong>
        </p>

        <ul class="list-group">
            @foreach($post->comments() as $comment)
                <li class="list-group-item">
                    <p>{{$comment->body}}</p>
                    <p>Posted by
                        <a href="{{ $comment->author_id }}">{{ $comment->user->name }}</a>
                        on
                        <strong>{{ $comment->created_at }}</strong>
                    </p>
                </li>
            @endforeach
        </ul>

        <form method="POST" action="{{ route('createComment') }}">
            @csrf
            {{ Form::hidden('user_id', Auth::user()->id) }}
            {{ Form::hidden('parent_comment_id', $post->root_comment) }}
            <textarea class="form-control mt-2" name="answer_body" rows="2" placeholder="Comment"></textarea>
            <button class="btn mt-2 mr-2 float-right" type="submit">Submit</button>
        </form>
    </article>
</div>
