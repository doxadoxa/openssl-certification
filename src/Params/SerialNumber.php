<?php
declare(strict_types=1);

namespace OpenSSL\Params;

/**
 * Class SerialNumber
 * @package OpenSSL\Params
 */
class SerialNumber
{
    /** @var int */
    private $serialNumber;

    /**
     * SerialNumber constructor.
     * @param int $serialNumber
     */
    public function __construct( int $serialNumber )
    {
        $this->serialNumber = $serialNumber;
    }

    /**
     * @return int
     */
    public function number(): int
    {
        return $this->serialNumber;
    }

    /**
     * @return string
     */
    public function hex(): string
    {
        return '0x' . dechex( $this->serialNumber );
    }
}
