<?php

// Using a config to hold these values will make it easier in the future if they need to change
return [
    'base_uri' => env('GOOGLE_BOOKS_API', 'https://www.googleapis.com/books/v1/'),
    'placeholder' => [
        'src' => env('IMAGE_PLACEHOLDER', 'https://via.placeholder.com/300/0000FF/808080?Text=No+Image'),
    ]
];
