<div class="main-sidebar sidebar-style-2">
    @if(Auth::user()->role == 'admin')
        @include('components.menu.admin')
    @elseif(Auth::user()->role == 'dokter')
        @include('components.menu.dokter')
    @endif
</div>