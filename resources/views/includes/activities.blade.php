<ul class="message-list">
        @if(isset($postForm) && $postForm)
            @include('includes.message_form')
        @endif
        @if (count($activities) < 1) 
            <li class="message">
                <main>
                    <p class="message-content">There is no activity.</p>
                </main>
            </li>
        @endif
        @foreach ($activities as $activity)
            @if ($activity->activity_type == "App\Message")
                @include('includes.activities.post')
            @elseif ($activity->activity_type == "App\Like")
                @include('includes.activities.like')
            @elseif ($activity->activity_type == "App\Share")
                @include('includes.activities.share')
            @elseif($activity->activity_type == "App\Follow")
                @include('includes.activities.follow')
            @endif
        @endforeach
    </ul>
    