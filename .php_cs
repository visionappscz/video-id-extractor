<?php
    $finder = Symfony\CS\Finder\DefaultFinder::create()
        ->in(['src', 'tests'])
        ->exclude('_support/_generated')
        ->notName('_bootstrap.php')
        ->notName('*Tester.php');

    return Symfony\CS\Config\Config::create()
        ->level(Symfony\CS\FixerInterface::SYMFONY_LEVEL)
        ->fixers([
            '-phpdoc_params',
            '-phpdoc_short_description',
            '-phpdoc_separation',
            'concat_with_spaces',
            'newline_after_open_tag',
            'ordered_use',
            'phpdoc_order',
            'short_array_syntax',
            'strict',
        ])
        ->finder($finder);
