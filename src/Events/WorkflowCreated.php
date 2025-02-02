<?php

declare(strict_types=1);

/**
 * Copyright (c) 2022 Kai Sassnowski
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ksassnowski/venture
 */

namespace Sassnowski\Venture\Events;

use Sassnowski\Venture\Models\Workflow;
use Sassnowski\Venture\WorkflowDefinition;

final class WorkflowCreated
{
    public function __construct(
        public WorkflowDefinition $definition,
        public Workflow $model,
    ) {
    }
}
