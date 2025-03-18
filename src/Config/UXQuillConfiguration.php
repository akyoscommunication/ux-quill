<?php

namespace Akyos\UXQuill\Config;

class UXQuillConfiguration implements QuillConfigurationInterface
{
    private $defaultConfig;
    private $configs = [];

    public function __construct(array $config)
    {
        $this->defaultConfig = $config['default_config'];
        $this->configs = $config['configs'];
    }

    public function getDefaultConfig(): string
    {
        return $this->defaultConfig;
    }

    public function getConfigs(): array
    {
        return $this->configs;
    }

    public function getConfig($name): array
    {
        return $this->configs[$name] ?? [];
    }
}
