<?php

namespace App\Observers;

use App\Models\Blog;
use App\Models\Record;
use Illuminate\Support\Facades\Storage;
use Auth;

class BlogObserver {

    /**
     * Handle the Blog "created" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function created(Blog $blog) {
        Record::create([
            'modifier' => Auth::user()->name,
            'type' => 'Blog',
            'modificated' => 'Se creo un blog',
            'description' => 'Se creo el blog **' . $blog->title . '**'
        ]);
    }

    /**
     * Handle the Blog "updated" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function updating(Blog $new_blog) {
        $old_blogs = Blog::all()->where('id', $new_blog->id);
        foreach($old_blogs as $old_blog){
            if($old_blog->title != $new_blog->title) {
                Record::create([
                    'modifier' => Auth::user()->name,
                    'type' => 'Blog',
                    'modificated' => 'Se modificó el titulo',
                    'description' => 'Se modificó de **' .  $old_blog->title . '** a **' . $new_blog->title . '**'
                ]);
            }
            if($old_blog->body != $new_blog->body) {
                Record::create([
                    'modifier' => Auth::user()->name,
                    'type' => 'Blog',
                    'modificated' => 'Se modificó el contenido',
                    'description' => 'Se modificó de **' .  $old_blog->body . '** a **' . $new_blog->body . '**'
                ]);
            }
            if($old_blog->category_id != $new_blog->category_id) {
                Record::create([
                    'modifier' => Auth::user()->name,
                    'type' => 'Blog',
                    'modificated' => 'Se modificó la categoría',
                    'description' => 'Se modificó de **' .  $old_blog->category->type_category . '** a **' . $new_blog->category->type_category . '**'
                ]);
            }
            if($old_blog->status_id != $new_blog->status_id) {
                Record::create([
                    'modifier' => Auth::user()->name,
                    'type' => 'Blog',
                    'modificated' => 'Se modificó el estado',
                    'description' => 'Se modificó de **' .  $old_blog->status->status . '** a **' . $new_blog->status->status . '**'
                ]);
            }
            if($old_blog->blog_type_id != $new_blog->blog_type_id) {
                Record::create([
                    'modifier' => Auth::user()->name,
                    'type' => 'Blog',
                    'modificated' => 'Se modificó el tipo de blog',
                    'description' => 'Se modificó de **' .  $old_blog->blog_type->type . '** a **' . $new_blog->blog_type->type . '**'
                ]);
            }    
        }  
    }

    /**
     * Handle the Blog "deleted" event.
     *
     * @param  \App\Models\Blog  $blog
     * @return void
     */
    public function deleting(Blog $blog) {
        if($blog->image){
            Storage::delete($blog->image->url);
        }
    }

}
