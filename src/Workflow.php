<?php

namespace Kiboko\Component\Workflow;

use Kiboko\Contract\Pipeline\PipelineInterface;
use Kiboko\Contract\Pipeline\RunnableInterface;

class Workflow implements RunnableInterface
{
    /** @var list<PipelineInterface> */
    private array $jobs = [];

    public function job(RunnableInterface $job): self
    {
        $this->jobs[] = $job;

        return $this;
    }

    public function run(): int
    {
        foreach ($this->jobs as $job) {
            $job->run();
        }

        return 0;
    }
}
