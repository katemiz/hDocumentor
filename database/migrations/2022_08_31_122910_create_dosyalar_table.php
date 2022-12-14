<?php

use App\Models\ActionItem;
use App\Models\Company;
use App\Models\Letter;
use App\Models\Mom;
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
        Schema::create('dosyalar', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Letter::class)->nullable();
            $table->foreignIdFor(Company::class)->nullable();
            $table->foreignIdFor(Mom::class)->nullable();
            $table->foreignIdFor(ActionItem::class)->nullable();
            $table->string('filename');
            $table->string('stored_as');
            $table->integer('size');
            $table->string('mimetype');
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
        Schema::dropIfExists('dosyalar');
    }
};
