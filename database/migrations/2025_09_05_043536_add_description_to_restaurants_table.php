<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            // short text used on cards
            $table->string('description', 255)->nullable()->after('image');
            // if you also want a long version, uncomment next line:
            // $table->longText('big_description')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropColumn('description'); // add 'big_description' here too if you added it
        });
    }
};

