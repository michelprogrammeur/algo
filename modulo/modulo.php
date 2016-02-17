<?php
$count = 0;
$posts = range(0, 10);
$nbPosts = count($posts);

foreach ($posts as $post) {
    echo ($count == 0) ? '<div class="row">' : (($count % 2 == 0) ? '</div><div class="row">' : '');
    echo "post : $post";
    echo(($count == ($nbPosts - 1)) ? '</div>' : '');
    $count++;
}

/**
 * @decal by 3
 */

$decal = 0;
foreach (range(1, 100) as $ind) {

    $cond = ($decal % 3);

    if ($cond == 0) {
        // todo something
        echo "rangeM0 $ind \n";
    }

    if ($cond == 1) {
        // todo something
        echo "rangeM1 $ind \n";
    }

    if ($cond == 2) {
        // todo something
        echo "rangeM2 $ind \n";
    }

    $decal++;
}