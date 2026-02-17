<ul class="nav nav-pills mb-2">

    {{-- Basic (Create + Edit) --}}
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.quotes.create') || request()->routeIs('admin.quotes.edit') ? 'active' : '' }}"
           href="{{ isset($quote) ? route('admin.quotes.edit', $quote->id) : route('admin.quotes.create') }}">
            <i class="bi bi-person font-medium-3 me-50"></i>
            <span class="fw-bold">Basic</span>
        </a>
    </li>

    {{-- Flights --}}
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.quotes.flights') ? 'active' : '' }}"
           href="{{ isset($quote) ? route('admin.quotes.flights', $quote->id) : '#' }}">
            <i class="bi bi-airplane-engines font-medium-3 me-50"></i>
            <span class="fw-bold">Flight Detail</span>
        </a>
    </li>

    {{-- Hotels --}}
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.quotes.hotels') ? 'active' : '' }}"
           href="{{ isset($quote) ? route('admin.quotes.hotels', $quote->id) : '#' }}">
            <i class="bi bi-building font-medium-3 me-50"></i>
            <span class="fw-bold">Hotel Detail</span>
        </a>
    </li>

    {{-- Transports --}}
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.quotes.transports') ? 'active' : '' }}"
           href="{{ isset($quote) ? route('admin.quotes.transports', $quote->id) : '#' }}">
            <i class="bi bi-truck font-medium-3 me-50"></i>
            <span class="fw-bold">Transport Detail</span>
        </a>
    </li>

    {{-- Others --}}
    <li class="nav-item">
        <a class="nav-link {{ request()->routeIs('admin.quotes.others') ? 'active' : '' }}"
           href="{{ isset($quote) ? route('admin.quotes.others', $quote->id) : '#' }}">
            <i class="bi bi-file-text font-medium-3 me-50"></i>
            <span class="fw-bold">Other Detail</span>
        </a>
    </li>

</ul>
