<?php

namespace App\Support\Traits;

trait ResolveMediaToArray
{
    /**
     * Return media as array of [id, path]
     */
    public function mediaArray(string $collection = 'default'): array
    {
        return $this->getMedia($collection)
            ->map(function ($media) {
                return [
                    'id'   => $media->id,
                    'path' => $media->getUrl(),
                ];
            })
            ->toArray();
    }

    /**
     * Return first media with id, name and url
     */
    public function firstMediaData(string $collection = 'default'): ?array
    {
        $media = $this->getFirstMedia($collection);

        return $media
            ? [
                'id'   => $media->id,
                'name' => $media->name,
                'url'  => $media->getUrl(),
            ]
            : null;
    }
}
