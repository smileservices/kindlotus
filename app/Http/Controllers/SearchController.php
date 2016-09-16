<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Cause;
use App\Tag;
use App\Need;
use App\Map;
use GeoIP;

class SearchController extends Controller
{
    protected $causes=[];
    protected $data = [];

    public function __construct() {
        $userArea = GeoIP::getLocation()['state'];
        $this->data = [
            'tags' => Tag::allUsed(),
            'needs' => Need::allUsed(),
            'area' => Map::allAreaUsed(),
            'userArea' => $userArea,
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

    protected function inArea($query, $area){
        if ($area != 'all') {
            $query = $query->join('maps', 'causes.id', '=', 'maps.cause_id')
                ->where('maps.area', $area)
                ->get();
        }
        return $query;

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
                $searchQuery = $tag->causes()
                                    ->where('causes.active', '=', 2)
                                    ->where('success', 0);
                $searchQuery = $this->inArea($searchQuery, $request['area']);
                $searchQuery->each(function($cause) use($needs) {
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
