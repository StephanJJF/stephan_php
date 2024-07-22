<?php

use App\authentication\DataSqliteAuthentication;
use PHPUnit\Framework\TestCase;

class DataSqliteAuthenticationTest extends TestCase {
    public function testGetStatus () {

        $this->assertEquals(true, (new DataSqliteAuthentication("user", "user", ":memory:"))->getStatus());
    }
}