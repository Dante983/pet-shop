<?php

return [
    'private_key' => env('JWT_PRIVATE_KEY'),
    'public_key' => env('JWT_PUBLIC_KEY'),
    'ttl' => env('JWT_TTL', 60), // Token Time To Live in minutes
];
