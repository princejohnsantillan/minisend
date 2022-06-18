<?php

use App\Models\Attachment;
use App\Models\Email;
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
        Schema::create('email_attachments', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Email::class)->index()->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Attachment::class)->index()->constrained()->cascadeOnDelete();
            $table->timestamps();

            $table->unique(['email_id', 'attachment_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('email_attachments');
    }
};
