<?php

$currentUserId = 1;

// Fetch the note using the findOrFail helper
$note = findOrFail('SELECT * FROM notes WHERE id = %i', $_POST['id']);

// Authorize the action
authorize($note['user_id'] === $currentUserId);

view("notes/edit.view.php", [
    'heading' => 'Edit Note',
    'errors' => [],
    'note' => $note
]);