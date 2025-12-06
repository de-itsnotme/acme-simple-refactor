<?php
$ch = curl_init('http://host.docker.internal:1337/has_permission/token1234');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Host: localhost',
    'User-Agent: PhpClient/1.0'
]);
$response = curl_exec($ch);
curl_close($ch);

echo $response;
