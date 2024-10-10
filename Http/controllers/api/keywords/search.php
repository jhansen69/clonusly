<?php

// Search for keywords that start with the provided string, sorted alphabetically
if (isset($_GET['query'])) {
    $partial = $_GET['query'];
    $results = \DB::query("SELECT id, keyword FROM keywords WHERE keyword LIKE %s ORDER BY keyword ASC", $partial . '%');

    // Return the results as an associative array (id => keyword)
    $keywords = [];
    foreach ($results as $row) {
        $keywords[$row['id']] = $row['keyword'];
    }

    return $keywords;
} else {
    return [
        'status'=>"404",
        'message'=>"Missing partial parameter"
    ];
}
