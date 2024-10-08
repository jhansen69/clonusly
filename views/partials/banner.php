<?php if(!urlIs("/")) : ?>
<div class="container my-3">
  <nav aria-label="breadcrumb">
    <ol class="breadcrumb p-3 bg-body-tertiary rounded-3">
        <li class="breadcrumb-item">
        <a class="link-body-emphasis" href="/">
          <i class="fa-solid fa-house"></i>
          <span class="visually-hidden">Home</span>
        </a>
      </li>
      <li class="breadcrumb-item">
        <a class="link-body-emphasis fw-semibold text-decoration-none" href="<?= $_SERVER['REQUEST_URI'] ?>"><?= $heading ?></a>
      </li>
    
    </ol>
  </nav>
</div>
<?php endif ?>