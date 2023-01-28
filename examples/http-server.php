#!/usr/bin/env php
<?php

declare(strict_types=1);

include './vendor/autoload.php';

use Swoole\Http\Server;
use Swoole\Http\Request;
use Swoole\Http\Response;
use Skazochnik97\SwoolePrometheusExporter\PrometheusExporter;

$server = new Swoole\HTTP\Server("127.0.0.1", 9501);
$registry = new PrometheusExporter($server);

$server->on("Start", function(Server $server)
{
    echo "Swoole http server is started at http://127.0.0.1:9501\n";
});

$server->on("Request", function(Request $request, Response $response) use ($registry)
{
    $response->header("Content-Type", "text/plain");
    $response->end("Hello World\n".print_r($registry->render(), true));
});

$server->start();
