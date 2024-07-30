<?php

namespace App\Migrations;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BaseMigration extends Migration
{
    public function addDefaultFields($tableName)
    {
        Schema::table($tableName, function (Blueprint $table) {
            $table->id()->first();
            $table->string('uuid', 50)->nullable()->index()->unique()->after('id');
            $table->integer('created_by')->nullable()->index();
            $table->integer('updated_by')->nullable()->index();
            $table->integer('deleted_by')->nullable()->index();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function removeDefaultFields($tableName)
    {
        Schema::table($tableName, function (Blueprint $table) {
            $table->dropColumn('id');
            $table->dropColumn('uuid');
            $table->dropColumn('created_by');
            $table->dropColumn('updated_by');
            $table->dropColumn('deleted_by');
            $table->dropTimestamps();
            $table->dropSoftDeletes();
        });
    }
}
