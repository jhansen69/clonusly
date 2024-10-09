<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>
<?php
$results = DB::query('SELECT * FROM users');
    foreach ($results as $row) {
        echo $row['email'] .'<br>';
    }
?>    
<main class="form-signin w-100 m-auto">
    <?php 
    if (!empty($errors)) {?>
        <div class="alert alert-danger" role="alert">
        <?= $errors['login'] ?>
        </div> 
    <?php
    }
    ?>
    <form action="/session" method="POST">
        <img class="mb-4" src="/assets/images/logo-90px.png" alt="Clonusly"  height="90">
        <h1 class="h3 mb-3 fw-normal">Please sign in</h1>

        <div class="form-floating">
        <input type="email" class="form-control first" id="email" name="email" placeholder="name@example.com" value="<?php $old['email'] ?? "" ?>">
        <label for="email">Email address</label>
        </div>
        <div class="form-floating">
        <input type="password" class="form-control last" id="password" name="password" placeholder="Password">
        <label for="password">Password</label>
        </div>

        <div class="checkbox mb-3">
        <label>
            <input name="remember" type="checkbox" value="1"> Remember me
        </label>
        </div>
        <button class="w-100 btn btn-lg btn-primary" type="submit">Sign in</button>

    </form>
</main>

<?php require base_path('views/partials/footer.php') ?>
