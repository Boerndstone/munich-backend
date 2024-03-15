<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters()
    {
        return [
            new TwigFilter('custom_replace', [$this, 'customReplaceFilter']),
        ];
    }

    public function customReplaceFilter($value)
    {
        // Your custom replacement logic here
        $replacements = [' ', '!', '&', '.', ','];
        $value = str_replace($replacements, '', $value);

        // Additional replacement for 'ö'
        $value = str_replace(['ö', 'ä', 'ü', '_', 'ß'], ['oe', 'ae', 'ue', ' ', 'ss'], $value);

        return $value;
    }
}
