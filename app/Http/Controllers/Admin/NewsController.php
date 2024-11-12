<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\News;
use App\Models\NewsCategory;
use Illuminate\Http\Request;

class NewsController extends Controller
{

    public function index()
    {
        $news = News::latest()->paginate();
        return view('admin.news.index',compact('news'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = NewsCategory::get();
        return view('admin.news.create-edit',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'string|required',
            'description' => 'string|required',
            'image' => 'sometimes|mimes:jpg,jpeg,png,gif|max:2048',
            'news_category_id' => 'required'
        ]);
        if($image = $request->file('image')){
            $validated['image'] = 'storage/'.$image->store('images/news',['disk' => 'public']);
        }
        News::create($validated);
        return redirect()->route('news.index')->with('success','Data berhasil disimpan');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $news = News::find($id);
        $categories = NewsCategory::get();
        return view('admin.news.create-edit',compact(
            'news',
            'categories'
        ));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'string|required',
            'description' => 'string|required',
            'image' => 'sometimes|mimes:jpg,jpeg,png,gif|max:2048',
            'news_category_id' => 'required'
        ]);

        $news = News::find($id);
        if($image = $request->file('image')){
            $validated['image'] = 'storage/'.$image->store('images/news',['disk' => 'public']);
            if(file_exists($news->image)){
                unlink($news->image);
            }
        }
        $news->update($validated);
        return redirect()->route('news.index')->with('success','Data berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        News::destroy($id);
        return redirect()->route('news.index')->with('success','Data berhasil dihapus');
    }
}
