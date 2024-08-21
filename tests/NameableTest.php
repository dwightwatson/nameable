<?php

namespace Watson\Nameable\Tests;

use Watson\Nameable\Name;
use Watson\Nameable\Nameable;

class NameableTest extends TestCase
{
    public function test_it_gets_name_instance()
    {
        $result = (new Nameable)->get(null, null, 'Dwight Conrad Watson', null);

        $this->assertInstanceOf(Name::class, $result);

        $this->assertEquals('Dwight Conrad Watson', (string) $result);
    }

    public function test_it_casts_name_instance_back_to_string()
    {
        $name = Name::from('Dwight Conrad Watson');

        $result = (new Nameable)->set(null, null, $name, null);

        $this->assertIsString($result);

        $this->assertEquals('Dwight Conrad Watson', $result);
    }
}
