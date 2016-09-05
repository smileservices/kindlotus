<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Requests\EditNgoRequest;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

use App\Ngo;

class NgoController extends Controller
{
    protected $currentNgo;

    public function index()
    {
        $this->currentNgo = Auth::guard('ngo')->user();
        $data['ngos'] = Ngo::all();
        return view('ngo.list', $data);
    }

    public function dashboard()
    {
        $this->currentNgo = Auth::guard('ngo')->user();
        $data['causes'] = $this->currentNgo->causes;
        return view('ngo.dashboard', $data);
    }

    public function profile(Ngo $ngo)
    {
        $data = [
            'ngo' => $ngo,
            'causes' => $ngo->causes,
        ];
        return view('ngo.profile', $data);
    }

    public function edit()
    {
        $data = [
            'ngo' => Auth::guard('ngo')->user()
        ];
        return view('ngo.edit', $data);
    }

    public function update(EditNgoRequest $request)
    {
        $ngo = Ngo::find(Auth::guard('ngo')->user()->id);
        $ngo->about = $request['about'];
        $ngo->website = $request['website'];
        $ngo->name = $request['name'];
        $ngo->contact = $request['contact'];
        $ngo->save();

        return redirect('ngo/profile/'.$ngo->id);
    }
}