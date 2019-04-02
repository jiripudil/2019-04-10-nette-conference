<?php declare(strict_types = 1);

$container = require __DIR__ . '/../bootstrap.php';
assert($container instanceof Nette\DI\Container);

$application = $container->getByType(Nette\Application\Application::class);
assert($application instanceof Nette\Application\Application);

$application->run();
