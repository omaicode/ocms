<?php

namespace Omaicode\MediaLibrary\MediaCollections\Events;

use Illuminate\Queue\SerializesModels;
use Omaicode\MediaLibrary\MediaCollections\Models\Media;

class MediaHasBeenAdded
{
    use SerializesModels;

    public Media $media;

    public function __construct(Media $media)
    {
        $this->media = $media;
    }
}
