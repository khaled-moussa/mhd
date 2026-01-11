<?php

namespace App\Support\Traits;

trait ArrayDataOperations
{
    // Push new item at the beginning of the array
    protected function pushNewDataFromArray(array &$data, array $newData): void
    {
        array_unshift($data, $newData);
    }

    // Replace an item in the array by UUID
    protected function replaceDataInArray(array &$data, array $updatedData, string $uuid): void
    {
        $index = array_search($uuid, array_column($data, 'uuid'));

        if ($index !== false) {
            $data[$index] = $updatedData;
        }
    }

    // Delete an item from the array by UUID
    protected function deleteDataFromArray(array &$data, string $uuid): void
    {
        $data = array_values(
            array_filter($data, fn($item) => $item['uuid'] !== $uuid)
        );
    }
}
