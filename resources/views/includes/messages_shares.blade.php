@if (count($message->getFollowsShares()) == 1)
    <p class="message-follow-like"><i data-feather="repeat"></i>{{ $message->getFollowsShares()->first()['pseudo'] }} shared this message.</p>
@elseif (count($message->getFollowsShares()) == 2)
    <p class="message-follow-like"><i data-feather="repeat"></i>{{ $message->getFollowsShares()->first()['pseudo'] . " & " . $message->getFollowsShares()->last()['pseudo'] }} shared this message.</p>
@elseif (count($message->getFollowsShares()) > 2)
    <p class="message-follow-like"><i data-feather="repeat"></i>{{ $message->getFollowsShares()->first()['pseudo'] . ", " . $message->getFollowsShares()->last()['pseudo'] . " & " . (count($message->getFollowsShares()) - 2) }} more shared this message.</p>
@endif