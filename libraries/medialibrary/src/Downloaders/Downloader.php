<?php

namespace Omaicode\MediaLibrary\Downloaders;

interface Downloader
{
    public function getTempFile(string $url): string;
}
