<?php

/** Return the image URL for a known hero class, or null if it has no artwork. */
function hero_image_url(string $class): ?string
{
    $images = [
        'Warrior' => 'warrior-art.png',
        'Mage'    => 'mage-art.png',
        'Rogue'   => 'rogue-art.png',
    ];

    return isset($images[$class]) ? base_url('assets/media/hero/' . $images[$class]) : null;
}
