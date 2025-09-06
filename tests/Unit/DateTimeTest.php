<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;

class DateTimeTest extends TestCase
{
    public function testValidDateHasNoErrors()
    {
        $dt = \DateTime::createFromFormat('Y-m-d', '2025-09-06');
        $errors = \DateTime::getLastErrors();

        // PHP 8.2+: false | pre-8.2: array
        $this->assertTrue(
            $errors === false || (is_array($errors) && array_sum($errors) === 0),
            'Valid date should not produce DateTime errors'
        );
    }
}
