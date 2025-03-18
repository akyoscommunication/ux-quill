<?php

namespace Akyos\UXQuill;

use Symfony\Component\DependencyInjection\Extension\ExtensionInterface;
use Symfony\Component\HttpKernel\Bundle\Bundle;

final class UXQuillBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
