<?php

$rooms = get_posts([
    'post_type' => 'room',
    'posts_per_page' => -1,
]);

foreach($rooms as $room) {
    var_dump($room->post_title);
}