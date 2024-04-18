<?php
$type = null;
if (isset($_GET['lektie'])) {
    if ($_GET['lektie'] == 1 || $_GET['lektie'] == 0)
        $type = $_GET['lektie'] == 1 ? 'homework' : 'submission';
    else {
        Redirect::to('/');
    }
} else {
    Redirect::to('/');
}
$dage = array(
    'Mon' => 'Man',
    'Tue' => 'Tir',
    'Wed' => 'Ons',
    'Thu' => 'Tor',
    'Fri' => 'Fre',
    'Sat' => 'Lør',
    'Sun' => 'Søn'
);