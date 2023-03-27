<?php
/*
Collecting necessary data
In this example, we are using static data but in actual implementation data will be retrive from database and then 
we will create the component array.
*/

$components = [
    [
        "name" => "ComponentFirst",
        "version" => "1.0.0",
        "licenses" => [
            "GPLv3"
        ]
    ],
    [
        "name" => "ComponentSecond",
        "version" => "2.0.0",
        "licenses" => [
            "Apache-2.0"
        ]
    ]
];

/*
Using the static data to generate the CycloneDX XML document which can be further validated against cyclonedx schema
*/
$xml = new SimpleXMLElement('<?xml version="1.0" encoding="UTF-8"?><bom xmlns="http://cyclonedx.org/schema/bom/1.3"></bom>');
foreach ($components as $component) {
    $componentNode = $xml->addChild("component");
    $componentNode->addAttribute("type", "library");
    $componentNode->addChild("group", $component["name"]);
    $componentNode->addChild("name", $component["name"]);
    $componentNode->addChild("version", $component["version"]);
    foreach ($component["licenses"] as $license) {
        $licenseNode = $componentNode->addChild("license");
        $licenseNode->addAttribute("id", $license);
        $licenseNode->addAttribute("name", $license);
    }
}

// Save the XML document
$xml->asXML("cyclonedx.xml");

// Validate the XML document
$xmlSchema = new DOMDocument();
$xmlSchema->load("cyclonedx.xsd");
$xmlDocument = new DOMDocument();
$xmlDocument->load("cyclonedx.xml");
if (!$xmlDocument->schemaValidate($xmlSchema)) {
    die("XML validation error");
}

// Generate the final report
$report = file_get_contents("cyclonedx.xml");
echo $report;