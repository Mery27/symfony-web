<?php

namespace App\Twig;

use DateTimeImmutable;
use Twig\Extension\RuntimeExtensionInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class AppRuntime implements RuntimeExtensionInterface
{   
    /** 
     * Date format default: 'short'
     * 'long'  => 'j.n.Y H:i',
     * 'short' => 'j.n.Y',
     * 
    */
    public function formatDate(DateTimeImmutable $date, string $format = 'long'): string
    {
        $formatType = [
            'long'  => 'j.n.Y H:i',
            'short' => 'j.n.Y',
        ];

        return date_format($date, $formatType[$format] ?? $formatType['short']);
    }
}