<?php
declare(strict_types=1);

namespace OpenSSL\DN;

/**
 * Class Organization
 */
class Organization
{
    /** @var string */
    private $organizationName;
    /** @var string */
    private $organizationalUnitName;

    /**
     * Organisation constructor.
     * @param string $organizationName
     * @param string $organizationalUnitName
     */
    public function __construct(string $organizationName, string $organizationalUnitName)
    {
        $this->organizationName = $organizationName;
        $this->organizationalUnitName = $organizationalUnitName;
    }

    /**
     * @return string
     */
    public function organizationName(): string
    {
        return $this->organizationName;
    }

    /**
     * @return string
     */
    public function organizationalUnitName(): string
    {
        return $this->organizationalUnitName;
    }
}
