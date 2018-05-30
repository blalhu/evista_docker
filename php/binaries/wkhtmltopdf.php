#!/usr/bin/php

<?php

$location       = base64_encode( exec('pwd') );
unset($argv[0]);
$commandRequest = base64_encode('wkhtmltopdf ' . implode(" ", $argv) );

$ch = curl_init('http://172.1.32.8:8800');

$params = [
    'location' => $location,
    'command'  => $commandRequest
];

curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$result = curl_exec($ch);
$result = json_decode($result, true);

curl_close($ch);

echo implode("\n", $result['output'])."\n\n";

exit((int)$result['returnStatus']);
