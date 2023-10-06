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
        Schema::create('proxy_ips', function (Blueprint $table) {
            $table->id();
            $table->foreignId('loader_id')->index()->constrained('loaders');
            $table->string('ip');
            $table->string('real_ip');
            $table->string('port');
            $table->unsignedSmallInteger('type')->default(1);
            $table->string('city');
            $table->string('country');
            $table->string('speed');
            $table->boolean('is_active')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('proxy_ips');
    }
};
