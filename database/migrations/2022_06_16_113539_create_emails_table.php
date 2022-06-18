<?php

use App\Models\Message;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('emails', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Message::class)->constrained()->cascadeOnDelete();
            $table->string('subject')->index();
            $table->string('from_email')->index();
            $table->string('from_name')->nullable();
            $table->string('to_email')->index();
            $table->string('to_name')->nullable();
            $table->longText('body')->nullable();
            $table->string('status')->index();
            $table->timestamp('posted_at')->nullable();
            $table->timestamp('sent_at')->nullable();
            $table->timestamp('failed_at')->nullable();
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
        Schema::dropIfExists('emails');
    }
};
