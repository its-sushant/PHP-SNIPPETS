<?php
/*
    This is the simple implementation of generating SPDX report in json format
    I have used static data to generate dynamic report using twig template
    In fossology we need to prepare data first from database then after passing through
    lots of functions we can create arrays for packages, licenses, files, etc.
    Then we can pass these arrays to twig template and render the template.
*/
require __DIR__ . '/../../vendor/autoload.php';

$loader = new \Twig\Loader\FilesystemLoader('templates');
$twig = new \Twig\Environment($loader);

// Array to store all the packages
$package = array();

/* 
    Static packages to add in spdx report
    Contains all the information about the package
*/
$package[] = array(
    "SPDXID"=> "SPDXRef-Package-example1",
    "name"=> "example package1",
    "versionInfo"=> "1.0",
    "downloadLocation"=> "http=>//example.com/package/example-1.0.tar.gz",
    "filesAnalyzed"=> true,
    "licenseConcluded"=> "MIT",
    "licenseDeclared"=> " MIT",
    "licenseComments"=> "This is a license comment1",
    "checksums"=> [
        [
        "algorithm"=> "SHA1",
        "checksumValue"=> "1a2b3c4d5e6f7a8b9c0d1e2f3a4b5c6d7e8f9a0b"
    ]
    ],
    "sourceInfo"=> "This is a source info",
    "licenseInfoFromFiles"=> [
        "MIT"
    ],
    "licenseInfosDeclared"=> [
        "MIT"
    ],
    "licenseCommentsFromFiles"=> [
        "This is a license comment1"
    ],
    "attributionTexts"=> [
        "This is an attribution text1"
    ]
);
$package[] = array(
    "SPDXID"=> "SPDXRef-Package-example2",
    "name"=> "example package2",
    "versionInfo"=> "1.0",
    "downloadLocation"=> "http=>//example.com/package/example-2.0.tar.gz",
    "filesAnalyzed"=> true,
    "licenseConcluded"=> "MIT",
    "licenseDeclared"=> " MIT",
    "licenseComments"=> "This is a license comment2",
    "checksums"=> [
        [
        "algorithm"=> "SHA1",
        "checksumValue"=> "1a2b3c4d5e6f7a8b9c0d1e2f3a4b5c6d7e8f9a0b"
    ]
    ],
    "sourceInfo"=> "This is a source info",
    "licenseInfoFromFiles"=> [
        "MIT"
    ],
    "licenseInfosDeclared"=> [
        "MIT"
    ],
    "licenseCommentsFromFiles"=> [
        "This is a license comment2"
    ],
    "attributionTexts"=> [
        "This is an attribution text2"
    ]
);

// Render the twig template and store it in spdx.json
$result = $twig->render('spdx.twig', array('package' => $package));
file_put_contents('spdx.json', $result);