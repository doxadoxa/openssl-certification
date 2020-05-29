<?php
declare(strict_types=1);

namespace OpenSSL;

use OpenSSL\DN\Location;
use OpenSSL\DN\Organization;
use OpenSSL\DN\Person;

/**
 * Class DistinguishedName
 * @package OpenSSL
 */
class DistinguishedName
{
    /** @var Location */
    private $location;

    /** @var Organization  */
    private $organization;

    /** @var Person  */
    private $person;

    /**
     * DistinguishedName constructor.
     * @param Location $location
     * @param Organization $organization
     * @param Person $person
     */
    public function __construct(Location $location, Organization $organization, Person $person )
    {
        $this->location = $location;
        $this->organization = $organization;
        $this->person = $person;
    }

    /**
     * @return Location
     */
    public function location(): Location
    {
        return $this->location;
    }

    /**
     * @return Organization
     */
    public function organization(): Organization
    {
        return $this->organization;
    }

    /**
     * @return Person
     */
    public function person(): Person
    {
        return $this->person;
    }

    /**
     * @return array
     */
    public function toArray(): array
    {
        return [
            'countryName' => $this->location->countryCode(),
            'stateOrProvinceName' => $this->location->stateOrProvinceName(),
            'localityName' => $this->location->localityName(),
            'organizationName' => $this->organization->organizationName(),
            'organizationalUnitName' => $this->organization->organizationalUnitName(),
            'commonName' => $this->person->commonName(),
            'emailAddress' => $this->person->email()
        ];
    }
}
