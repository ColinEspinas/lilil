<ul class="stat-list">
    <li class="stat-pseudo line-ellipsis"><i data-feather="user"></i>{{ Auth::user()->pseudo }} ({{ "@" }}{{ Auth::user()->name }})</li>
    <hr>
    <li class="stat-followers"><i data-feather="users"></i>{{ count(Auth::user()->followers) }} followers</li>
    <li class="stat-follows"><i data-feather="user-check"></i>{{ count(Auth::user()->follows) }} follows</li>
    <li class="stat-likes"><i data-feather="heart"></i>{{ Auth::user()->getMessageLikesCount() }} likes & {{ count(Auth::user()->getLikedMessages()) }} liked</li>
    <li class="stat-shares"><i data-feather="repeat"></i>{{ Auth::user()->getMessageSharesCount() }} shares & {{ count(Auth::user()->getSharedMessages()) }} shared</li>
</ul>