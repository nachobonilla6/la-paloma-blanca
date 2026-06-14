<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('property_contents', function (Blueprint $table) {
            $table->string('details_badge', 255)->default('The Property')->after('details_image');
            $table->string('details_title', 255)->default('Beachfront Condo for Sale')->after('details_badge');
        });
    }

    public function down(): void
    {
        Schema::table('property_contents', function (Blueprint $table) {
            $table->dropColumn(['details_badge', 'details_title']);
        });
    }
};
