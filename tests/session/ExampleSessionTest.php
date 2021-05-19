<?php

namespace Tests\Session;

use Tests\Support\SessionTestCase;

class ExampleSessionTest extends SessionTestCase
{
    protected function setUp(): void
    {
        parent::setUp();
    }

    public function testSessionSimple(): void
    {
        $this->session->set('logged_in', 123);

        $value = $this->session->get('logged_in');

        $this->assertSame(123, $value);
    }
}
