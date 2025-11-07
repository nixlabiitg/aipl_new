<?php
defined('BASEPATH') OR exit('No direct script access allowed');

if (!function_exists('dd')) {
    /**
     * Dump and Die (like Laravel dd)
     *
     * @param mixed ...$vars
     */
    function dd(...$vars) {
        echo '<pre style="background:#f5f5f5; padding:15px; border:1px solid #ccc;">';
        foreach ($vars as $var) {
            print_r($var);
        }
        echo '</pre>';
        die();
    }
}
