<?php

namespace Kiboko\Component\Workflow;

use Kiboko\Contract\Pipeline\PipelineInterface;

class Workflow implements RunnableInterface
{
    private iterable $pipelines;

    public function __construct(
        PipelineInterface ...$pipelines
    ) {
        $this->pipelines = $pipelines;
    }

    public function run(): void
    {
        foreach ($this->pipelines as $pipeline) {
            $pipeline->run();
        }
    }
}
