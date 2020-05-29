<?php
declare(strict_types=1);

namespace OpenSSL;

use OpenSSL\Config\Args;
use OpenSSL\DN\Location;
use OpenSSL\DN\Organization;
use OpenSSL\DN\Person;
use OpenSSL\Params\SerialNumber;

/**
 * Class BaseCertificate
 * @package OpenSSL
 */
class BaseCertificate
{
    /** @var resource */
    private $resource;

    /** @var DistinguishedName */
    private $issuer;

    /** @var DistinguishedName */
    private $subject;

    /** @var SerialNumber */
    private $serialNumber;

    /** @var int Timestamp */
    private $validFrom;

    /** @var int Timestamp */
    private $validTo;

    /***
     * CertificateAuthority constructor.
     * @param $x509CertificateResource
     */
    public function __construct( $x509CertificateResource )
    {
        $this->resource = $x509CertificateResource;
        $data = openssl_x509_parse( $this->resource );

        $this->subject = new DistinguishedName(
            new Location(
                $data['subject']['C'],
                $data['subject']['ST'],
                $data['subject']['L']
            ),
            new Organization(
                $data['subject']['O'],
                $data['subject']['OU']
            ),
            new Person(
                $data['subject']['CN'],
                $data['subject']['emailAddress']
            )
        );

        if ( isset( $data['issuer'] ) ) {
            $this->issuer = new DistinguishedName(
                new Location(
                    $data['issuer']['C'],
                    $data['issuer']['ST'],
                    $data['issuer']['L']
                ),
                new Organization(
                    $data['issuer']['O'],
                    $data['issuer']['OU']
                ),
                new Person(
                    $data['issuer']['CN'],
                    $data['issuer']['emailAddress']
                )
            );
        } else {
            $this->issuer = null;
        }

        $this->serialNumber = new SerialNumber( (int) $data['serialNumber'] );

        $this->validFrom = (int) $data['validFrom'];
        $this->validTo = (int) $data['validTo'];
    }

    /**
     * @return resource
     */
    public function resource()
    {
        return $this->resource;
    }

    /**
     * @return DistinguishedName
     */
    public function subject(): DistinguishedName
    {
        return $this->subject;
    }

    /**
     * @return DistinguishedName|null
     */
    public function issuer(): ?DistinguishedName
    {
        return $this->issuer;
    }

    /**
     * @return SerialNumber
     */
    public function serialNumber(): SerialNumber
    {
        return $this->serialNumber;
    }

    /**
     * @return string
     */
    public function export(): string
    {
        $output = null;
        openssl_x509_export( $this->resource, $output, false );

        return $output;
    }
}
