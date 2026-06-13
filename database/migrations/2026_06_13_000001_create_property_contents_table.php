<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('property_contents', function (Blueprint \$table) {
            \$table->id();
            \$table->string('hero_badge')->default('For Sale - Owned by William');
            \$table->string('hero_title')->default('Beachfront Condo');
            \$table->string('hero_accent')->default('La Paloma Blanca');
            \$table->string('hero_subtitle')->default('South Jaco, Costa Rica');
            \$table->text('hero_tagline')->nullable();
            \$table->text('details_intro')->nullable();
            \$table->text('details_description')->nullable();
            \$table->text('feature_list')->nullable();
            \$table->text('life_title')->nullable();
            \$table->text('life_text')->nullable();
            \$table->text('life_highlights')->nullable();
            \$table->text('surf_title')->nullable();
            \$table->text('surf_text')->nullable();
            \$table->string('amenities_title')->default('Resort-Style Living');
            \$table->text('amenities_intro')->nullable();
            \$table->string('gallery_title')->default('Photos');
            \$table->text('gallery_intro')->nullable();
            \$table->string('video_title')->default('See the Neighborhood');
            \$table->text('video_intro')->nullable();
            \$table->string('video_1_src')->nullable();
            \$table->string('video_1_label')->nullable();
            \$table->string('video_2_src')->nullable();
            \$table->string('video_2_label')->nullable();
            \$table->text('beach_intro')->nullable();
            \$table->text('beach_text_1')->nullable();
            \$table->text('beach_text_2')->nullable();
            \$table->string('beach_highlights_title')->nullable();
            \$table->text('beach_highlights')->nullable();
            \$table->string('surfing_title')->nullable();
            \$table->text('surfing_text')->nullable();
            \$table->string('sunset_title')->nullable();
            \$table->text('sunset_text')->nullable();
            \$table->string('articles_badge')->default('Why Costa Rica');
            \$table->string('articles_title')->default('Happiest Country in the World');
            \$table->text('articles_intro')->nullable();
            \$table->string('contact_title')->default('Interested in This Property?');
            \$table->text('contact_intro')->nullable();
            \$table->string('contact_email')->default('willishel77@gmail.com');
            \$table->string('contact_phone')->default('+1 845 943 0404');
            \$table->string('contact_whatsapp')->default('+18459430404');
            \$table->string('owner_name')->default('William');
            \$table->string('meta_title')->nullable();
            \$table->text('meta_description')->nullable();
            \$table->boolean('is_active')->default(true);
            \$table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('property_contents');
    }
};
