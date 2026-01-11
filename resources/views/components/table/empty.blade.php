@props([
    'message' => 'No data found',
    'colspan' => 5,
])

<tr>
    <td colspan="{{ $colspan }}" class="empty-table">
        {{ $message }}
    </td>
</tr>
