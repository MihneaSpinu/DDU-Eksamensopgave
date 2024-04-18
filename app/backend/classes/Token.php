<?php

class Token
{
    public static function generate($form)
    {
        return Session::put("{$form}_token", Hash::make(uniqid()));
    }

    public static function check($form, $token)
    {
        $tokenName = $form . "_token";

        if(Session::exists($tokenName) && $token === Session::get($tokenName))
        {
            Session::delete($tokenName);
            return true;
        }

        Session::delete($tokenName);
        return false;
    }
}