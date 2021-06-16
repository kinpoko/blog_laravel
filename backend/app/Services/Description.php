<?php
namespace App\Services;

class Description
{   
    
    const NUM_OF_DESCRIPTION = 120;

    public static function parse($text)
    {
        $withouttags = strip_tags($text);
        $description = mb_substr($withouttags, 0, self::NUM_OF_DESCRIPTION);
        return $description;

    }
}
?>