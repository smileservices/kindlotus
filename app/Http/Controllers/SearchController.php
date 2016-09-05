<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cause;
use App\Tag;
use App\Need;

class SearchController extends Controller
{
    protected $causes=[];
    protected $data = [];

    public function __construct() {
        $this->data = [
            'tags' => Tag::allUsed(),
            'needs' => Need::allUsed()
        ];
    }

    public function tags(Tag $tag)
    {
        $this->causes = $tag->causes()->active();
        $this->data['causes'] = $this->causes;
        return view('search.results', $this->data);
    }

    public function needs(Need $need)
    {
        $this->causes = $need->causes()->active();
        $this->data['causes'] = $this->causes;
        return view('search.results', $this->data);
    }

    public function causes(Request $request)
    {
        $tags = $request['tags'];
        /* turn to integer values */
        $needs = array_map(function($val) {
            return (int)$val;
        }, $request['needs']);

        if ($tags) {
            foreach ($tags as $tagValue) {
                $tag = Tag::find($tagValue);
                $tag->causes()->active()->each(function($cause) use($needs) {
                    if (in_array($cause, $this->causes)){
                        return false;
                    } elseif ( count($cause->needs->whereIn('id', $needs)) > 0 ) {
                        $this->causes[$cause->id] = $cause;
                    }
                });
            }
        }
        $this->data['causes'] = $this->causes;
        return view('search.results', $this->data);
    }
}
