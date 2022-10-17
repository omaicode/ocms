<?php

namespace Omaicode\MediaLibrary\Support;

use Omaicode\MediaLibrary\MediaCollections\Exceptions\FunctionalityNotAvailable;
use Omaicode\MediaLibraryPro\Models\TemporaryUpload;

class MediaLibraryPro
{
    public static function ensureInstalled()
    {
        if (! self::isInstalled()) {
            throw FunctionalityNotAvailable::mediaLibraryProRequired();
        }
    }

    public static function isInstalled(): bool
    {
        return class_exists(TemporaryUpload::class);
    }
}
