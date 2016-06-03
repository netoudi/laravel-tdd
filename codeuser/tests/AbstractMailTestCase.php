<?php

namespace CodePress\CodeUser\Tests;

use CodePress\CodeUser\Providers\CodeUserServiceProvider;
use Illuminate\Auth\AuthServiceProvider;
use Illuminate\Auth\Passwords\PasswordResetServiceProvider;
use Orchestra\Testbench\TestCase;

abstract class AbstractMailTestCase extends AbstractTestCase
{
    public static function setUpBeforeClass()
    {
        self::rrmdir(__DIR__ . '/views');
        mkdir(__DIR__ . '/views');
    }

    public static function tearDownAfterClass()
    {
        self::rrmdir(__DIR__ . '/views');
    }

    public static function rrmdir($dir)
    {
        if (is_dir($dir)) {
            $objects = scandir($dir);
            foreach ($objects as $object) {
                if ($object != '.' && $object != '..') {
                    if (filetype($dir . '/' . $object) == 'dir') {
                        self::rrmdir($dir . '/' . $object);
                    } else {
                        unlink($dir . '/' . $object);
                    }
                }
            }
            rmdir($dir);
        }
    }

    public function getPackageProviders($app)
    {
        return [
            AuthServiceProvider::class,
            PasswordResetServiceProvider::class,
            CodeUserServiceProvider::class
        ];
    }

    /**
     * Define environment setup.
     *
     * @param  \Illuminate\Foundation\Application $app
     * @return void
     */
    protected function getEnvironmentSetUp($app)
    {
        parent::getEnvironmentSetUp($app);
        config([
            'app' => [
                'key' => '12345678912345678912345678912345',
                'cipher' => 'AES-256-CBC'
            ]
        ]);
        config(['mail' => require __DIR__ . '/config/mail.php']);
        config(['view' => require __DIR__ . '/config/view.php']);
    }
}