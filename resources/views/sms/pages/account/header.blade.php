<ul class="nav nav-tabs mb-2" id="custom-content-above-tab" role="tablist">
    <li class="nav-item">
        <a @if (actual_link() == url('account'))
        class="nav-link active"
        @else
        class="nav-link"
        @endif id="custom-content-above-home-tab"
            href="{{ route('account') }}" role="button" aria-controls="custom-content-above-home"
            aria-selected="true">This Month</a>
    </li>
    <li class="nav-item">
        <a @if (strpos(actual_link(), 'account/history'))
        class="nav-link active"
        @else
        class="nav-link"
        @endif id="custom-content-above-history-tab"
            href="{{ route('account.history') }}" role="button" aria-controls="custom-content-above-history"
            aria-selected="false">History</a>
    </li>
</ul>