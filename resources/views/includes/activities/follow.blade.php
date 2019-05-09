<li class="message">
    <main>
        <p class="message-follow-activity"><i data-feather="users"></i>
            <a href="users/{{ $activity->activity->user->name }}">{{ $activity->activity->user->pseudo }}</a> 
            is now following 
            @if (Auth::User()->id == $activity->activity->followed->id)
                you.
            @else
                <a href="users/{{ $activity->activity->followed->name }}">{{ $activity->activity->followed->pseudo }}</a>
            @endif
        </p>
    </main>
</li>