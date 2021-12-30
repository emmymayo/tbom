<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Inertia\Inertia;
use Wink\WinkPost;
use Wink\WinkTag;

class PostController extends Controller
{
    public function index(){
        $posts = WinkPost::with('tags','author')
                        ->live()
                        ->when(request('q')!='null', function($query){
                            $query->where('title','LIKE',"%".request('q')."%");
                        })
                        ->orderBy('publish_date','DESC')
                        ->paginate();
       
        return Inertia::render('Blog/Index',[
            'posts'=>$posts,
            'q'=> request('q')
            ]);
    }

    public function tagIndex($slug){
        $tag = WinkTag::firstWhere('slug',$slug);
        $posts = WinkPost::with('tags','author')
                        ->live()
                        ->when(request('q')!='null', function($query){
                            $query->where('title','LIKE',"%".request('q')."%");
                        })
                        ->whereIn('id', function($query) use($tag){
                            $query->select('post_id')
                                    ->from('wink_posts_tags')
                                    ->where('tag_id', $tag->id);
                        })
                        ->orderBy('publish_date','DESC')
                        ->paginate();
       
        return Inertia::render('Blog/TagIndex',[
            'posts'=>$posts,
            'q'=> request('q'),
            'tag' => $tag
            ]);
    }
    public function show($slug){
        
        $post = WinkPost::with('tags','author')->live()->whereSlug($slug)->firstOrFail();
        $latest_posts = WinkPost::with('tags','author')
                        ->live()
                        ->orderBy('publish_date','DESC')
                        ->skip(0)
                        ->take(5)
                        ->get();
        
        return Inertia::render('Blog/SinglePost',[
            'post'=>$post,
            'latest_posts'=>$latest_posts,
            ]);
    }
}
