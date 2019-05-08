<ul class="message-list">
    @isset($postForm)
    <form action="/messages" method="POST" class="message-form">
        @csrf
        <textarea name="content" id="" class="width-100" placeholder="Write what's in your head!" rows="2"
            maxlength="140" required></textarea>
        <button type="submit" class="btn right margin-tb-5">Send<i data-feather="send"
                style="color:var(--light)"></i></button>
        @error('content')
        <span class="right error-message" role="alert">{{ $message }}</span>
        @enderror
        <small>140 characters max.</small>
        <div class="lil-clear"></div>
    </form>
    @endisset
    @if (count($messages) < 1) <li class="message">
        <main>
            <p class="message-content">There is no messages.</p>
        </main>
        </li>
        @endif
        @foreach ($messages as $message)
        <li class="message">
            <header>
                @if (count($message->getFollowsShares()) == 1)
                    <p class="message-follow-like"><i data-feather="repeat"></i>{{ $message->getFollowsShares()->first()['pseudo'] }} shared this message.</p>
                @elseif (count($message->getFollowsShares()) == 2)
                    <p class="message-follow-like"><i data-feather="repeat"></i>{{ $message->getFollowsShares()->first()['pseudo'] . " & " . $message->getFollowsShares()->last()['pseudo'] }} shared this message.</p>
                @elseif (count($message->getFollowsShares()) > 2)
                    <p class="message-follow-like"><i data-feather="repeat"></i>{{ $message->getFollowsShares()->first()['pseudo'] . ", " . $message->getFollowsShares()->last()['pseudo'] . " & " . (count($message->getFollowsShares()) - 2) }} more shared this message.</p>
                @endif
                @if (count($message->getFollowsLikes()) == 1)
                    <p class="message-follow-like"><i data-feather="heart"></i>{{ $message->getFollowsLikes()->first()['pseudo'] }} liked this message.</p>
                @elseif (count($message->getFollowsLikes()) == 2)
                    <p class="message-follow-like"><i data-feather="heart"></i>{{ $message->getFollowsLikes()->first()['pseudo'] . " & " . $message->getFollowsLikes()->last()['pseudo'] }} liked this message.</p>
                @elseif (count($message->getFollowsLikes()) > 2)
                    <p class="message-follow-like"><i data-feather="heart"></i>{{ $message->getFollowsLikes()->first()['pseudo'] . ", " . $message->getFollowsLikes()->last()['pseudo'] . " & " . (count($message->getFollowsLikes()) - 2) }} more liked this message.</p>
                @endif

                <h4 class="message-author left"><a
                        href="/users/{{ $message->author->name }}">{{ $message->author->pseudo }}</a></h4>
                <span class="message-date">{{ $message->getRelativeTime() }}</span>
                @if (Auth::user()->id == $message->author->id)
                <button class="message-options dropdown-btn right" onclick="toggleDropdown(this);" title="Message settings"><i
                        data-feather="chevron-down" class="dropdown-icon"></i>
                    <div class="nav-status"></div>
                </button>
                <ul class="dropdown-list" id="edit-dd" style="display:none">
                    <li><a onclick="editMessage({{ $message->id }});"><i data-feather="edit"></i><span>Edit</span></a></li>
                    <li><a onclick="deleteMessage({{ $message->id }});"><i data-feather="trash"></i><span>Delete</span></a></li>
                </ul>
                <form id="message-edit-form-{{ $message->id }}" class="message-edit-form width-100"
                    action="/messages/{{ $message->id }}" method="POST">
                    @csrf
                    @method("PATCH")
                    <div class="lil-row between">
                        <textarea class="width-100" name="updated-content">{{ $message->content }}</textarea>
                        <button class="btn lil-col xs-6-12 margin-tb-5" type="submit">Update</button>
                        <button class="btn lil-col xs-6-12 margin-tb-5"
                            onclick="quitEditMessage({{ $message->id }});return false;">Cancel</button>
                    </div>
                </form>
                <form id="message-delete-form-{{ $message->id }}" class="message-delete-form width-100"
                    action="/messages/{{ $message->id }}" method="POST">
                    @csrf
                    @method("DELETE")
                    <div class="lil-row between">
                        <button class="btn lil-col xs-6-12 margin-tb-5" type="submit">I am sure.</button>
                        <button class="btn lil-col xs-6-12 margin-tb-5"
                            onclick="quitDeleteMessage({{ $message->id }});return false;">Cancel</button>
                    </div>
                </form>
                @endif
            </header>
            <main>
                <p class="message-content">{{ $message->content }}</p>
            </main>
            <footer>
                <ul class="message-nav">
                    <li class="message-like {{ $message->hasUserLiked() ? 'active' : '' }}"
                        onclick="socialBtnAnimation(this); ajax('/likes/{{ $message->id }}', 'PUT', '{{ csrf_token() }}');">
                        <a><i data-feather="heart"></i><span>{{ count($message->likes) }}</span></a></li>
                    <li class="message-share {{ $message->hasUserShared() ? 'active' : '' }}"
                        onclick="socialBtnAnimation(this); ajax('/shares/{{$message->id}}','PUT','{{csrf_token()}}');"><a><i
                                data-feather="repeat"></i><span>{{ count($message->shares) }}</span></a></li>
                </ul>

                <div class="lil-clear"></div>
            </footer>
        </li>
        @endforeach
</ul>
