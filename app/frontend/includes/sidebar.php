<div class="container-fluid">
  <div class="row">
    <div class="col-2 p-3 bg-primary d-flex flex-column vh-100 position-sticky top-0 shadow-lg">
      <div class="mb-4">
        <a href="/" class="mb-md-0 me-md-auto text-decoration-none">
          <img src="<?php echo FRONTEND_ASSET . "images/logo.png" ?>" class="w-100">
        </a>
      </div>
      <div class="container">
        <div class="border-linear shadow">
        <div class="container bg-white rounded">
          <ul class="nav nav-pills flex-column">
            <a class="opacity-60 my-2">Menu</a>
            <li class="nav-item">
              <a class="nav-link" href="/">
                Forside
              </a>
            </li>
            <li>
              <a class="nav-link" href="/skema">
                Skema
              </a>
            </li>
            <li>
              <a class="nav-link" href="/rum">
                Rum
              </a>
            </li>
            <li>
              <a class="nav-link" href="/samtaler">
                Samtaler
              </a>
            </li>
            <a class="border-top opacity-60 pt-2">Indstillinger</a>
            <li>
              <a class="nav-link" href="/præferencer">
                Præferencer
              </a>
            </li>
            <li>
              <a class="nav-link" href="https://www.hansenberg.dk/">
                Skolens side
              </a>
            </li>
            <?php if ($user->hasPermission('administrate_site')) : ?>
              <li>
                <!-- Admin on off toggle -->
                <div class="d-flex justify-content-between align-items-center">
                  <a class="text-muted">Admin</a>
                  <label class="switch">
                    <input type="checkbox">
                    <span class="slider"></span>
                  </label>
                </div>
              </li>
            <?php endif; ?>
          </ul>
        </div>
        </div>
      </div>
      <div class="dropdown mt-auto py-2">
        <a href="#" class="d-flex align-items-center text-decoration-none dropdown-toggle" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
          <!-- Make circle with user initials in center. User initials change text size to always fit in same circle -->
          <div class="d-flex justify-content-center align-items-center rounded-circle bg-light" style="width: 2.5rem; height: 2.5rem;">
            <span class="text-dark"><?php echo $user->data()->initials; ?></span>
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
          <li><a class="dropdown-item" href="#">Filler</a></li>
          <li><a class="dropdown-item" href="#">Filler</a></li>
          <li><a class="dropdown-item" href="/profile">Profil</a></li>
          <hr class="dropdown-divider">
          <li><a class="dropdown-item" href="/logout">Sign out</a></li>
        </ul>
      </div>
      <div class="border-top">
        <?php
        //If next homework exists:
        if ($next_homework) : ?>
          <a>Næste aflevering</a>
          <br>
        <?php echo $subject->subject_name . ", om " . $time;
        else : ?>
          <a>Ingen afleveringer</a>
        <?php endif; ?>
      </div>
    </div>

    <script>
      //Make nav-item active based on url
      $(document).ready(function() {
        var url = window.location;
        $('a[href="' + url + '"]').addClass('active');
        $('a').filter(function() {
          return this.href == url;
        }).addClass('active');
      });
    </script>

    <div class="col-10">
      <div class="container my-5 h-75">