@if (session('role') == 'admin')
<ul class="nav nav-tabs mb-2" id="custom-content-above-tab" role="tablist">
    <li class="nav-item">
        <a @if (actual_link() == url('notice-board'))
        class="nav-link active"
        @else
        class="nav-link"
        @endif id="custom-content-above-home-tab"
            href="{{ route('notice.board') }}" role="button" aria-controls="custom-content-above-home"
            aria-selected="true">Active</a>
    </li>
    <li class="nav-item">
        <a @if (substr(actual_link(), 0, 41) == url('notice-board/history') || substr(actual_link(), 0, 42) == url('notice-board/history'))
        class="nav-link active"
        @else
        class="nav-link"
        @endif id="custom-content-above-history-tab"
            href="{{ route('notice.board.history') }}" role="button" aria-controls="custom-content-above-history"
            aria-selected="false">History</a>
    </li>
</ul>
@endif