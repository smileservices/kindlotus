<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Tag;
use App\Need;
use App\Cause;

class AdminController extends Controller
{
    public function __construct(){
        $this->middleware('admin');
    }

    public function index(){
        $data = [
            'causesPending' => Cause::pending()->all(),
            'causesInactive' => Cause::inactive()->all()
        ];
        return view('admin.dashboard', $data);
    }

    public function tags(Tag $tags, Need $needs){
        $data = ['tags' => $tags->all(), 'needs' => $needs->all()];
        return view('admin.tags', $data);
    }

    public function storeTag(Request $request) {
        if ($request['type'] == 'tag') {
            $tag = new Tag(['tag' => $request['tag']]);
        } else {
            $tag = new Need(['tag' => $request['tag']]);
        }
        $tag->save();
        return redirect('admin/tags');
    }

    public function deleteTag(Tag $tag){
        $tag->delete();
        return redirect('admin/tags');
    }

    public function deleteNeed(Need $need){
        $need->delete();
        return redirect('admin/tags');
    }

}