<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;
use Twig\TwigFunction;
use App\Service\FooterAreas;

class AppExtension extends AbstractExtension
{

    private $footerAreas;

    public function __construct(FooterAreas $footerAreas)
    {
        $this->footerAreas = $footerAreas;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('getAreas', [$this, 'getAreas']),
        ];
    }

    public function getAreas()
    {
        return $this->footerAreas->getFooterAreas();
    }

    public function getFilters(): array
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
