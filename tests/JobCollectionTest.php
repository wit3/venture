<?php

declare(strict_types=1);

/**
 * Copyright (c) 2021 Kai Sassnowski
 *
 * For the full copyright and license information, please view
 * the LICENSE file that was distributed with this source code.
 *
 * @see https://github.com/ksassnowski/venture
 */

use Sassnowski\Venture\Exceptions\DuplicateJobException;
use Sassnowski\Venture\Workflow\JobCollection;
use Sassnowski\Venture\Workflow\JobDefinition;
use Sassnowski\Venture\Workflow\WorkflowStep;

it('can find job definitions by their id', function (): void {
    $definition1 = new JobDefinition('::id-1::', '::name-1::', new class() extends WorkflowStep {
    });
    $definition2 = new JobDefinition('::id-2::', '::name-2::', new class() extends WorkflowStep {
    });
    $collection = new JobCollection($definition1, $definition2);

    expect($collection)->find('::id-1::')->toBe($definition1);
    expect($collection)->find('::id-2::')->toBe($definition2);
});

it('returns null if no definition exists for the given id', function (JobCollection $collection): void {
    expect($collection)->find('::id::')->toBeNull();
})->with([
    'empty collection' => [
        new JobCollection(),
    ],
    'collection with definition with different id' => [
        new JobCollection(
            new JobDefinition('::other-id::', '::other-name::', new class() extends WorkflowStep {
            }),
        ),
    ],
]);

it('can add new definitions', function (): void {
    $collection = new JobCollection();

    $definition = new JobDefinition('::id::', '::name::', new class() extends WorkflowStep {
    });
    $collection->add($definition);

    expect($collection)->find('::id::')->toBe($definition);
});

it('is countable', function (): void {
    $collection = new JobCollection();
    expect($collection)->toHaveCount(0);

    $collection->add(
        new JobDefinition('::id-1::', '::name-1::', new class() extends WorkflowStep {
        }),
    );
    expect($collection)->toHaveCount(1);

    $collection->add(
        new JobDefinition('::id-2::', '::name-2::', new class() extends WorkflowStep {
        }),
    );
    expect($collection)->toHaveCount(2);
});

it('is empty by default', function (): void {
    expect(new JobCollection())->toBeEmpty();
});

it('can be iterated over', function (): void {
    $definitions = [
        '::id-1::' => new JobDefinition('::id-1::', '::name-1::', new class() extends WorkflowStep {
        }),
        '::id-2::' => new JobDefinition('::id-2::', '::name-2::', new class() extends WorkflowStep {
        }),
        '::id-3::' => new JobDefinition('::id-3::', '::name-3::', new class() extends WorkflowStep {
        }),
    ];
    $collection = new JobCollection(...$definitions);

    foreach ($collection as $id => $jobDefinition) {
        expect($jobDefinition)->toBe($definitions[$id]);
        unset($definitions[$id]);
    }

    expect($definitions)->toBeEmpty();
});

it('throws an exception if a job definition with the same id already exists', function (): void {
    $definition = new JobDefinition('::id::', '::name::', new class() extends WorkflowStep {
    });
    $collection = new JobCollection($definition);

    $collection->add($definition);
})->throws(DuplicateJobException::class);