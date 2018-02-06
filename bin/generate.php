#!/usr/bin/env php
<?php
/**
 * This file is part of GraphQLQuery package.
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */
declare(strict_types=1);

use Stenin\GraphQLQuery\Generator;

require __DIR__ . '/../vendor/autoload.php';

$generator = new Generator();

try {
    $generator->saveTo('QueryParser', __DIR__ . '/../src/QueryParser.php');
    echo 'OK'.PHP_EOL;
    $code = 0;
} catch (Throwable $e) {
    echo $e;
    $code = $e->getCode() ?: 1;
} finally {
    exit($code);
}
