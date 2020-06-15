<?php
declare(strict_types=1);

namespace OpenSSL;

use OpenSSL\Config\Args;

/***
 * Class SlaveCertificate
 * @package OpenSSL
 */
final class SlaveCertificate extends BaseCertificate implements Certificate
{
    private const DEFAULT_SERIAL = 0;

    /**
     * @param Csr $csr
     * @param CertificateAuthority $authority
     * @param PrivateKey $privateKey
     * @param int $days
     * @param Args|null $args
     * @param int $serial
     * @return CertificateAuthority
     */
    public static function generate(Csr $csr, CertificateAuthority $authority, PrivateKey $privateKey,
                                     int $days, Args $args = null, int $serial = self::DEFAULT_SERIAL): Certificate
    {
        if (null === $args) {
            $args = new Args();
        }

        $signed = openssl_csr_sign($csr->resource(), $authority->resource(), $privateKey->resource(),
            $days, $args->toArray(), $serial);

        return new SlaveCertificate($signed);
    }

    /**
     * @param string $pem
     * @return Certificate|CertificateAuthority
     */
    public static function restore(string $pem): Certificate
    {
        $resource = openssl_x509_read($pem);
        return new SlaveCertificate($resource);
    }
}
