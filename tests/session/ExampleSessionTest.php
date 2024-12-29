<?php

declare(strict_types=1);

namespace Tests\Session;

use CodeIgniter\Test\CIUnitTestCase;

class ExampleSessionTest extends CIUnitTestCase
{
    public function testSessionSimple(): void
    {
        $session = service('session');

        $session->set('logged_in', 123);
        $this->assertSame(123, $session->get('logged_in'));
    }
}
