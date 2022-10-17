<?php

namespace Omaicode\MediaLibrary\MediaCollections\Exceptions;

use Exception;
use Omaicode\MediaLibrary\MediaCollections\Models\Media;

class MediaCannotBeUpdated extends Exception
{
    public static function doesNotBelongToCollection(string $collectionName, Media $media): self
    {
        return new static("Media id {$media->getKey()} is not part of collection `{$collectionName}`");
    }
}
