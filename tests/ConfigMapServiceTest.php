<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use WP\CLI\ConfigMaps\ConfigMapService;

final class ConfigMapServiceTest extends TestCase
{

    public function testOverride (): void
    {
        $configMap1 = [
            'metadata' => [
                'version' => 1,
            ],
            'data' => [
                'var1' => 'val1',
            ],
        ];
        $configMap2 = [
            'metadata' => [
                'version' => 1,
            ],
            'data' => [
                'var1' => 'val2',
            ],
        ];
        $configMaps = [
            'cm1' => $configMap1,
            'cm2' => $configMap2,
        ];
        ConfigMapService::setCustomMaps($configMaps);

        $configMapFinal = ConfigMapService::mergeDefinedMapSet();

        $this->assertEquals($configMapFinal['var1']['value'], "val2");
    }



    public function testOverrideNested (): void
    {
        $configMap1 = [
            'metadata' => [
                'version' => 1,
            ],
            'data' => [
                'l1' => [
                    'type' => 'array',
                    'value' => [
                        'var1' => 'val1',
                    ],
                ],
            ],
        ];
        $configMap2 = [
            'metadata' => [
                'version' => 1,
            ],
            'data' => [
                'l1' => [
                    'type' => 'array',
                    'value' => [
                        'var1' => 'val2',
                    ],
                ],
            ],
        ];
        $configMaps = [
            'cm1' => $configMap1,
            'cm2' => $configMap2,
        ];
        ConfigMapService::setCustomMaps($configMaps);

        $configMapFinal = ConfigMapService::mergeDefinedMapSet();

        $this->assertEquals($configMapFinal['l1']['value']['var1']['value'], "val2");
    }



    public function testArrayMerge (): void
    {
        $configMap1 = [
            'metadata' => [
                'version' => 1,
            ],
            'data' => [
                'l1' => [
                    'type' => 'array',
                    'value' => [
                        'var1' => 'val1',
                    ],
                ],
            ],
        ];
        $configMap2 = [
            'metadata' => [
                'version' => 1,
            ],
            'data' => [
                'l1' => [
                    'type' => 'array',
                    'value' => [
                        'var2' => 'val2',
                    ],
                ],
            ],
        ];
        $configMaps = [
            'cm1' => $configMap1,
            'cm2' => $configMap2,
        ];
        ConfigMapService::setCustomMaps($configMaps);

        $configMapFinal = ConfigMapService::mergeDefinedMapSet();

        $this->assertEquals($configMapFinal['l1']['value']['var1']['value'], "val1");
        $this->assertEquals($configMapFinal['l1']['value']['var2']['value'], "val2");
    }
}
