<?php
declare(strict_types=1);

namespace OpenSSL;

use OpenSSL\Config\Args;

/**
 * Class CertificateAuthority
 * @package OpenSSL
 */
final class CertificateAuthority extends BaseCertificate implements Certificate
{
    private const AUTHORITY_SERIAL = 0;

    /**
     * @param string $pem
     * @return Certificate|CertificateAuthority
     */
    public static function restore( string $pem ): Certificate
    {
        $resource = openssl_x509_read( $pem );
        return new CertificateAuthority( $resource );
    }

    /**
     * @param Csr $csr
     * @param PrivateKey $privateKey
     * @param int $days
     * @param Args|null $args
     * @param int $serial
     * @return Certificate|CertificateAuthority
     */
    public static function generate( Csr $csr, PrivateKey $privateKey,
                                   int $days, Args $args = null, int $serial = self::AUTHORITY_SERIAL ): Certificate
    {
        if ( null === $args ) {
            $args = new Args();
        }

        $signed = openssl_csr_sign( $csr->resource(), null, $privateKey->resource(),
            $days, $args->toArray(), $serial );

        return new CertificateAuthority( $signed );
    }
}
