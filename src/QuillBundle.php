<?php

namespace Symfony\UX\Quill;

use Akyos\Quill\DependencyInjection\QuillExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class QuillBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
