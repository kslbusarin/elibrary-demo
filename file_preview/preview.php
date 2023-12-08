<?php

// Path to the image directory
$imageDir = 'test_ssl/';

// Get all JPEG images in the directory
$imageFiles = glob($imageDir . '/*.jpg');

// Iterate through the image files and display them
foreach ($imageFiles as $imageFile) {
    echo '<img src="' . $imageFile . '" width="40%" alt="Image">' . '<br>';
}
