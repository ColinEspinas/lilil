
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
