<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit760b9213e894c60f14479413df3d85a9
{
    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Component\\EventDispatcher\\' => 34,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Component\\EventDispatcher\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/event-dispatcher',
        ),
    );

    public static $prefixesPsr0 = array (
        'G' => 
        array (
            'Guzzle\\Tests' => 
            array (
                0 => __DIR__ . '/..' . '/guzzle/guzzle/tests',
            ),
            'Guzzle' => 
            array (
                0 => __DIR__ . '/..' . '/guzzle/guzzle/src',
            ),
        ),
        'C' => 
        array (
            'Coincheck\\' => 
            array (
                0 => __DIR__ . '/..' . '/coincheck/coincheck/lib',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit760b9213e894c60f14479413df3d85a9::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit760b9213e894c60f14479413df3d85a9::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit760b9213e894c60f14479413df3d85a9::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
