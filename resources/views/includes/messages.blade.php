<ul class="message-list">
        <meta name="csrf-token" content="">
    <form action="/messages" method="POST" class="message-form">
        @csrf
        <textarea name="content" id="" class="width-100" placeholder="Write what's in your head!" rows="2" maxlength="140"></textarea>
        <button type="submit" class="btn right margin-tb-5">Send<i data-feather="send" style="color:var(--light)"></i></button>
        <small>140 characters max.</small>
        <div class="lil-clear"></div>
    </form>
    @foreach ($messages as $message)
        <li class="message">
            <header>
            <h4 class="message-author"><a href="/user/{{ $message->author->name }}">{{ $message->author->pseudo }}</a></h4>
                <span class="message-date">{{ $message->relative_time }}</span>
            </header>
            <main>
            <p class="message-content">{{ $message->content }}</p>
            </main>
            <footer>
                <ul class="message-nav">
                <li class="message-like {{ $message->hasUserLiked() ? 'active' : '' }}" onclick="socialBtnAnimation(this); likeDislike({{ $message->id }}, '{{ csrf_token() }}');">
                    <a><i data-feather="heart"></i>10</a></li>
                    <li class="message-share" onclick="socialBtnAnimation(this);"><a><i data-feather="repeat"></i>53</a></li>
                </ul>
                
                <div class="lil-clear"></div>
            </footer>
        </li>
    @endforeach
</ul>
