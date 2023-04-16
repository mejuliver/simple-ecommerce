<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Page;

class PageController extends Controller
{
    public function index(string $slug){
    }

    public function show(string $slug){
        $page = Page::where('slug',$page);

        return view('page.index',compact('page'));
    }

    public function create(Page $page, Request $request){
        $request->validate([
            'title' => 'string|max:200',
            'primary_image' => 'nullable|required|image|mimes:jpeg,png,jpg|max:2048',
            'banner_image' => 'nullable|required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $page = $page->create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'slug' => $request->title,
            'content' => $request->content
        ]);

        if( $request->hasFile('primary_image') ){
            $imageName = (strtolower(str_replace(' ','_',$request->title))).'-primary-'.time().'.'.$request->image->extension();  
            $request->image->move(public_path('upload/media'), $imageName);

            $page->metas()->create([ 'name' => 'primary', 'type' => 'image', 'content', 'upload/media/'.$imageName ]);
        }

        if( $request->hasFile('banner_image') ){
            $imageName = (strtolower(str_replace(' ','_',$request->title))).'-banner-'.time().'.'.$request->image->extension();  
            $request->image->move(public_path('upload/media'), $imageName);

            $page->metas()->create([ 'name' => 'banner', 'type' => 'image', 'content', 'upload/media/'.$imageName ]);
        }

        return response()->json([ 'success' => true, 'message' => 'Successfully created' ],200);
    }

    public function update(Page $page, Request $request){
        $request->validate([
            'title' => 'string|max:200',
            'primary_image' => 'nullable|required|image|mimes:jpeg,png,jpg|max:2048',
            'banner_image' => 'nullable|required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $page = $page->update([
            'title' => $request->title,
            'slug' => $request->title,
            'content' => $request->content
        ]);

        if( $request->hasFile('primary_image') ){
            $imageName = (strtolower(str_replace(' ','_',$request->title))).'-primary-'.time().'.'.$request->image->extension();  
            $request->image->move(public_path('upload/media'), $imageName);

            $page->metas()->create([ 'name' => 'primary', 'type' => 'image', 'content', 'upload/media/'.$imageName ]);
        }

        if( $request->hasFile('banner_image') ){
            $imageName = (strtolower(str_replace(' ','_',$request->title))).'-banner-'.time().'.'.$request->image->extension();  
            $request->image->move(public_path('upload/media'), $imageName);

            $page->metas()->create([ 'name' => 'banner', 'type' => 'image', 'content', 'upload/media/'.$imageName ]);
        }

        return response()->json([ 'success' => true, 'message' => 'Successfully updated' ],200);
    }

    public function create(Page $page, Request $request){
        $page->delete();

        return response()->json([ 'success' => true, 'message' => 'Successfully deleted' ],200);
    }
}
