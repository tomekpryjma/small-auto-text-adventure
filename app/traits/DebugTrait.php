<?php

namespace App\Traits;

trait DebugTrait
{
    /**
     * Outputs debug bactrace.
     * 
     * @return void
     */
    public function debugBacktrace($property): void
    {
        $trace = debug_backtrace();
        trigger_error(
            'Undefined property via __get(): ' . $property .
            ' in ' . $trace[0]['file'] .
            ' on line ' . $trace[0]['line'],
            E_USER_NOTICE
        );
    }
}