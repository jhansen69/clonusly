<?php require base_path('views/partials/head.php') ?>
<?php require base_path('views/partials/nav.php') ?>

<main class="form-signin w-100 m-auto">
    <form action="/register" method="POST">
        <img class="mb-4" src="/assets/images/logo-90px.png" alt="Clonusly"  height="90">
        <h1 class="h3 mb-3 fw-normal">Registration</h1>
        <?php 
        if (!empty($errors)) {?>
            <div class="alert alert-danger" role="alert">
            <ul>
                <?php
            foreach($errors as $key=>$error)
            {
                echo "<li>".$error."</li>";
            }
            ?>
            </ul>
            </div> 
        <?php
        } else {
            $errors = [];
        }
        ?>
        <div class="form-floating">
            <input type="text" class="form-control first <?= isset($errors['first']) ? "is-invalid" : "" ?>" id="first" name="first" placeholder="Sally" value="<?php $old['first'] ?? "" ?>">
            <label for="first">First name</label>
        </div>
        <div class="form-floating">
            <input type="text" class="form-control inbetween <?= isset($errors['last']) ? "is-invalid" : "" ?>" id="last" name="last" placeholder="Smith" value="<?php $old['last'] ?? "" ?>">
            <label for="last">Last name</label>
        </div>
        
        <div class="form-floating">
            <input type="email" class="form-control inbetween <?= isset($errors['email']) ? "is-invalid" : "" ?>" id="email" name="email" placeholder="name@example.com" value="<?php $old['email'] ?? "" ?>">
            <label for="email">Email address</label>
        </div>
        <div class="form-floating">
            <input type="password" class="form-control last <?= isset($errors['password']) ? "is-invalid" : "" ?>" id="password" name="password" placeholder="Password">
            <label for="password">Password</label>
        </div>

        <button class="w-100 btn btn-lg btn-primary" type="submit">Register</button>
        
    </form>
</main>
<?php require base_path('views/partials/footer.php') ?>
