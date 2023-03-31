<ul class="nav nav-tabs mb-2" id="custom-content-above-tab" role="tablist">
    <li class="nav-item">
        <a @if (actual_link() == url('settings/my-profile'))
        class="nav-link active"
        @else
        class="nav-link"
        @endif id="custom-content-above-home-tab"
            href="{{ route('settings.my.profile') }}" role="button" aria-controls="custom-content-above-home"
            aria-selected="true">My Profile</a>
    </li>
    <li class="nav-item">
        <a @if (actual_link() == url('settings/credentials'))
        class="nav-link active"
        @else
        class="nav-link"
        @endif id="custom-content-above-history-tab"
        href="{{ route('settings.credentials') }}" role="button" aria-controls="custom-content-above-history"
        aria-selected="false">Credentials</a>
    </li>
    <li class="nav-item">
        <a @if (actual_link() == url('settings/society-profile'))
        class="nav-link active"
        @else
        class="nav-link"
        @endif id="custom-content-above-home-tab"
            href="{{ route('settings.society.profile') }}" role="button" aria-controls="custom-content-above-home"
            aria-selected="true">Society Profile</a>
    </li>
</ul>