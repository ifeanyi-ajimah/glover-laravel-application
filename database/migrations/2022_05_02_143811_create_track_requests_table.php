<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrackRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('track_requests', function (Blueprint $table) {
            $table->id();
            $table->string('request_type');
            $table->boolean('status')->default(false);
            $table->foreignId('user_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->foreignId('creator_id')->constrained('users')->onUpdate('cascade')->onDelete('cascade')->nullable();
            $table->json('request_data');
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
        Schema::dropIfExists('track_requests');
    }
}
