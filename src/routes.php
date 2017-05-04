<?php
$routes = [
    'metadata',
    'getContentById'
];
foreach($routes as $file) {
    require __DIR__ . '/../src/routes/'.$file.'.php';
}

