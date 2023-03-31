<ul class="nav nav-tabs mb-2" id="custom-content-above-tab" role="tablist">
    <li class="nav-item">
        <a @if (actual_link() == url('suggested-works'))
        class="nav-link active"
        @else
        class="nav-link"
        @endif id="custom-content-above-home-tab"
            href="{{ route('suggested.works') }}" role="button" aria-controls="custom-content-above-home"
            aria-selected="true">Active</a>
    </li>
    <li class="nav-item">
        <a @if (substr(actual_link(), 0, 44) == url('suggested-works/history') || substr(actual_link(), 0, 45) == url('suggested-works/history'))
        class="nav-link active"
        @else
        class="nav-link"
        @endif id="custom-content-above-history-tab"
            href="{{ route('suggested.works.history') }}" role="button" aria-controls="custom-content-above-history"
            aria-selected="false">History</a>
    </li>
</ul>