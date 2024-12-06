<?php

declare(strict_types=1);

namespace Kiboko\Component\Workflow;

use Kiboko\Contract\Pipeline\JobCodeInterface;
use Kiboko\Contract\Satellite\CodeInterface;

final class JobCode implements JobCodeInterface, CodeInterface
{
    private function __construct(
        private string $reference,
    ) {}

    public static function fromString(string $reference): self
    {
        return new self($reference);
    }

    public function __toString(): string
    {
        return $this->reference;
    }
}
