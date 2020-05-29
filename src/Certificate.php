<?php
declare(strict_types=1);

namespace OpenSSL;

/**
 * Interface Certificate
 * @package OpenSSL
 */
interface Certificate
{
    /**
     * @param string $pem
     * @return Certificate
     */
    public static function restore( string $pem ): Certificate;

    /**
     * @return resource
     */
    public function resource();

    /**
     * @return string
     */
    public function export(): string;
}