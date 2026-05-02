@props([
    'paginator', 
    'currentPage', 
    'startingPage', 
    'endingPage', 
    'lastPage'
])

<div class="table-pagination">
    <div class="pagination-info">
        Showing {{ $paginator->firstItem() }} to {{ $paginator->lastItem() }} of {{ $paginator->total() }} results
    </div>

    <div class="pagination-elements">
        {{-- Prev Button --}}
        <x-button.outlined 
            class="outline-btn sm"
            :disabled="$paginator->onFirstPage()"
            wire:click="previousPage"
        >
            <i class="fi fi-br-angle-left"></i>
        </x-button.outline>

        <div class="total-pages">
            {{-- Always show First Page --}}
            <x-button.outlined 
                class="outline-btn sm {{ $currentPage == 1 ? 'active' : '' }}"
                wire:click="setPage(1)"
            >
                1
            </x-button.outline>

            {{-- Middle pages --}}
            @for ($i = $startingPage; $i <= $endingPage; $i++)
                <x-button.outlined 
                    class="outline-btn sm {{ $currentPage == $i ? 'active' : '' }}"
                    wire:click="setPage({{ $i }})"
                >
                    {{ $i }}
                </x-button.outline>
            @endfor

            {{-- Right Dots --}}
            @if ($endingPage < $lastPage - 1)
                <span>..</span>
            @endif

            {{-- Always show Last Page --}}
            @if ($lastPage > 1)
                <x-button.outlined 
                    class="outline-btn {{ $currentPage == $lastPage ? 'active' : '' }}"
                    wire:click="setPage({{ $lastPage }})"
                >
                    {{ $lastPage }}
                </x-button.outline>
            @endif
        </div>

        {{-- Next Button --}}
        <x-button.outlined 
            class="outline-btn sm"
            :disabled="!$paginator->hasMorePages()"
            wire:click="nextPage"
        >
            <i class="fi fi-br-angle-right"></i>
        </x-button.outline>
    </div>
</div>
