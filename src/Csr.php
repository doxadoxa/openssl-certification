<?php
declare(strict_types=1);

namespace OpenSSL;

use OpenSSL\Config\Args;
use OpenSSL\Config\Extra;
use RuntimeException;

/**
 * Class Csr
 * @package OpenSSL
 */
class Csr
{
    private $csr;

    public function __construct(DistinguishedName $dn, PrivateKey $privateKey,
                                ?Args $args = null, ?Extra $extra = null)
    {
        if (null === $args) {
            $args = new Args();
        }

        if (null === $extra) {
            $extra = new Extra();
        }

        $privateKeyResource = $privateKey->resource();

        $this->csr = openssl_csr_new($dn->toArray(), $privateKeyResource, $args->toArray(), $extra->toArray());

        if ($this->csr === false) {
            throw new RuntimeException("CSR can't be created.");
        }
    }

    /**
     * @return resource
     */
    public function resource()
    {
        return $this->csr;
    }
}
