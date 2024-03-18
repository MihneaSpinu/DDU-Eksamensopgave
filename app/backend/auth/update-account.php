<?php
require_once 'app/backend/core/Init.php';

if (Input::exists()) {
    if (Token::check(Input::get('csrf_token'))) {
        $validate = new Validation();

        $validation = $validate->check($_POST, array(
            'current_password'  => array(
                'required'  => true,
                'min'       => 6,
                'verify'     => 'password'
            ),
            'new_password'  => array(
                'optional'  => true,
                'min'       => 6,
                'bind'      => 'confirm_new_password'
            ),

            'confirm_new_password' => array(
                'optional'  => true,
                'min'       => 6,
                'match'   => 'new_password',
                'bind' => 'new_password',
            ),
        ));

        if ($validation->passed()) {
            try {

                if ($validation->optional()) {
                    $user->update(array(
                        'password'  => Password::hash(Input::get('new_password'))
                    ));
                }
                Session::flash('update-success', 'Password er blevet opdateret!');
                Redirect::to('/');
            } catch (Exception $e) {
                die($e->getMessage());
            }
        } else {
            echo '<div class="alert alert-danger"><strong></strong>' . cleaner($validation->error()) . '</div>';
        }
    }
}
