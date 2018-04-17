<?php
declare( strict_types = 1 );

// Checked for PSR2 compliance 17/4/18.

namespace kdaviesnz\CPGI;

/**
 * Interface ICPGI
 * @package kdaviesnz\CPGI
 */
interface ICPGI
{
    /**
     * Get the processor name.
     * @return string
     */
    public function getProcessorName(): string;
}
