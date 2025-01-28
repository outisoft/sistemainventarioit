<div class="nav-item search-container">
    <div class="d-flex align-items-center position-relative w-100">
        <i class="bx bx-search fs-4 lh-0"></i>
        <input wire:model.live.debounce.300ms="search" type="text"
            class="form-control border-0 shadow-none ps-1 flex-grow-1" placeholder="Search..." aria-label="Search..."
            @focus="$wire.showResults = true" />

        <!-- Loading indicator -->
        <div wire:loading class="position-absolute top-50 end-0 translate-middle-y me-2">
            <div class="spinner-border spinner-border-sm text-primary" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    </div>

    <!-- Resultados de búsqueda -->
    @if ($showResults && collect($results)->flatten(1)->isNotEmpty())
        <div class="search-results position-absolute mt-2 bg-white rounded-3" @click.away="$wire.showResults = false">
            @foreach ($searchConfigs as $key => $config)
                @if (isset($results[$key]) && $results[$key]->isNotEmpty())
                    <div class="search-section">
                        <h6 class="search-section-title">
                            <i class="{{ $config['icon'] }} me-1"></i>{{ $config['title'] }}
                        </h6>
                        @foreach ($results[$key] as $result)
                            <a href="{{ $result['url'] }}" class="search-result-item d-block text-decoration-none">
                                <div class="search-result-title">
                                    {{ $result['title'] }}
                                </div>
                                <div class="search-result-subtitle">
                                    {{ $result['subtitle'] }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                @endif
            @endforeach
        </div>
    @elseif($showResults && $search !== '')
        <div class="search-results position-absolute mt-2 bg-white rounded-3">
            <div class="p-3">
                <p class="text-muted mb-0">No se encontraron resultados para "{{ $search }}"</p>
            </div>
        </div>
    @endif
</div>
