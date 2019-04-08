<?php

/**
 * Redirects to other webpages.
 */
class Redirect {

    /**
     * To the defined page, uses a relative path (like "user/profile")
     *
     * @param $path string
     */
    public static function to($path) {
        header('location: ' . URL . (substr($path, -1) == '/' ? '' : '/') . $path);
        exit();
    }

     /**
     * To the homepage
     */
    public static function home()
    {
        header("location: " . URL);
        exit();
    }
}