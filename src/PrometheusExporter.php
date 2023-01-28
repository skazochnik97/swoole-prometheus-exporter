<?php

namespace Skazochnik97\SwoolePrometheusExporter;

use Swoole\Http\Server;

class PrometheusExporter
{
    const MIME_TYPE = 'text/plain; version=0.0.4';

    const METADATA = <<<EOF
# HELP %s %s
# TYPE %1\$s %s
EOF;

    /**
     * @var Swoole\HTTP\Server
     */
    private $server;

    /**
     * Constructor.
     *
     * @param Swoole\HTTP\Server    $server
     */
    public function __construct($server)
    {
        $this->server = $server;
    }

    /**
     * Renders the samples in the Prometheus text format.
     *
     * @see https://prometheus.io/docs/instrumenting/exposition_formats/
     * 
     * @return string
     */
    public function render()
    {
        return $this->server->stats();
    }
}