<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    protected function initDatabase()
    {
        Artisan::call('migrate');
        Artisan::call('db:seed');
    }

    public function setUp(): void
    {
        parent::setUp();
        $this->initDatabase();
    }
}
