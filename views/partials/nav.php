    <!-- START NAV -->
    <nav class="navbar">
        <div class="container">
            <div class="navbar-brand">
                <a class="navbar-item" href="../">
                    <img src="assets/images/logo-90px.png" alt="Logo">
                </a>
                <span class="navbar-burger burger" data-target="navbarMenu">
                        <span></span>
                <span></span>
                <span></span>
                </span>
            </div>
            <div id="navbarMenu" class="navbar-menu">
                <div class="navbar-end">
                    <a href="/" class="navbar-item <?= urlIs('/') ? "is-active" :"" ?>">
                            Home
                        </a>
                    <?php if ($_SESSION['user'] ?? false) : ?>
                    <a href="/notes" class="navbar-item <?= urlIs('/notes') ? "is-active" :"" ?>">
                            Notes
                        </a>
                    <?php endif ?>
                    <a href="/about" class="navbar-item <?= urlIs('/about') ? "is-active" :"" ?>">
                            About
                        </a>
                    <a href="/contact" class="navbar-item <?= urlIs('/contact') ? "is-active" :"" ?>">
                            Contact
                        </a>
                    <?php if ($_SESSION['user'] ?? false) : ?>
                    <div class="navbar-item has-dropdown is-hoverable">
                            <a class="navbar-link">
                                Account
                            </a>
                        <div class="navbar-dropdown">
                            <a class="navbar-item">
                                    Dashboard
                                </a>
                            <a class="navbar-item">
                                    Profile
                                </a>
                            <a class="navbar-item">
                                    Settings
                                </a>
                            <hr class="navbar-divider">
                            <div class="navbar-item">
                                Logout
                            </div>
                            
                    </div>
                    <?php else : ?>
                        <div class="ml-3">
                            <a href="/register"
                            class="navbar-item <?= urlIs('/register') ? 'is-active' : '' ?>">Register</a>
                            <a href="/login"
                            class="navbar-item <?= urlIs('/login') ? 'is-active' : '' ?>">Log In</a>
                    </div>
                    <?php endif ?>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <!-- END NAV -->
    