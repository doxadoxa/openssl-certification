<?php
declare(strict_types=1);

namespace OpenSSL\DN;

/**
 * Class Location
 */
class Location
{
    /** @var string  */
    private $countryCode;

    /** @var string  */
    private $stateOrProvinceName;

    /** @var string */
    private $localityName;

    public function __construct( string $countryCode, string $stateOrProvinceName, string $localityName )
    {
        $this->countryCode = $countryCode;
        $this->stateOrProvinceName = $stateOrProvinceName;
        $this->localityName = $localityName;
    }

    /**
     * @return string
     */
    public function countryCode(): string
    {
        return $this->countryCode;
    }

    /**
     * @return string
     */
    public function stateOrProvinceName(): string
    {
        return $this->stateOrProvinceName;
    }

    /**
     * @return string
     */
    public function localityName(): string
    {
        return $this->localityName;
    }
}
