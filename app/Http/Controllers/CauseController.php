<?php

namespace App\Http\Controllers;

use App\Http\Requests\EditCauseRequest;
use App\Http\Requests\ReceiveCauseUpdates;
use Illuminate\Http\Request;

use Auth;
use Gate;
use File;
use App\Cause;
use App\Update;
use App\Media;
use App\Tag;
use App\Need;
use App\Map;
use GeoIP;


class CauseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Cause $causes)
    {
        $data['causes'] = $causes->where('active', 1)->get();
        return view('cause.all', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Tag $tags, Need $needs)
    {
        $data = [
            'tags' => $tags->all(),
            'needs' => $needs->all(),
            'location' => GeoIP::getLocation()
        ];
        return view('cause.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $cause = new Cause([
            'name' => $request['name'],
            'story' => $request['story'],
            'description' => $request['description'],
            'contact' => $request['contact'],
            'active' => 0,
            'success' => 0
        ]);
        $cause->ngo()->associate(Auth::guard('ngo')->id());
        $cause->save();

        $cause->needs()->attach($request['needs']);
        $cause->tags()->attach($request['tags']);

        $map = new Map([
            'coordsX' => $request['lat'],
            'coordsY' => $request['lng'],
            'cause_id' => $cause->id
        ]);
        $map->save();


        return redirect('causes/'.$cause->id.'/edit');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Cause $cause)
    {
        // set up the updater (user or ngo)
        $canUpdate = false;
        $loggedUser = null;

        if (Gate::allows('update', $cause)) {
            $loggedUser = Auth::user();
            $canUpdate = 'user';
        } elseif ( Gate::forUser(Auth::guard('ngo')->user())->allows('update', $cause) ) {
            $canUpdate = 'ngo';
            $loggedUser = Auth::guard('ngo')->user();
        }
        if (Auth::guard('admin')->check()) $loggedUser = Auth::guard('admin')->user();

        $data['cause'] = $cause;
        $data['helpers'] = $cause->users;
        $data['updates'] = $cause->updates;
        $data['canUpdate'] = $canUpdate;
        $data['tags'] = Tag::allUsed();
        $data['needs'] = Need::allUsed();
        $data['images'] = $cause->media()->image();
        $data['videos'] = $cause->media()->video();
        $data['loggedUser'] = $loggedUser;
        if (!$cause->isApproved()) abort('404');

        return view('cause.show', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(EditCauseRequest $request, Cause $cause, Tag $tags, Need $needs)
    {
        $data = [
            'cause' => $cause,
            'tags' => $tags->all(),
            'needs' => $needs->all(),
        ];

        return view('cause.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditCauseRequest $request, Cause $cause)
    {
        if ($request['submit'] == 'text_update') {
            $cause->name = $request['name'];
            $cause->story = $request['story'];
            $cause->description = $request['description'];
            $cause->contact = $request['contact'];
            $cause->save();
            $cause->tags()->sync($request['tags']);
            $cause->needs()->sync($request['needs']);
            if ($request['lat'] && $request['lng']) {
                $map = $cause->map;
                $map->coordsX = $request['lat'];
                $map->coordsY = $request['lng'];
                $map->save();
            }
        } elseif ($request['submit'] == 'media_upload'){
            if ($request['images'][0]) {
                Media::addImages($cause, null, $request['images']);
            }
            if ($request['video']) {
                Media::addVideo($cause, $request['video']);
            }
        }
        return redirect('causes/'.$cause->id.'/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(EditCauseRequest $request, Cause $cause)
    {
        File::deleteDirectory(public_path('assets/causes/cause'.$cause->id));
        Media::deleteMedia($cause);
        $cause->delete();
        return redirect('/ngo');
    }

    public function destroyMedia(EditCauseRequest $request, Cause $cause, Media $media)
    {
        Media::deleteMedia($cause, $media);
        return redirect('/causes/'.$cause->id.'/edit');
    }

    public function receiveUpdates(ReceiveCauseUpdates $request, Cause $cause)
    {
        $user = Auth::user();

        if ($user == null) {
            $user = Auth::guard('ngo')->user();
        }

        if (Gate::forUser($user)->denies('receiveUpdates', $cause)) abort('403', 'Nu aveti permisiunea sa adaugati updateuri');

        $update = new Update([
            'title'   => $request['title'],
            'content' => $request['content'],
            'active'  => 1,
        ]);
        $update->cause()->associate($cause);
        $user->updates()->save($update);
        if ($request['images'][0]) {
            Media::addImages($cause, $update, $request['images']);
        }
        if ($request['video'] != null) {
            Media::addVideo($update, $request['video']);
        }
        return redirect('causes/'.$cause->id);
    }

    /*
     * A request for the cause to be approved by tha Admin
     * */
    public function active(EditCauseRequest $request, Cause $cause)
    {
        $active = $request['active'];
        $cause->setActive($active);
        return redirect('causes/'.$cause->id.'/edit');
    }

    public function success(EditCauseRequest $request, Cause $cause)
    {
        $success = $request['success'];
        $cause->setSuccess($success);
        return redirect('causes/'.$cause->id);
    }


}
