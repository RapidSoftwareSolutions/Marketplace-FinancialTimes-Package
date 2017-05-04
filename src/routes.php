<?php
$routes = [
    'metadata',
    'getContentById',
    'getCurationsList',
    'getAspectsList',
    'getFacetsList',
    'searchContent',
    'getContentNotifications'
];
foreach($routes as $file) {
    require __DIR__ . '/../src/routes/'.$file.'.php';
}

