<?php

namespace App\Http\Controllers;

use App\Post;
use App\Http\Requests\PostsRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        // $posts = DB::select('select * from posts order by id DESC');

        $posts = Post::orderBy('id','DESC')->paginate(3);
        $data = [
            'posts'=> $posts,
        ];
        return view('posts.index',$data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostsRequest $request)
    {
        //
        $att['title']   = $request->input('title');
        $att['content'] = $request->input('content');
        $att['user_id'] = auth()->user()->id;
        $att['views']   = 0;
        //$att['created_at']   = now();
        //$att['updated_at']   = now();
        // DB::insert('insert into posts (title, content, user_id, views, created_at, updated_at) values (?, ?, ?, ?, ?, ?)', [$att['title'], $att['content'], $att['user_id'], $att['views'],$att['created_at'], $att['updated_at']]);
       
        $post = Post::create($att);

        //處理檔案上傳
        if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach($files as $file){
                $info = [
                    'mime-type' => $file->getMimeType(),
                    'original_filename' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                    'size' => $file->getClientSize(),
                ];
                $file->storeAs('public/posts/'.$post->id, $info['original_filename']);
            }
        }

        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Post $post)
    {
        //
        // $post = DB::select('select * from posts where id=?',[$id]);
        $post_key = 'post'.$post->id;
        if(session($post_key)!=1){
            $att['views'] = $post->views+1;
            $post->update($att);
        }
        session([$post_key=>'1']);

        $files = get_files(storage_path('app/public/posts/'.$post->id));
        
        $data = [
            'post'=> $post,
            'files'=>$files,
        ];
        return view('posts.show',$data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        // $post = DB::select('select * from posts where id=?',[$id]);
        if($post->user_id != auth()->user()->id){
            abort(405,'405');
        }
        $data = [
            'post'=> $post,
        ];
        return view('posts.edit',$data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostsRequest $request, Post $post)
    {
        //
        $att['title']   = $request->input('title');
        $att['content'] = $request->input('content');
        // $post = DB::update('update posts set title = ? , content = ? where id = ?', [$att['title'],$att['content'],$id]);
        $post->update($att);

         //處理檔案上傳
         if ($request->hasFile('files')) {
            $files = $request->file('files');
            foreach($files as $file){
                $info = [
                    'mime-type' => $file->getMimeType(),
                    'original_filename' => $file->getClientOriginalName(),
                    'extension' => $file->getClientOriginalExtension(),
                    'size' => $file->getClientSize(),
                ];
                $file->storeAs('public/posts/'.$post->id, $info['original_filename']);
            }
        }
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
        //DB::delete('delete from posts where id = ?', [$id]);
        $post->delete();
        return redirect()->route('posts.index');

    }
    public function download($id,$filename)
    {
        $file = storage_path('app/public/posts/'.$id."/".$filename);
        return response()->download($file);
    }

}
