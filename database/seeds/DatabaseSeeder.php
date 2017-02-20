<?php

use Illuminate\Database\Seeder;
use App\Models\Article;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(ArticleSeeder::class);
    }
}

class ArticleSeeder
    extends Seeder
{
    public function run()
    {
        DB::table('articles')->delete();
        Article::create([
            'title' => 'first test title',
            'slug' => 'first-article',
            'excerpt' => '<p>first test short content</p>',
            'content' => '<p>first full test content</p>',
            'published' => true,
            'published_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        Article::create([
            'title' => 'second test title',
            'slug' => 'second-article',
            'excerpt' => '<p>second test short content</p>',
            'content' => '<p>second full test content</p>',
            'published' => false,
            'published_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);

        Article::create([
            'title' => 'Third test title',
            'slug' => 'third-article',
            'excerpt' => '<p>Third test short content</p>',
            'content' => '<p>Third full test content</p>',
            'published' => false,
            'published_at' => DB::raw('CURRENT_TIMESTAMP'),
        ]);
    }
}
