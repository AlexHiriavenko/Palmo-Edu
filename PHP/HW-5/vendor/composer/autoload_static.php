<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit4670adc67990dcdd3511f60bf2cc0861
{
    public static $prefixLengthsPsr4 = array (
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit4670adc67990dcdd3511f60bf2cc0861::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit4670adc67990dcdd3511f60bf2cc0861::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit4670adc67990dcdd3511f60bf2cc0861::$classMap;

        }, null, ClassLoader::class);
    }
}
