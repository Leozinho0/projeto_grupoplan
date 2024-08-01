<?php

use App\Migrations\BaseMigration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrainingsTable extends BaseMigration
{
    public function up(): void
    {
        Schema::create('trainings', function (Blueprint $table) {
            $table->string('name');
            $table->text('description')->nullable();
        });

        $this->addDefaultFields('trainings');
    }

    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
}
