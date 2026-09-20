<?php

declare(strict_types=1);

use PhpCsFixer\Config;
use PhpCsFixer\Finder;

$directories = [
    __DIR__.'/src',
];

if (is_dir(__DIR__.'/tests')) {
    $directories[] = __DIR__.'/tests';
}

$finder = Finder::create()
    ->in($directories);

return (new Config())
    ->setRiskyAllowed(true)
    ->setRules([
        '@Symfony' => true,
        'declare_strict_types' => true,
    ])
    ->setFinder($finder);