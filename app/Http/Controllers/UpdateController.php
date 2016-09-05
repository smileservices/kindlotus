<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;
use Gate;

use App\Http\Requests;
use App\Update;
use App\Media;
use App\Cause;

class UpdateController extends Controller
{
    public function delete(Request $request, Update $update)
    {
        $user = Auth::user();
        if ($user == null) {
            $user = Auth::guard('ngo')->user();
        } elseif ($user == null) {
            $user = Auth::guard('admin')->user();
        }
        if (Gate::forUser($user)->allows('delete', $update)) {
            $update->destroySelf();
            return redirect()->back();
        } else abort(403, 'Nu aveti permisiunea sa stergeti acest update');
    }

    public function active(Request $request, Update $update)
    {
        $active = 1;
        if ($update->isActive()) $active = 0;
        $update->setActive($active);
        return redirect()->back();
    }

    public function deleteMedia(Request $request, Cause $cause, Media $media)
    {
        Media::deleteMedia($cause, $media);
        return redirect()->back();
    }

    public function report(Request $request, Update $update)
    {
        return 'reported';
    }
}
