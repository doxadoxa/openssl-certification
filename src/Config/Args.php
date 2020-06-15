<?php
declare(strict_types=1);

namespace OpenSSL\Config;

/**
 * Class Args
 */
class Args
{
    /** @var array */
    private $args;

    /**
     * Extra constructor.
     */
    public function __construct()
    {
        $this->args = [];
    }

    /**
     * @param string $argument
     * @param mixed $value
     */
    public function set(string $argument, $value): void
    {
        $this->args[$argument] = $value;
    }

    /**
     * Returns null on empty array, cause this format support
     * by default in opennssllib
     *
     * @return array|null
     */
    public function toArray(): ?array
    {
        return empty($this->args) ? null : $this->args;
    }
}
