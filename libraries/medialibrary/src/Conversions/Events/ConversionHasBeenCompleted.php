<?php

namespace Omaicode\MediaLibrary\Conversions\Events;

use Illuminate\Queue\SerializesModels;
use Omaicode\MediaLibrary\Conversions\Conversion;
use Omaicode\MediaLibrary\MediaCollections\Models\Media;

class ConversionHasBeenCompleted
{
    use SerializesModels;

    public Media $media;

    public Conversion $conversion;

    public function __construct(Media $media, Conversion $conversion)
    {
        $this->media = $media;

        $this->conversion = $conversion;
    }
}
