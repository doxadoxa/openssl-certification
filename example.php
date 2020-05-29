<?php
declare(strict_types=1);

include "vendor/autoload.php";

use OpenSSL\CertificateAuthority;
use OpenSSL\Config\Args;
use OpenSSL\Config\Extra;
use OpenSSL\Csr;
use OpenSSL\DistinguishedName;
use OpenSSL\DN\Location;
use OpenSSL\DN\Organization;
use OpenSSL\DN\Person;
use OpenSSL\PrivateKey;
use OpenSSL\SlaveCertificate;

$privateKey = PrivateKey::generate();

$args = new Args();
$args->set("digest_alg", "sha256WithRSAEncryption");
$args->set("x509_extensions", "v3_ca");

$csr = new Csr(
    new DistinguishedName(
        new Location(
            "RU", "Saint-Petersburg", "SPb"
        ),
        new Organization(
            "HROM", "HROM Team"
        ),
        new Person(
            "Taras D",
            "td@hrom.fund"
        )
    ),
    $privateKey,
    $args
);


$slaveArgs = new Args();
$slaveArgs->set("digest_alg", "sha256WithRSAEncryption");
$slaveArgs->set("x509_extensions", "v3_req");

$slaveExtra = new Extra();

$slaveCsr = new Csr(
    new DistinguishedName(
        new Location(
            "RU", "Saint-Petersburg", "SPb"
        ),
        new Organization(
            "HROM", "HROM Team"
        ),
        new Person(
            "Taras D",
            "td@hrom.fund"
        )
    ),
    $privateKey,
    $slaveArgs
);

$ca = CertificateAuthority::generate( $csr, $privateKey, 365 );
$saved = $ca->export();

$slave = SlaveCertificate::generate( $slaveCsr, $ca, $privateKey,365, null, 30 );
echo $slave->serialNumber()->number() . PHP_EOL;
echo $slave->serialNumber()->hex() . PHP_EOL;