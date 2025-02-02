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

use Sassnowski\Venture\WorkflowDefinition;

final class WorkflowAdding
{
    public function __construct(
        public WorkflowDefinition $parentDefinition,
        public WorkflowDefinition $nestedDefinition,
        public string $workflowID,
    ) {
    }
}
