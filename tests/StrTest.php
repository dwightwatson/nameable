<?php

namespace Watson\Nameable\Tests;

use Watson\Nameable\Str;

class StrTest extends TestCase
{
    public function test_it_returns_first_letter_of_string()
    {
        $this->assertEquals('D', Str::firstLetter('Dwight'));
    }

    public function test_it_squishes_additional_space_from_a_string()
    {
        $this->assertEquals('Dwight Conrad Watson', Str::squish('   Dwight   Conrad   Watson'));
    }
}
