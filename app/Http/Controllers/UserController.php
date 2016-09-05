<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

use Auth;
use Gate;

use App\User;
use App\Cause;


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = [
            'user' => Auth::user(),
            'loggedUser' => Auth::user()
        ];
        return view('user/profile', $data);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, User $user)
    {
        $loggedUser = null;

        if (Auth::user()) {
            $loggedUser = Auth::user();
        } elseif (Auth::guard('ngo')->user()) {
            $loggedUser = Auth::guard('ngo')->user();
        }
        if (Auth::guard('admin')->check()) $loggedUser = Auth::guard('admin')->user();

        $data = [
            'user' => $user,
            'loggedUser' => $loggedUser
        ];
        return view('user/profile', $data);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function help(Cause $cause)
    {
        $user = Auth::user();
        $status = $user->help($cause);

        return redirect('causes/'.$cause->id)->with('status', $status);
    }

    public function leave(Cause $cause)
    {
        $user = Auth::user();
        $user->leave($cause);

        return redirect('causes/'.$cause->id)->with('status', 'left');
    }

    public function ban(Request $request, User $user)
    {
        $user->toggleBan();
        return redirect()->back();
    }
}
