<nav class="navbar sticky-top navbar-dark bg-dark mb-4 py-3">
    <div class="container-fluid">
      <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-start">
          <a href="/" class="d-flex align-items-center mb-2 me-5 mb-lg-0 text-white text-decoration-none" style='width:200px;'>
              <img src="/assets/images/logo-90px.png" alt="Logo" class="d-inline-block">
          </a>
          <ul class="nav col-12 col-lg-auto me-lg-auto mb-2 justify-content-center mb-md-0">
            <li><a href="/" class="nav-link px-2 text-white <?= urlIs('/') ? "active" :"" ?>">Home</a></li>
            <li><a href="/about" class="nav-link px-2 text-white <?= urlIs('/about') ? "active" :"" ?>" >About</a></li>
            <li><a href="/contact" class="nav-link px-2 text-white <?= urlIs('/contact') ? "active" :"" ?>">Contact </a></li>
            <?php if ($_SESSION['user'] ?? false) : ?>
              <li><a href="/notes" class="nav-link px-2 text-white <?= urlIs('/notes') ? "active" :"" ?>">Notes</a></li>
          <?php endif ?>
          <?php if ($_SESSION['user']['admin'] ?? false) : ?>
              <li class="nav-item dropdown">
                  <a href="#" class="nav-link px-2  link-body-emphasis text-decoration-none dropdown-toggle text-white" id="AdminDropdownLink" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                      Admin
                  </a>
                  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="AdminDropdownLink">
                      <li><a class="dropdown-item" href="/admin">Dashboard</a></li>
                      <li><hr class="dropdown-divider"></li>
                      <li><a class="dropdown-item" href="/admin/rewards">Rewards</a></li>
                      <li><a class="dropdown-item" href="/admin/messages">Messages</a></li>
                      <li><a class="dropdown-item" href="/admin/users">Users</a></li>
                  </ul>
              </li>
          <?php endif ?>

          </ul>

          <?php if ($_SESSION['user'] ?? false) : ?>
              <div class="nav-item dropdown text-end">
                  <a href="#" class="d-block link-body-emphasis text-decoration-none dropdown-toggle text-white" id="UserDropdownLink" data-bs-toggle="dropdown" aria-expanded="false" role="button">
                      <i class="fa-solid fa-user"></i> Hello, <?= $_SESSION['user']['first_name'] ?? 'Guest' ?>
                  </a>
                  <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="UserDropdownLink">
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
</nav>
<!-- Begin page content -->
<main class="flex-shrink-0 container">
