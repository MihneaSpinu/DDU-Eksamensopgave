<div class="container-fluid">
  <div class="row">
    <div class="col-5 col-sm-4 col-md-3 col-lg-2 p-3 bg-secondary flex-column vh-100 position-sticky top-0 shadow-lg d-lg-block collapse" id="collapseSidebar">
      <div class="mb-4">
        <a href="/" class="text-decoration-none">
          <img src="<?php echo FRONTEND_ASSET . "images/logo.png" ?>" class="w-100">
        </a>
      </div>
      <div class="mx-2">
        <div class="border-linear shadow mx-auto">
          <div class="container bg-white rounded">
            <ul class="nav nav-pills flex-column">
              <div class="row">
                <a class="text-muted my-2 col-4">Menu</a>
                <!-- Close sidebar button -->
                <div class="col-auto ml-auto">
                  <button class="navbar-toggler d-block d-lg-none" type="button" data-toggle="collapse" data-target="#collapseSidebar" aria-expanded="true" aria-controls="collapseSidebar">
                    <i class="fa fa-solid fa-times"></i>
                  </button>
                </div>
              </div>
              <li class="nav-item w-100">
                <a class="nav-link" href="/">
                  Forside
                </a>
              </li>
              <?php if ($user_type != "censor") : ?>
                <li>
                  <a class="nav-link" href="/skema">
                    Skema
                  </a>
                </li>
                <li class="nav-item">
                  <a class="nav-link" href="/rum">Mine rum</a>
                </li>
                <li>
                  <a class="nav-link" href="/samtaler">
                    <div class="row">
                      <div class="col ">
                        Samtaler
                      </div>
                      <!-- If unread messages above 0, show circle to the right with number -->
                      <?php if ($unread_messages > 0) : ?>
                        <div class="mr-1 rounded-circle bg-primary text-white text-center d-flex justify-content-center align-items-center" style="width: 1.2rem; height: 1.2rem;">
                          <?php echo $unread_messages; ?>
                        </div>
                      <?php endif; ?>
                    </div>
                  </a>
                  <!-- If unread messages above 0, show circle to the right with number -->

                </li>
              <?php endif; ?>
              <a class="border-top text-muted pt-2">Indstillinger</a>

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
              <li class="dropdown mt-auto py-2">
                <a href="#" class="align-items-center text-decoration-none dropdown-toggle row ml-2" id="dropdownUser1" data-bs-toggle="dropdown" aria-expanded="false">
                  <!-- Make circle with user initials in center. User initials change text size to always fit in same circle -->
                  <div class="d-flex justify-content-center align-items-center rounded-circle bg-primary col-auto" style="width: 2.5rem; height: 2.5rem;">
                    <span><?php echo $user->data()->initials; ?></span>
                  </div>
                  <div class="col-auto">
                    Bruger
                  </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-dark text-small shadow">
                  <li><a class="dropdown-item" href="/profile">Profil</a></li>
                  <hr class="dropdown-divider">
                  <li><a class="dropdown-item" href="/logout">Log ud</a></li>
                </ul>
              </li>
              <li>
                <?php if ($user_type == "student") : ?>
                  <div class="border-top py-2">
                    <?php if ($next_homework) : ?>
                      <a><b>Næste aflevering:</b></a><br>
                      <a href="/aflevering?id=<?php echo $next_homework->homework_ID; ?>">
                        <?php echo $subject->subject_name . ", om " . $time; ?>
                      </a>
                    <?php else : ?>
                      <a>Ingen afleveringer</a>
                    <?php endif; ?>
                  </div>
                <?php endif; ?>
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
    <!-- 
    <nav class="navbar sticky-top navbar-expand-sm">
      <div class="container yellow-color">
        <div class="row mx-auto">
          <div class="col-2 d-flex justify-content-center h-75 my-auto align-items-center pl-0">
            <button class="navbar-toggler navbar-dark" type="button" data-toggle="collapse" data-target="#collapsibleHeader">
              <span class="navbar-toggler-icon"></span>
            </button>
          </div>
          <a class="col mx-auto navbar-brand justify-content-center d-flex" href="/">
            <img class="w-100 h-auto" src="<?php echo FRONTEND_ASSET . 'logo.png'; ?>" alt="logo">
          </a>
          <div class="col-2 d-flex align-items-center justify-content-center">
            <a class="nav-link px-0 ml-auto" href="/cart">
              <i class="fa fa-shopping-cart"></i>
              <?php echo $cartHTML; ?>
            </a>
          </div>
          <div class="collapse navbar-collapse" id="collapsibleHeader"> -->

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

    <div class="col-md-12 col-sm-12 col-lg-10">
      <div class="container my-5 mx-auto">
        <button class="navbar-toggler d-block d-lg-none" type="button" data-toggle="collapse" data-target="#collapseSidebar" aria-expanded="true" aria-controls="collapseSidebar">
          <i class="fa fa-solid fa-bars"></i>
        </button>