<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Member; //この行を上に追加
use App\User;//この行を上に追加
use App\MemberReview;
use Auth;//この行を上に追加
use Validator;//この行を上に追加

class MembersController extends Controller
{
    // public function index(){
    //     $users = User::orderBy('created_at', 'asc')->get();
    //     return view('members.users', [
    //         'users' => $users
    //         ]);
    // }
    
    public function index(Request $request)
    {
        // この時点でgetで取得してはだめ。ここでgetすると、この時点でデータを取得することになるため。実際は下のwhere句をかけないといけないため。
        $query = User::leftJoin('members','users.id','=','members.user_id');
        
        // $query = Member::query();
        
        if($request->filled('keyword')){
            $keyword = '%' . $this->escape($request->input('keyword')). '%';
            // $query->where(function($query) use ($keyword)){
                $query->where('name','LIKE', $keyword);
                $query->orWhere('gender','LIKE', $keyword);
                $query->orWhere('prefecture','LIKE', $keyword);
                $query->orWhere('period','LIKE', $keyword);
                $query->orWhere('reasons_admission','LIKE', $keyword);
                $query->orWhere('selected_mentor','LIKE', $keyword);
                $query->orWhere('stressed_gs','LIKE', $keyword);
      
            // }
        }    
            $users = $query->orderBy('users.created_at', 'asc')->paginate(30);
            return view('members.users', [
            'users' => $users
            ]);
        
    }
    
    // public function index(){
    //     if(auth()->id){
    //         $members = User::orderBy('created_at', 'asc')->get();
    //         return view('members.users', [
    //         'members' => $members
    //         ]);
    //     }else{
    //         return view('home');
    //     }
        
    // }
    
    private function escape(string $value)
     {
         return str_replace(
             ['\\', '%', '_'],
             ['\\\\', '\\%', '\\_'],
             $value
         );
     }
    
    public function judge(){
        if(Auth::user()){
            return redirect()->to('/member');
        }else{
            return view('home');
        }
    }
    
    // 動くことを確認
    // public function profileDetail(User $profile_id){
    //     return view('members.profile_detail')
    //          ->with('member', $profile_id);
    // }
    
    public function profileDetail($profile_id){
        
        $user = User::find($profile_id);
        $member = Member::where('user_id',$profile_id)->first();
        $reviews = MemberReview::join('users','member_reviews.reviewer_id', '=', 'users.id')->where('member_reviews.user_id',$profile_id)->orderBy('member_reviews.created_at','desc')->get();
        // $reviews = MemberReview::where('user_id',$profile_id)->orderBy('created_at','desc')->get();
        // dd($reviews->ToArray());
        return view('members.profile_detail',[
            'user' => $user,
            'member'=> $member,
            'reviews' => $reviews,
            ]);
    }
    
    // public function profileCommentForm(){
        
    // }
    
    // public function profileComment(){
        
    // }
    
    
    public function review(Request $request) {

        $result = false;

        // バリデーション
        $request->validate([
            'user_id' => [
                'required',
                'exists:users,id',
                function($attribute, $value, $fail) use($request) {

                    // ログインしてるかチェック
                    if(!auth()->check()) {

                        $fail('レビューするにはログインしてください。');
                        return;

                    }

                    // すでにレビュー投稿してるかチェック
                    // $exists = \App\MemberReview::where('reviewer_id', $request->user()->id)
                    //     ->where('user_id', $request->review_id)
                    //     ->exists();

                    // if($exists) {

                    //     $fail('すでにレビューは投稿済みです。');
                    //     return;

                    // }

                }
            ],
            'review' => 'required'
        ]);
        $userid = $request->user_id;
        $review = new MemberReview;
        $review->user_id = $request->user_id;
        $review->reviewer_id = $request->user()->id;
        $review->review = $request->review;
        // $review->save();
        $result = $review->save();
        return redirect()->route('profile', ['profile_id' => $userid]);

    }
}
