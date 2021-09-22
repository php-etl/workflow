<?php

namespace Kiboko\Component\Workflow;

use Kiboko\Contract\Pipeline\SchedulingInterface;
use Kiboko\Contract\Pipeline\RunnableInterface;
use Kiboko\Contract\Pipeline\WalkableInterface;

class Workflow implements SchedulingInterface, RunnableInterface, WalkableInterface
{
    /** @var list<RunnableInterface> */
    private array $jobs = [];

    public function job(RunnableInterface $job): self
    {
        $this->jobs[] = $job;

        return $this;
    }

    public function run(): int
    {
        $count = 0;
        foreach ($this->jobs as $job) {
            $count = $job->run();
        }

        return $count;
    }

    /** @return \Iterator<RunnableInterface> */
    public function walk(): \Iterator
    {
        foreach ($this->jobs as $job) {
            yield $job;
        }
    }
}
