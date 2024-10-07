<?php

use Core\App;

$currentUserId = 1;


$note = DB::queryFirstRow('SELECT * FROM notes WHERE id = %i', $_POST['id']);

// Handle the case where the note is not found
if (!$note) {
    throw new Exception('Note not found.');
}

// Authorize the action
authorize($note['user_id'] === $currentUserId);

// Delete the note using MeekroDB
DB::delete('notes', 'id = %i', $_POST['id']);

header('location: /notes');
exit();
