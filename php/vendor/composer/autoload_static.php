<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit5311ac7f1d1b8c424c1769be8e43939b
{
    public static $prefixLengthsPsr4 = array (
        'P' =>
        array (
            'PontosDeVida\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PontosDeVida\\' =>
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit5311ac7f1d1b8c424c1769be8e43939b::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit5311ac7f1d1b8c424c1769be8e43939b::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
