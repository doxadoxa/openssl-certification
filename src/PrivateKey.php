<?php
declare(strict_types=1);

namespace OpenSSL;

use http\Exception\InvalidArgumentException;
use RuntimeException;

class PrivateKey
{
    private const DEFAULT_BITS = 2048;
    private const DEFAULT_KEY_TYPE = OPENSSL_KEYTYPE_RSA;

    /** @var resource */
    private $privateKey;

    /**
     * PrivateKey constructor.
     * @param resource $privateKey
     */
    public function __construct( $privateKey )
    {
        if ( !is_resource( $privateKey )  ) {
            throw new RuntimeException("Private key is not resource.");
        }

        $this->privateKey = $privateKey;
    }

    /**
     * @param int $privateKeyBits
     * @param int $privateKeyType
     * @return PrivateKey
     */
    public static function generate(  int $privateKeyBits = self::DEFAULT_BITS,
                                      int $privateKeyType = self::DEFAULT_KEY_TYPE  ): PrivateKey
    {
        $privateKey = openssl_pkey_new([
            "private_key_bits" => $privateKeyBits,
            "private_key_type" => $privateKeyType,
        ]);

        if ( $privateKey === false ) {
            throw new RuntimeException("Private key can't be created.");
        }

        return new PrivateKey( $privateKey );
    }

    /**
     * @param string $pem
     * @param string|null $password
     * @return PrivateKey
     */
    public static function restore( string $pem, string $password = null ): PrivateKey
    {
        $privateKey = openssl_pkey_get_private( $pem, $password );

        if ( $privateKey === false ) {
            throw new RuntimeException("Private key can't be restored.");
        }

        return new PrivateKey( $privateKey );
    }

    /**
     * @return resource
     */
    public function resource()
    {
        return $this->privateKey;
    }
}
