<ul class="message-list">
    @isset($postForm)
    <form action="/messages" method="POST" class="message-form">
        @csrf
        <textarea name="content" id="" class="width-100" placeholder="Write what's in your head!" rows="2"
            maxlength="140"></textarea>
        <button type="submit" class="btn right margin-tb-5">Send<i data-feather="send"
                style="color:var(--light)"></i></button>
        @error('content')
        <span class="right error-message" role="alert">{{ $message }}</span>
        @enderror
        <small>140 characters max.</small>
        <div class="lil-clear"></div>
    </form>
    @endisset
    @if (count(Auth::user()->follows) < 1) <li class="message">
        <main>
            <p class="message-content">There is no follows.</p>
        </main>
        </li>
    @endif
    @foreach (Auth::user()->follows as $follow)
        <li class="follow">
            <a href="/users/{{ $follow->followed->name }}">
                <p class="follow-pseudo">{{ $follow->followed->pseudo }}</p>
            </a>
            <form action="/follows/{{ $follow->followed->id }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn follow-unfollow"><i data-feather="user-minus"></i>Unfollow</button>
            </form>
            <div class="lil-clear"></div>
        </li>
    @endforeach
</ul>
