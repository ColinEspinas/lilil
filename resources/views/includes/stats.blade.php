<ul class="stat-list">
    <li class="stat-pseudo line-ellipsis"><i data-feather="user"></i>{{ Auth::user()->pseudo }} ({{ "@" }}{{ Auth::user()->name }})</li>
    <hr>
    <li class="stat-followers"><i data-feather="users"></i>789 followers</li>
    <li class="stat-follows"><i data-feather="user-check"></i>106 follows</li>
    <li class="stat-likes"><i data-feather="heart"></i>{{ Auth::user()->getMessageLikesCount() }} likes & {{ count(Auth::user()->getLikedMessages()) }} liked</li>
</ul>