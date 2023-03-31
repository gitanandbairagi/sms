<ul class="nav nav-tabs mb-2" id="custom-content-above-tab" role="tablist">
    <li class="nav-item">
        <a @if (actual_link() == url('fund-raising'))
        class="nav-link active"
        @else
        class="nav-link"
        @endif id="custom-content-above-home-tab"
            href="{{ route('fund.raising') }}" role="button" aria-controls="custom-content-above-home"
            aria-selected="true">Active</a>
    </li>
    <li class="nav-item">
        <a @if (substr(actual_link(), 0, 41) == url('fund-raising/history') || substr(actual_link(), 0, 42) == url('fund-raising/history'))
        class="nav-link active"
        @else
        class="nav-link"
        @endif id="custom-content-above-history-tab"
            href="{{ route('fund.raising.history') }}" role="button" aria-controls="custom-content-above-history"
            aria-selected="false">History</a>
    </li>
</ul>