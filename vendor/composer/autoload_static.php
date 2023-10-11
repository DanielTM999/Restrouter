<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitaa9f78c256c19fab7505bd9800cb709d
{
    public static $prefixLengthsPsr4 = array (
        'D' => 
        array (
            'Danieltm\\Restrouter\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Danieltm\\Restrouter\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitaa9f78c256c19fab7505bd9800cb709d::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitaa9f78c256c19fab7505bd9800cb709d::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitaa9f78c256c19fab7505bd9800cb709d::$classMap;

        }, null, ClassLoader::class);
    }
}
