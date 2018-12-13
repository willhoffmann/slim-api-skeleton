<?php
/**
 * Cli config
 */

use Doctrine\ORM\Tools\Console\ConsoleRunner;

require __DIR__  . '/../vendor/autoload.php';

$settings = require __DIR__  . '/../src/settings.php';
$doctrine = $settings['settings']['doctrine'];

$config = \Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
    $doctrine['meta']['entity_path'],
    $doctrine['meta']['auto_generate_proxies'],
    $doctrine['meta']['proxy_dir'],
    $doctrine['meta']['cache'],
    false
);

$entityManager = \Doctrine\ORM\EntityManager::create($doctrine['connection'], $config);

return ConsoleRunner::createHelperSet($entityManager);
