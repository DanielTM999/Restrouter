<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitaa9f78c256c19fab7505bd9800cb709d
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInitaa9f78c256c19fab7505bd9800cb709d', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitaa9f78c256c19fab7505bd9800cb709d', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitaa9f78c256c19fab7505bd9800cb709d::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
