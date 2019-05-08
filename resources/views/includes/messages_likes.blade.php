@if (count($message->getFollowsLikes()) == 1)
    <p class="message-follow-like"><i data-feather="heart"></i>{{ $message->getFollowsLikes()->first()['pseudo'] }} liked this message.</p>
@elseif (count($message->getFollowsLikes()) == 2)
    <p class="message-follow-like"><i data-feather="heart"></i>{{ $message->getFollowsLikes()->first()['pseudo'] . " & " . $message->getFollowsLikes()->last()['pseudo'] }} liked this message.</p>
@elseif (count($message->getFollowsLikes()) > 2)
    <p class="message-follow-like"><i data-feather="heart"></i>{{ $message->getFollowsLikes()->first()['pseudo'] . ", " . $message->getFollowsLikes()->last()['pseudo'] . " & " . (count($message->getFollowsLikes()) - 2) }} more liked this message.</p>
@endif