<?php

use Robo\Tasks;

class RoboFile extends Tasks
{
    const SRC_DIR = __DIR__ . '/src';
    const TESTS_DIR = __DIR__ . '/tests';
    const CODECEPTION_SUITES = ['unit'];

    public function test()
    {
        $this->stopOnFail(true);
        $this->lintPhp();
        $this->phpcs();
        $this->codecept();
    }

    public function codecept($suite = null)
    {
        $suites = $suite ? [$suite] : self::CODECEPTION_SUITES;
        foreach ($suites as $suite) {
            $task = $this->taskCodecept('vendor/bin/codecept');
            $task = $task->suite($suite);
            $task->run();
        }
    }

    private function lintPhp()
    {
        $this
            ->taskExec(vsprintf('find %s -name "*.php" -print0 | xargs -0 -n1 -P8 php -l', [
                implode(' ', [
                    self::SRC_DIR,
                    self::TESTS_DIR,
                ]),
            ]))
            ->run();
    }

    private function phpcs()
    {
        $this
            ->taskExec('vendor/bin/phpcs')
            ->args('--standard=.php_cs_ruleset.xml')
            ->args('--encoding=utf-8')
            ->args(sprintf('--ignore=%s/**/_bootstrap.php', self::TESTS_DIR))
            ->args(sprintf('--ignore=%s/_support/*Tester.php', self::TESTS_DIR))
            ->args(implode(' ', [self::SRC_DIR, self::TESTS_DIR,]))
            ->run();

        $this
            ->taskExec('vendor/bin/php-cs-fixer fix')
            ->args('--dry-run')
            ->args('--diff')
            ->args('--config-file .php_cs')
            ->run();
    }
}
