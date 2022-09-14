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
        Schema::create('moms', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->date('startdate')->nullable();
            $table->date('finishdate')->nullable();
            $table->string('place')->nullable();
            $table->string('subject')->nullable();
            $table->text('minutes')->nullable();
            $table->string('status')->default('verbatim');
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
        Schema::dropIfExists('moms');
    }
};
