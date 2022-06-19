<?php

use App\Models\User;
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
            $table->foreignIdFor(User::class)->constrained()->cascadeOnDelete();
            $table->string('subject')->index();
            $table->string('from_email')->index();
            $table->string('from_name')->nullable()->index();
            $table->string('to_email')->index();
            $table->string('to_name')->nullable()->index();
            $table->longText('text')->nullable();
            $table->longText('html')->nullable();
            $table->string('status')->index();
            $table->text('failure_reason')->nullable();
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
