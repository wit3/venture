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

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddEdgesColumnAndExceptionColumnToWorkflowJobsTable extends Migration
{
    public function up(): void
    {
        Schema::table(config('venture.jobs_table'), function (Blueprint $table): void {
            $table->json('edges')->nullable();
            $table->longText('exception')->nullable();
        });
    }
}
