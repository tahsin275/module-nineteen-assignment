## Assignment Module 19

### \Name- Tahsin Shahriar

# Demo SQL Data

[Click here to view the SQL code](/sample_db.sql)

# Routes

-   `Route::get('/', function () { return view('blogpostlist'); });`

This route is the homepage of the application. When you visit the root URL (/), it returns a view called blogpostlist, which is assumed to display a list of blog posts.

-   `Route::get('/details', function () { return view('detailspost'); });`

This route is intended to display more detailed information about a blog post. When you visit the URL /details, it returns a view called detailspost, which likely includes more detailed content of a specific blog post.

-   `Route::get('/blogposts', [BlogPostController::class, 'index']);`

This route returns a list of all blog posts in `JSON` format. It does this by invoking the index method of the `BlogPostController` class.

-   `Route::get('/blogposts/{id}', [BlogPostController::class, 'show']);`

This route returns the data of a specific blog post in JSON format based on its ID. It does this by invoking the show method of the BlogPostController class.

-   `Route::post('/storepost', [BlogPostController::class, 'store']);`

This route is used to create a new blog post. The store method of the BlogPostController class handles the logic of storing a new post.

-   `Route::put('/updateposts/{id}', [BlogPostController::class, 'update']);`

This route is used to update the information of an existing blog post based on its ID. The update method of the BlogPostController class handles the logic of updating the post.

-   `Route::delete('/deleteposts/{id}', [BlogPostController::class, 'delete']);`

This route is used to delete an existing blog post based on its ID. The delete method of the BlogPostController class handles the logic of deleting the post.

-   `Route::post('/blogposts/{id}/comments', [BlogPostController::class, 'addComment']);`

This route is used to add a comment to a specific blog post based on its ID. The addComment method of the BlogPostController class handles the logic of adding a new comment to a post.

-   `Route::get('/getComment/{id}', [BlogPostController::class, 'getCommentbyId']);`

This route returns the comments of a specific blog post based on its ID in JSON format. It does this by invoking the getCommentbyId method of the BlogPostController class.

Remember to adjust the explanations as per the actual behavior of your routes and controller methods.

# Migration & Model

## Blog Post

````php
/**
    * Run the migrations.
    */
   public function up()
   {
       Schema::create('blogposts', function (Blueprint $table) {
           $table->id();
           $table->string('title');
           $table->text('content');
           $table->string('image_url')->nullable();
           $table->timestamp('created_at')->useCurrent();
           $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
       });
   }


   /**
    * Reverse the migrations.
    */
   public function down(): void
   {
       Schema::dropIfExists('blog_posts');
   }

   ```

   and here is the model

   ```
   PHP

   <?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlogPost extends Model
{
   use HasFactory;
   /**
    * The table associated with the model.
    *
    * @var string
    */
   protected $table = 'blogposts';

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
   protected $fillable = [
       'title',
       'content',
       'image_url',
   ];


   public function comments()
   {
       return $this->hasMany(Comment::class, 'blogpost_id');
   }
}


## Comments

```
PHP
return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('blogpost_id')->constrained()->onDelete('cascade');
            $table->text('content');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent()->useCurrentOnUpdate();
        });
    }


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('comments');
    }
};

```

and the comment model

```
PHP
<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'comments';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['content', 'blogpost_id'];

    public function blogpost()
    {
        return $this->belongsTo(BlogPost::class, 'blogpost_id');
    }
}

```
````
