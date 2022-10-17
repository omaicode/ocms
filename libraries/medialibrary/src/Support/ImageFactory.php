<?php

namespace Omaicode\MediaLibrary\Support;

use Omaicode\Image\Image;

class ImageFactory
{
    public static function load(string $path): Image
    {
        return Image::load($path)->useImageDriver(config('media-library.image_driver'));
    }
}
