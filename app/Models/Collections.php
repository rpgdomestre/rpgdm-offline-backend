<?php

namespace App\Models;

use Exception;
use Symfony\Component\Finder\Exception\DirectoryNotFoundException;

class Collections
{
    private const STATUS_PUBLISHED = 'Published';
    private const STATUS_EMPTY = 'Empty collection';
    private const STATUS_ERROR = 'Erroed';

    private const COLLECTION_CHUNK_DEFAULT = 10;
    private const COLLECTION_COLOR_DEFAULT = 'black';

    public function __construct(
        private ContentCollection $contentCollection,
        private CollectionChunk $collectionChunk,
    ) {}

    public function publishToHtml(): array
    {
        $collections = config('rpgdm.collections');

        $contents = [];
        foreach ($collections as $collection => $metadata) {
            if ($metadata['hidden'] ?? false) {
                continue;
            }

            ddd($this->contentCollection->publish($collection, $metadata));

            try {
                $this->collectionChunk->publish(
                    $collection,
                    $this->contentCollection->publish($collection, $metadata),
                    $metadata['chunk'] ?? self::COLLECTION_CHUNK_DEFAULT,
                    ['color' => $metadata['color'] ?? self::COLLECTION_COLOR_DEFAULT]
                );

                $contents[$collection] = self::STATUS_PUBLISHED;
            } catch (DirectoryNotFoundException) {
                $contents[$collection] = self::STATUS_EMPTY;
            } catch (Exception $exception) {
                ddd($exception);
                $contents[$collection] = self::STATUS_ERROR;
            }
        }

        return $contents;
    }
}
