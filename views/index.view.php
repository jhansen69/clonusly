<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>

    <section class="hero">
        <figure class="image">
            <img src="/assets/images/logo-large.png">
        </figure>
    </section>
    <main>
        <div class="">
            <p>Hello, <?= $_SESSION['user']['first_name'] ?? 'Guest' ?>. Welcome to the home page.</p>
        </div>
    </main>
    <button id="testButton">Click me</button>
    

<?php require('partials/footer.php') ?>
