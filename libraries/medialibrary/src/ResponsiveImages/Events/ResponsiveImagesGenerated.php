<?php

namespace Omaicode\MediaLibrary\ResponsiveImages\Events;

use Illuminate\Queue\SerializesModels;
use Omaicode\MediaLibrary\MediaCollections\Models\Media;

class ResponsiveImagesGenerated
{
    use SerializesModels;

    public Media $media;

    public function __construct(Media $media)
    {
        $this->media = $media;
    }
}
