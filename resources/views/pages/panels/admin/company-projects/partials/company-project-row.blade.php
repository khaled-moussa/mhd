{{-- Table row --}}
<tr>
    <td data-label="#">{{ $index }}</td>
    <td data-label="Title">{{ $item['title'] }}</td>
    <td data-label="Description"> {{ $item['description'] }} </td>

    <td data-label="Visibilty State">
        <div class="text-{{ $item['visible_color']}}">
            <i class="fi {{ $item['visible_icon'] }}"></i>
        </div>
    </td>

    {{-- Table row actions --}}
    <td data-label="Actions">
        <x-table.row-actions :index="$item['uuid']">
            {{-- View --}}
            <li class="table-row-actions__item">
                <x-button.outline
                    class="secondary"
                    label="View"
                    @click="viewCompanyProject('{{ $item['uuid'] }}')"
                >
                    <i class="fi fi-tr-overview"></i>
                </x-button.outline>
            </li>

            {{-- Edit --}}
            <li class="table-row-actions__item">
                <x-button.outline
                    class="secondary"
                    label="Edit"
                    @click="editCompanyProject('{{ $item['uuid'] }}')"
                >
                    <i class="fi fi-rc-pencil"></i>
                </x-button.outline>
            </li>

            {{-- Delete --}}
            <li class="table-row-actions__item">
                <x-button.outline
                    class="danger secondary"
                    label="Delete"
                    @click="deleteCompanyProject('{{ $item['uuid'] }}')"
                >
                    <i class="fi fi-rr-trash"></i>
                </x-button.outline>
            </li>
        </x-table.row-actions>
    </td>
</tr>
