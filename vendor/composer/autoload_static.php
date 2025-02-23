<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitc2d14525e6de75d54f66dd63f177f81f
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'Picqer\\Barcode\\' => 15,
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'M' => 
        array (
            'Master\\NominaAlgj\\' => 18,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Picqer\\Barcode\\' => 
        array (
            0 => __DIR__ . '/..' . '/picqer/php-barcode-generator/src',
        ),
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Master\\NominaAlgj\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitc2d14525e6de75d54f66dd63f177f81f::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitc2d14525e6de75d54f66dd63f177f81f::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitc2d14525e6de75d54f66dd63f177f81f::$classMap;

        }, null, ClassLoader::class);
    }
}
