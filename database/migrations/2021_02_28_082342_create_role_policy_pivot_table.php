<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolePolicyPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_policy', function (Blueprint $table) {
            $table->id();
            $table->foreignId('role_id')->constrained('roles')->onDelete('cascade');
            $table->foreignId('policy_id')->constrained('policies')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('role_policy', function (Blueprint $table) {
            $table->dropForeign(['role_id','policy_id']);
        });
        Schema::dropIfExists('role_policy');
    }
}
