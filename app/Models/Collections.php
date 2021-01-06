<?php

namespace App\Models;

use Exception;
use Symfony\Component\Finder\Exception\DirectoryNotFoundException;

class Collections
{
    private const SAVE_TO = '';
    private const STATUS_PUBLISHED = 'Published';
    private const STATUS_EMPTY = 'Empty collection';
    private const STATUS_ERROR = 'Erroed';

    public function __construct(
        private ContentCollection $contentCollection,
        private CollectionChunk $collectionChunk,
    ) {}

    public function publishToHtml(): array
    {
        $collections = config('rpgdm.collections');

        $contents = [];
        foreach ($collections as $collection => $metadata) {
            try {
                $this->collectionChunk->publish(
                    $collection,
                    $this->contentCollection->publish($collection, $metadata),
                    $metadata['chunk'],
                    ['color' => $metadata['color']]
                );

                $contents[$collection] = self::STATUS_PUBLISHED;
            } catch (DirectoryNotFoundException) {
                $contents[$collection] = self::STATUS_EMPTY;
            } catch (Exception $exception) {
                ddd('general', $exception);
                $contents[$collection] = self::STATUS_ERROR;
            }
        }

        return $contents;
    }
}
