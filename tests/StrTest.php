<?php

namespace Watson\Nameable\Tests;

use Watson\Nameable\Str;

class StrTest extends TestCase
{
    /** @test */
    public function it_returns_first_letter_of_string()
    {
        $this->assertEquals('D', Str::firstLetter('Dwight'));
    }

    /** @test */
    public function it_squishes_additional_space_from_a_string()
    {
        $this->assertEquals('Dwight Conrad Watson', Str::squish('   Dwight   Conrad   Watson'));
    }
}
