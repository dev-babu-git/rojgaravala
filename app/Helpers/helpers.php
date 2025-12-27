<?php

use Illuminate\Support\Str;


if (!function_exists('checkCategoryText')) {

    function checkCategoryText($text)
    {


        $keywords = [
            'Letest Jobs',
            'Admit Card',
            'Result',
            'Off Campus',
            'Fresher Jobs',
            'Internship',
            'Off-Campus',
            'Latest Jobs'
        ];



        if (in_array(trim($text), $keywords)) {
            return $text;
        }
    }
}

function truncate_chars($text, $length = 10, $end = '...')
{
    return Str::limit($text, $length, $end);
}
