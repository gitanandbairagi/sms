@if (actual_link() == url('members') || actual_link() == url('members/history'))
<ul class="nav nav-tabs mb-2" id="custom-content-above-tab" role="tablist">
    <li class="nav-item">
        <a @if (actual_link() == url('members'))
        class="nav-link active"
        @else
        class="nav-link"
        @endif id="custom-content-above-home-tab"
            href="{{ route('members') }}" role="button" aria-controls="custom-content-above-home"
            aria-selected="true">Members</a>
    </li>
    <li class="nav-item">
        <a @if (actual_link() == url('members/history'))
        class="nav-link active"
        @else
        class="nav-link"
        @endif id="custom-content-above-history-tab"
            href="{{ route('members.history') }}" role="button" aria-controls="custom-content-above-history"
            aria-selected="false">History</a>
    </li>
</ul>
@endif