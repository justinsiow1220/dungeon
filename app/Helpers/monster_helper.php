<?php

/** Return the image URL for a known monster, or null if it has no artwork. */
function monster_image_url(string $name): ?string
{
    $images = [
        'Slime'    => 'slime-art.png',
        'Skeleton' => 'skeleton-art.png',
        'Goblin'   => 'goblin-art.png',
    ];

    return isset($images[$name]) ? base_url('assets/media/monster/' . $images[$name]) : null;
}
