<?php

namespace Kiboko\Component\Workflow;

use Kiboko\Contract\Pipeline\WalkableInterface;
use Kiboko\Contract\Satellite\CodeInterface;
use Kiboko\Contract\Satellite\RunnableInterface;
use Kiboko\Contract\Satellite\SchedulingInterface;

class Workflow implements SchedulingInterface, RunnableInterface, WalkableInterface
{
    /** @var list<RunnableInterface> */
    private array $jobs = [];

    public function job(CodeInterface $job, RunnableInterface $runnable): self
    {
        $this->jobs[] = $runnable;

        return $this;
    }

    public function run(int $interval = 1000): int
    {
        $count = 0;
        foreach ($this->jobs as $runnable) {
            $count = $runnable->run($interval);
        }

        return $count;
    }

    /** @return \Iterator<RunnableInterface> */
    public function walk(): \Iterator
    {
        foreach ($this->jobs as $runnable) {
            yield $runnable;
        }
    }
}
