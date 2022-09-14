<?php

use Illuminate\Support\Str;

/**
 * Title helper
 *
 * @param $title
 * @param  null  $truncate
 * @return string
 */
if (!function_exists('formatTitle')) {
    function formatTitle($title, $truncate = null)
    {
        $in = html_entity_decode($title, ENT_QUOTES | ENT_HTML5);
        if ($truncate) {
            return Str::limit($in, 65, '...');
        }

        return $in;
    }
}
