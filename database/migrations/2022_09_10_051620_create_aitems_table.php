<?php

use App\Models\Mom;
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
        Schema::create('aitems', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Mom::class)->nullable();
            $table->text('description')->nullable();
            $table->date('duedate')->nullable();
            $table->string('resp_company')->nullable();
            $table->string('resp_person')->nullable();
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
        Schema::dropIfExists('aitems');
    }
};
