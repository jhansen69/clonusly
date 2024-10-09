<header class="mb-5 p-3 text-bg-dark">
    <div class="container">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
        <a href="/" class="d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
            <img src="assets/images/logo-90px.png" alt="Logo">
        </a>

        <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
          <li><a href="/" class="nav-link px-2 text-white <?= urlIs('/') ? "active" :"" ?>">Home</a></li>
          <li><a href="/about" class="nav-link px-2 text-white <?= urlIs('/about') ? "active" :"" ?>" >About</a></li>
          <li><a href="/contact" class="nav-link px-2 text-white <?= urlIs('/contact') ? "active" :"" ?>">Contact </a></li>
          <?php if ($_SESSION['user'] ?? false) : ?>
            <li><a href="/notes" class="nav-link px-2 text-white <?= urlIs('/notes') ? "active" :"" ?>">Notes</a></li>
        <?php endif ?>
        </ul>

        <?php if ($_SESSION['user'] ?? false) : ?>
            <div class="dropdown text-end">
                <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle text-white" data-bs-toggle="dropdown" aria-expanded="false">
                    <i class="fa-solid fa-user"></i> Hello, <?= $_SESSION['user']['first_name'] ?? 'Guest' ?>
                </a>
                <ul class="dropdown-menu text-small" style="">
                    <li><a class="dropdown-item" href="/profile">Profile</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><form method="POST" action="/logout"><input type="hidden" name="_method" value="DELETE" /><button type='submit' class="dropdown-item" href="">Sign out</button></form></li>
                </ul>
            </div>
        
          <?php else : ?>
            <div class="text-end">
                <a href="/login" class="btn btn-outline-light me-2">Login</a>
                <a href="/register" class="btn btn-warning">Register</a>
            </div>
        <?php endif ?>
      </div>
    </div>
  </header>
<!-- Begin page content -->
<main class="flex-shrink-0 container">
