<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Auth;
use App\Comment;
use App\User;
use App\Member;
use App\Post;

use App\MemberReview;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $role = Auth::user()->role;
        $id = Auth::user()->id;
        if($role === 1) //メンテナンス用権限
            {
            $users = User::all();
            $delete_flag = 1;
            }
        elseif(($role > 1)&&($role <= 5)) //管理者権限
            {
            $users = User::where('role' ,'>=',2)->get();
            $delete_flag = 1;
            }
        elseif(($role > 5)&&($role <= 8)) //一般ユーザー権限
            {
            $users = User::where('role','>=',2)->get();
            $delete_flag = 0;
            }
        else //外注権限
            {
            $users = User::where('id','=',$id)->get();
            $delete_flag = 0;
            }
        return view('members.admin', compact('users','delete_flag','role'));
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
        $user = User::findOrFail($id);
        
        \DB::transaction(function() use ($user){
            
            
            $user->comment()->delete();
            $user->posts()->delete();
            $user->reviews()->delete();
            $user->member()->delete();
            $user->delete();
        });
        // $user = User::findOrFail($id);
        // $user->delete();
        // $member = Member::findOrFail($id);
        // $member->delete();
        
        return redirect()->route('admin');
    }
}
