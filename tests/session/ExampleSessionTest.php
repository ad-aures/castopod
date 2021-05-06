<?php

namespace Tests\Session;

use Tests\Support\SessionTestCase;
class ExampleSessionTest extends SessionTestCase
{
    public function setUp(): void
    {
        parent::setUp();
    }

    public function testSessionSimple(): void
    {
        $this->session->set('logged_in', 123);

        $value = $this->session->get('logged_in');

        $this->assertEquals(123, $value);
    }
}
