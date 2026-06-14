<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('property_contents', function (Blueprint $table) {
            $table->string('details_image', 500)->nullable()->after('details_description');
        });
    }

    public function down(): void
    {
        Schema::table('property_contents', function (Blueprint $table) {
            $table->dropColumn('details_image');
        });
    }
};
