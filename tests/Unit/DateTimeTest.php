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

    public function testInvalidDateHasErrors()
    {
        $dt = \DateTime::createFromFormat('Y-m-d', '2025-02-30'); // Invalid Feb 30
        $errors = \DateTime::getLastErrors();

        // Should always produce errors regardless of PHP version
        $this->assertTrue(
            is_array($errors) && array_sum($errors) > 0,
            'Invalid date should produce DateTime errors'
        );
    }

    public function testValidDatetimeHasNoErrors()
    {
        $dt = \DateTime::createFromFormat('Y-m-d\TH:i', '2025-09-06T12:34');
        $errors = \DateTime::getLastErrors();

        $this->assertTrue(
            $errors === false || (is_array($errors) && array_sum($errors) === 0),
            'Valid datetime should not produce DateTime errors'
        );
    }
}
