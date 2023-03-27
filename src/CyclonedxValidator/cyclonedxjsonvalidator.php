<?php
require __DIR__ . '/../../vendor/autoload.php';
use JsonSchema\Validator;

$json_file = 'report.json';

// Validate the JSON syntax
if (!json_decode(file_get_contents($json_file))) {
    echo "Invalid JSON syntax\n";
}

// Validate the CycloneDX schema
$json_schema = file_get_contents('jsonschema.json');
// if(!json_decode($json_schema)) {
//     echo "Invalid CycloneDX schema\n";
// }

$json_validator = new Validator;
$json_validator->validate(json_decode(file_get_contents($json_file)), json_decode($json_schema));

if (!$json_validator->isValid()) {
    echo "Invalid CycloneDX report\n";
    foreach ($json_validator->getErrors() as $error) {
        echo "- " . $error['message'] . "\n";
    }
}