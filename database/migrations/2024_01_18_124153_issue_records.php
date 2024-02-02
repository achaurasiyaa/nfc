<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('issue_records', function (Blueprint $table) {
            $table->id();
            $table->foreignId('worker_id')->constrained();
            // $table->foreignId('vendor_id')->constrained();
            $table->date('issue_date');
            $table->foreignId('nfc_tag_id')->constrained('item_nfc_rel', 'id');
            $table->boolean('is_expired')->default(false);
            $table->date('expire_date')->nullable();
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
        Schema::dropIfExists('issue_records');
    }
};
