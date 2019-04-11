<?php declare(strict_types = 1);

namespace App;

use Nette\Configurator;
use Nette\DI\Container;


require __DIR__ . '/vendor/autoload.php';


return (static function (): Container {
	$configurator = new Configurator();

	$configurator->setTempDirectory(__DIR__ . '/temp');
	$configurator->enableDebugger(__DIR__ . '/log');
	$configurator->setTimeZone('Europe/Prague');
	$configurator->addParameters([
		'appDir' => __DIR__ . '/src',
		'wwwDir' => __DIR__ . '/www',
	]);

	$configurator->addConfig(__DIR__ . '/config/config.neon');

	return $configurator->createContainer();
})();
