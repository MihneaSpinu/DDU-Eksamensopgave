<?php
require_once 'app/backend/core/Init.php';

define('BACKEND_AUTH',  'app/backend/auth/');
define('FRONTEND_BASE', 'app/frontend/');
define('FRONTEND_PAGE', 'app/frontend/pages/');
define('FRONTEND_INCLUDE', 'app/frontend/includes/');
define('FRONTEND_INCLUDE_ERROR', 'app/frontend/includes/errors/');
define('FRONTEND_ASSET', 'app/frontend/assets/');

require_once FRONTEND_INCLUDE . 'header.php';
if ($user->isLoggedIn()) {
    require_once BACKEND_AUTH . 'sidebar.php';
    require_once FRONTEND_INCLUDE . 'sidebar.php';
} else {
    if (strpos($_SERVER['REQUEST_URI'], 'login') === false) {
        Redirect::to('/login');
    }
}

require_once FRONTEND_INCLUDE . 'messages.php';
