<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Enums\JustificationStatusEnum;

class CreateJustificationsTable extends Migration
{
    public function up()
    {
        Schema::create('justifications', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('attendance_id');
            $table->bigInteger('user_id');
            $table->text('reason');
            $table->enum('status',JustificationStatusEnum::getValues())->default(JustificationStatusEnum::WAITING);
            $table->text('response')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('justifications');
    }
}
