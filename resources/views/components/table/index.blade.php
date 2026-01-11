@props([
    'headers' => [],
    'rows' => [],
    'view',
    'rowName' => 'row',
    'emptyView' => 'components.table.empty',
])

{{-- Table Header --}}
<div class="table-header">
    @if ($header)
        {{ $header }}
    @endif
</div>

{{-- Scrollable Table --}}
<div class="table-scroll">
    <table class="table">
        <thead>
            <tr>
                @foreach ($headers as $head)
                    <th class="table-sortable">{{ $head }}</th>
                @endforeach
            </tr>
        </thead>

        <tbody>
            @forelse ($rows as $index => $row)
                @include($view, [
                    'index' => $index + 1,
                    $rowName => $row,
                ])
            @empty
                @includeIf($emptyView, ['colspan' => count($headers)])
            @endforelse
        </tbody>
    </table>
</div>

@if (!empty($rows))
    {{-- Optional pagination slot --}}
    {{ $pagination ?? '' }}
@endif
