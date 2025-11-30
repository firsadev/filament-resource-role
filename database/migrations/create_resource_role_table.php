<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->timestamps();
        });
        Schema::create('resources', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->timestamps();
        });
       
        Schema::create('resource_role', function (Blueprint $table) {
            $table->foreignUuid('resource_id')->constrained()->cascadeOnDelete();
            $table->foreignUuid('role_id')->constrained()->cascadeOnDelete();
            $table->boolean('viewAny')->default(false);
            $table->boolean('view')->default(false);
            $table->boolean('create')->default(false);
            $table->boolean('update')->default(false);
            $table->boolean('delete')->default(false);
            $table->boolean('restore')->default(false);
            $table->boolean('forceDelete')->default(false);
        });

        Schema::table('users', function (Blueprint $table) {
            $table->foreignUuid('role_id')->after('password')->nullable()->constrained()->cascadeOnDelete();
        });


    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('roles');
        Schema::dropIfExists('resources');
        Schema::dropIfExists('resource_role');
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign(['role_id']); 
            $table->dropColumn('role_id'); 
        });
    }
};
