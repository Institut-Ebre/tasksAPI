<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
//        1. All is bad
//        2. No way to attach metadata
//        3. Linking database structure to the api output
//        4. No way to signal headers/response codes

        $tags = Tag::all();

        return Response::json(
            $this->transform($tags),
            200
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag = new Tag();

        $this->saveTag($request, $tag);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //return Tag::findOrFail($id);
        //$tag = Tag::where('id',$id)->first();

        // 2. No way to attach metadata SOLVED:
        $tag = Tag::find($id);

        if ( !$tag ) {
            Response::json([
                    'error' => 'Tag does not exists'
                ],
                404
            );
        }

        return Response::json(
            $tag->toArray(),
            200
        );

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

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
        $tag = Tag::findOrFail($id);

        $this->saveTag($request, $tag);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Tag::destroy($id);
    }

    /**
     * @param Request $request
     * @param $tag
     */
    protected function saveTag(Request $request, $tag)
    {
        $tag->name = $request->name;
        $tag->save();
    }

    private function transform($tags)
    {
        return array_map(function($tag){
                return [
                    //'id'    => $tag['id'],
                    'title' => $tag['name']
                ];
            },
            $tags->toArray()
        );
//        $result = array();
//        foreach ($tags as $tagbd) {
//            $tag = array();
//
//            $tag['title'] =  $tagbd['title'];
//            $tag['body'] =  $tagbd['body'];
//
//            $result[]= tag;
//        }
//        return $result;
    }
}
