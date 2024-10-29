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
        Schema::create('banners', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('image');
            $table->timestamps();
        });
        /* Sắp diễn ra */
        Schema::create('upcomings', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image');
            $table->string('location')->nullable();
            $table->string('time')->nullable();
            $table->timestamps();
        });

        /* mô tả chung ở giữa */
        Schema::create('general_descriptions', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });

        /* Thực đơn */

        Schema::create('menus', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image');
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->boolean('turn_off')->default(false);
            $table->integer('numerical_order')->nullable();
            $table->timestamps();
        });

        /* Tiện ích */

        Schema::create('utilities', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image');
            $table->text('description')->nullable();
            $table->string('link')->nullable();
            $table->integer('numerical_order')->nullable();
            $table->timestamps();
        });

        /* Bộ sưu tap */

        Schema::create('collections', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->string('image');
            $table->integer('location')->nullable();
            $table->string('link')->nullable();
            $table->timestamps();
        });

        Schema::create('synthetics', function (Blueprint $table) {
            $table->id();
            $table->string('hottline')->nullable();
            $table->string('switchboard')->nullable();
            $table->string('email')->nullable();
            $table->string('address')->nullable();
            $table->string('logo')->nullable();
            $table->string('operating_time')->nullable();
            $table->string('link_face')->nullable();
            $table->string('link_youtobe')->nullable();
            $table->string('link_tiktok')->nullable();
            $table->string('link_reservations')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('banners');
        Schema::dropIfExists('upcomings');
        Schema::dropIfExists('general_descriptions');
        Schema::dropIfExists('menus');
        Schema::dropIfExists('utilities');
        Schema::dropIfExists('collections');
        Schema::dropIfExists('synthetics');
    }
};
