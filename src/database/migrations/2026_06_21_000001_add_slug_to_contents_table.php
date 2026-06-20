<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->string('slug')->nullable()->after('title');
        });

        $contents = DB::table('contents')->orderBy('id')->get();
        $usedSlugs = [];

        foreach ($contents as $content) {
            $base = Str::slug($content->title);
            if (empty($base)) {
                $base = 'post-' . $content->id;
            }

            $slug = $base;
            $count = 1;
            while (in_array($slug, $usedSlugs)) {
                $slug = $base . '-' . $count++;
            }

            $usedSlugs[] = $slug;
            DB::table('contents')->where('id', $content->id)->update(['slug' => $slug]);
        }

        Schema::table('contents', function (Blueprint $table) {
            $table->unique('slug');
        });
    }

    public function down(): void
    {
        Schema::table('contents', function (Blueprint $table) {
            $table->dropUnique(['slug']);
            $table->dropColumn('slug');
        });
    }
};
