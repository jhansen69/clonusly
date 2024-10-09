<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php require base_path('views/partials/banner.php') ?>

<main>
    <?php
    // Example usage
    $formData = ['title' => 'My Note', 'note' => 'This is a sample note.'];
    $errors = ['title' => 'Title is required.', 'note' => 'Note cannot be empty.'];
    $noteForm = new Form($formData, 'POST', '/notes', $errors);
    $noteForm->hidden('id');
    $noteForm->text('title', ['required' => true, 'minLength' => 1, 'maxLength' => 50]);
    $noteForm->date('publish_date');
    $noteForm->textarea('note');
    $noteForm->number('priority', ['decimals' => 0]);
    $noteForm->render();
    ?>
</main>

<?php require base_path('views/partials/footer.php') ?>
