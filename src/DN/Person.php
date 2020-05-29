<?php
declare(strict_types=1);

namespace OpenSSL\DN;

/**
 * Class Person
 * @package OpenSSL\DN
 */
class Person
{
    /** @var string */
    private $commonName;

    /** @var string */
    private $email;

    /**
     * Person constructor.
     * @param string $commonName
     * @param string $email
     */
    public function __construct(string $commonName, string $email)
    {
        $this->commonName = $commonName;
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function commonName(): string
    {
        return $this->commonName;
    }

    /**
     * @return string
     */
    public function email(): string
    {
        return $this->email;
    }
}
