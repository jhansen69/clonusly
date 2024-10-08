<?php require('partials/head.php') ?>
<?php require('partials/nav.php') ?>
<?php require('partials/banner.php') ?>


    <div class="px-4 my-2 text-center border-bottom">
        <div class="overflow-hidden" style="max-height: 30vh;">
            <div class="container px-5">
                <img src="/assets/images/logo-large.png" class="img-fluid " alt="Clonusly Logo" width="700" height="500" loading="lazy">
            </div>
        </div>
        <h1 class="display-4 fw-bold text-body-emphasis">Welcome to Clonusly</h1>
        <div class="col-lg-6 mx-auto">
            <p class="lead mb-4">Reward your teammates for helping make your day better!</p>
            <div class="d-grid gap-2 d-sm-flex justify-content-sm-center mb-5">
                <button type="button" class="btn btn-primary btn-lg px-4 me-sm-3">Send a reward</button>
                <button type="button" class="btn btn-outline-secondary btn-lg px-4">Redeem your points</button>
            </div>
        </div>
        
    </div>

    <main>
        <div class="">
            <p>Hello, <?= $_SESSION['user']['first_name'] ?? 'Guest' ?>. Welcome to the home page.</p>
        </div>
    </main>
    <button id="testButton" type="button" class="btn">Click me</button>
    

<?php require('partials/footer.php') ?>
