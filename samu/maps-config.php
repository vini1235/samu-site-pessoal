<?php
// Prefer environment variables; keep existing machine credentials out of Git.
$localFile = __DIR__ . '/maps.local.php';
$localKeys = is_file($localFile) ? require $localFile : [];
return [
    1 => getenv('GOOGLE_MAPS_API_KEY_1') ?: ($localKeys[1] ?? ''),
    2 => getenv('GOOGLE_MAPS_API_KEY_2') ?: ($localKeys[2] ?? ''),
    3 => getenv('GOOGLE_MAPS_API_KEY_3') ?: ($localKeys[3] ?? ''),
];
