<ul class="message-list">
        @if(isset($postForm) && $postForm)
            @include('includes.message_form')
        @endif
        @if (count($messages) < 1) 
            <li class="message">
                <main>
                    <p class="message-content">There is no messages.</p>
                </main>
            </li>
        @endif
        @foreach ($messages as $message)
            @include('includes.message')
        @endforeach
    </ul>
    