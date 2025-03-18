<?php

namespace Akyos\UXQuill\Config;

interface QuillConfigurationInterface
{
    public function getDefaultConfig(): string;

    public function getConfigs(): array;

    public function getConfig(string $name): array;
}
