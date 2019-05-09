<li class="message">
    <header>
        <h4 class="message-author left"><a
                href="/users/{{ $activity->activity->author->name }}">{{ $activity->activity->author->pseudo }}</a></h4>
        <span class="message-date">{{ $activity->activity->getRelativeTime() }}</span>
        @if (Auth::user()->id == $activity->activity->author->id)
        <button class="message-options dropdown-btn right" onclick="toggleDropdown(this);" title="Message settings"><i
                data-feather="chevron-down" class="dropdown-icon"></i>
            <div class="nav-status"></div>
        </button>
        <ul class="dropdown-list" id="edit-dd" style="display:none">
            <li><a onclick="editMessage({{ $activity->activity->id }});"><i data-feather="edit"></i><span>Edit</span></a></li>
            <li><a onclick="deleteMessage({{ $activity->activity->id }});"><i data-feather="trash"></i><span>Delete</span></a></li>
        </ul>
        <form id="message-edit-form-{{ $activity->activity->id }}" class="message-edit-form width-100"
            action="/messages/{{ $activity->activity->id }}" method="POST">
            @csrf
            @method("PATCH")
            <div class="lil-row between">
                <textarea class="width-100" name="updated-content">{{ $activity->activity->content }}</textarea>
                <button class="btn lil-col xs-6-12 margin-tb-5" type="submit">Update</button>
                <button class="btn lil-col xs-6-12 margin-tb-5"
                    onclick="quitEditMessage({{ $activity->activity->id }});return false;">Cancel</button>
            </div>
        </form>
        <form id="message-delete-form-{{ $activity->activity->id }}" class="message-delete-form width-100"
            action="/messages/{{ $activity->activity->id }}" method="POST">
            @csrf
            @method("DELETE")
            <div class="lil-row between">
                <button class="btn lil-col xs-6-12 margin-tb-5" type="submit">I am sure.</button>
                <button class="btn lil-col xs-6-12 margin-tb-5"
                    onclick="quitDeleteMessage({{ $activity->activity->id }});return false;">Cancel</button>
            </div>
        </form>
        @endif
    </header>
    <main>
        <p class="message-content">{{ $activity->activity->content }}</p>
    </main>
    <footer>
        <ul class="message-nav">
            <li class="message-like {{ $activity->activity->hasUserLiked() ? 'active' : '' }}"
                onclick="socialBtnAnimation(this); ajax('/likes/{{ $activity->activity->id }}', 'PUT', '{{ csrf_token() }}');">
                <a><i data-feather="heart"></i><span>{{ count($activity->activity->likes) }}</span></a></li>
            <li class="message-share {{ $activity->activity->hasUserShared() ? 'active' : '' }}"
                onclick="socialBtnAnimation(this); ajax('/shares/{{$activity->activity->id}}','PUT','{{csrf_token()}}');"><a><i
                        data-feather="repeat"></i><span>{{ count($activity->activity->shares) }}</span></a></li>
        </ul>
        <div class="lil-clear"></div>
    </footer>
</li>