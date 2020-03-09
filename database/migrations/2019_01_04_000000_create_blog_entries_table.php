<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBlogEntriesTable extends Migration
{
    /**
     * Name of the Eloquent blog entry model table
     * @var string
     */

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('blog_entries', function (Blueprint $table) {
            $table->increments('id');
            $table->string('blog')->default('main');
            $table->timestamp('publish_after')->nullable();
            $table->string('slug');
            $table->string('title');
            $table->string('author_name')->nullable();
            $table->string('author_email')->nullable();
            $table->string('author_url')->nullable();
            $table->text('image')->nullable();
            $table->text('content');
            $table->text('summary')->nullable();
            $table->string('page_title')->nullable();
            $table->string('description')->nullable();
            $table->text('meta_tags')->nullable();
            $table->tinyInteger('display_full_content_in_feed')->nullable();
            $table->timestamps();

            $table->unique(['slug', 'blog'], 'slug');
            $table->index(['publish_after', 'blog', 'slug'], 'public');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('blog_entries');
    }
}
