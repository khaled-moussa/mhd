{{-- Table row --}}
<tr>
    <td data-label="#">{{ $index }}</td>
    <td data-label="Name">{{ $item['name'] }}</td>
    <td data-label="Email">{{ $item['email'] }}</td>
    <td data-label="Phone">{{ $item['phone'] }}</td>

    {{-- Table row actions --}}
    <td data-label="Actions">
        <x-table.row-actions :index="$item['uuid']">
            {{-- View --}}
            <li class="table-row-actions__item">
                <x-button.outlined
                    class="secondary"
                    label="View"
                    @click="viewContact('{{ $item['uuid'] }}')"
                >
                    <i class="fi fi-tr-overview"></i>
                </x-button.outline>
            </li>

            {{-- Delete --}}
            <li class="table-row-actions__item">
                <x-button.outlined
                    class="danger secondary"
                    label="Delete"
                    @click="deleteContact('{{ $item['uuid'] }}')"
                >
                    <i class="fi fi-rr-trash"></i>
                </x-button.outline>
            </li>
        </x-table.row-actions>
    </td>
</tr>
