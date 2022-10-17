<?php

namespace Omaicode\MediaLibrary\MediaCollections\Exceptions;

use Omaicode\MediaLibrary\HasMedia;
use Omaicode\MediaLibrary\MediaCollections\File;
use Omaicode\MediaLibrary\MediaCollections\MediaCollection;

class FileUnacceptableForCollection extends FileCannotBeAdded
{
    public static function create(File $file, MediaCollection $mediaCollection, HasMedia $hasMedia): self
    {
        $modelType = get_class($hasMedia);

        return new static("The file with properties `{$file}` was not accepted into the collection named `{$mediaCollection->name}` of model `{$modelType}` with id `{$hasMedia->getKey()}`");
    }
}
