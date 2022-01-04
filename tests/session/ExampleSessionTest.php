<?php

declare(strict_types=1);

namespace Tests\Session;

use CodeIgniter\Test\CIUnitTestCase;
use Config\Services;

class ExampleSessionTest extends CIUnitTestCase
{
    public function testSessionSimple(): void
    {
        $session = Services::session();

        $session->set('logged_in', 123);
        $this->assertSame(123, $session->get('logged_in'));
    }
}
