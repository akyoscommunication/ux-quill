<?php

namespace Akyos\Quill;

use Akyos\Quill\DependencyInjection\QuillExtension;
use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class Quill extends Bundle
{
    public function getContainerExtension(): ?ExtensionInterface
    {
        if (null === $this->extension) {
            $this->extension = new QuillExtension();
        }
        return $this->extension;
    }
}
