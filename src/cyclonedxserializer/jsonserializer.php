<?php
/*
This is a very basic way to create and serialize cyclonedx report in json format.
We can use this as a reference to create cyclonedx report and serialize them in fossology.
*/
require __DIR__ . '/../../vendor/autoload.php';

// Create an array to hold the components
$components = array();

// Create a component object
$component1 = new stdClass();
$component1->name = 'Component 1';
$component1->type = 'library';
$component1->group = 'org.example';
$component1->version = '1.0.0';
$component1->purl = 'component1/purl';
$component1->licenses = array(
    array(
        'id' => 'MIT',
        'url' => 'https://opensource.org/licenses/MIT'
    )
);
$component1->hashes = array(
    array(
        'alg' => 'SHA-256',
        'value' => 'abc123'
    )
);
$component1->dependencies = array(
    array(
        'ref' => 'composer/dependency1',
        'scope' => 'compile'
    ),
    array(
        'ref' => 'composer/dependency2',
        'scope' => 'Runtime'
    )
);

// Add the component to the components array
$components[] = $component1;

// Create another component object
$component2 = new stdClass();
$component2->name = 'Component 2';
$component2->type = 'library';
$component2->group = 'org.example';
$component2->version = '2.0.0';
$component2->purl = 'component2/purl';
$component2->licenses = array(
    array(
        'id' => 'MIT',
        'url' => 'https://opensource.org/licenses/MIT'
    )
);
$component2->hashes = array(
    array(
        'alg' => 'SHA-256',
        'value' => 'def456'
    )
);
$component2->dependencies = array(
    array(
        'ref' => 'composer/dependency1',
        'scope' => 'compile'
    ),
    array(
        'ref' => 'composer/dependency2',
        'scope' => 'runtime'
    )
);

// Add the component to the components array
$components[] = $component2;

// Create the CycloneDX report object
$report = new stdClass();
$report->bomFormat = 'CycloneDX';
$report->specVersion = '1.3';
$report->serialNumber = 'urn:uuid:3eaf5e0e-4c3d-4b2e-9b1f-7f4b5cfe6e46';
$report->version = '1.0';
$report->components = $components;

// Encode the object as a JSON string
$jsonString = json_encode($report, JSON_PRETTY_PRINT);

// Save the JSON string to a file
file_put_contents('bom.json', $jsonString);

// Output the JSON string
echo $jsonString;