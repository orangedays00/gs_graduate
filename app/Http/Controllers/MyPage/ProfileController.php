<?php

namespace App\Http\Controllers\MyPage;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Mypage\Profile\EditRequest;
use Illuminate\Http\File;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Auth;
use App\Member; //この行を上に追加
use App\User;//この行を上に追加
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    //
    public function showProfileEditForm()
     {
        $id = Auth::user()->id;
        $user = User::find($id);
        $member = Member::where('user_id',$id)->first();
        return view('mypage.profile_edit_form',[
            'user' => $user,
            'member'=> $member
            ]);
     }
     
    public function editProfile(EditRequest $request)
     {
        //  dd($request->file('avatar'));
         $id = Auth::user()->id;
         $user = User::find($id);
         $member = Member::where('user_id',$id)->first();
         
 
         $user->name = $request->input('name');
         $user->email = $request->input('email');
         $user->save();
         
         $member->gender = $request->input('gender');
         $member->prefecture = $request->input('prefecture');
         $member->birthday = $request->input('birthday');
         $member->github_account = $request->input('github_account');
         $member->qiita_account = $request->input('qiita_account');
         $member->period = $request->input('period');
         $member->reasons_admission = $request->input('reasons_admission');
         $member->selected_mentor = $request->input('selected_mentor');
         $member->submission_assignments = $request->input('submission_assignments');
         $member->graduation_project_url = $request->input('graduation_project_url');
        //  $member->graduation_project_proposal = $request->input('graduation_project_proposal');
         $member->stressed_gs = $request->input('stressed_gs');
         
         if ($request->has('avatar')) {
             $fileName = $this->saveAvatar($request->file('avatar'));
             $member->avatar_file_name = $fileName;
         }
         
        //  $file_name = $request->file('graduation_project_proposal')->getClientOriginalName();
        // $path = Storage::disk('public')->putFile('images', $request->file('image'));
        if($request->has('graduation_project_proposal')){
            // $file_name = Storage::disk('public')->putFile('pdf', $request->file('graduation_project_proposal'));
            
            // 以下は正解（ただし、pdfが保存名に表示される
            $file_name = Storage::disk('public')->putFileAs('pdf', $request->file('graduation_project_proposal'), $request->file('graduation_project_proposal')->getClientOriginalName());
            // dd($file_name);
            
        //  $file_name = Storage::disk('public')
            //  ->putFile('pdf', new File($request->file('graduation_project_proposal')->getClientOriginalName()));
        //  $member->graduation_project_proposal = file('graduation_project_proposal')->storeAs('pdf',$file_name);
        
            $member->graduation_project_proposal = basename($file_name);
        }
        
        
         
         $member->save();
 
         return redirect()->back()
             ->with('status', 'プロフィールを変更しました。');
     }
     
     
     
     
     /**
      * アバター画像をリサイズして保存
      *
      * @param UploadedFile $file アップロードされたアバター画像
      * @return string ファイル名
      */
     private function saveAvatar(UploadedFile $file): string
     {
         $tempPath = $this->makeTempPath();
 
         Image::make($file)->fit(200, 200)->save($tempPath);
 
         $filePath = Storage::disk('public')
             ->putFile('avatars', new File($tempPath));
 
         return basename($filePath);
     }
     
     private function savePdf(UploadedFile $file): string
     {
         $filePath = Storage::disk('public')->putFile('pdf', new File($tempPath));
         return basename($filePath);
     }
     
     /**
      * 一時的なファイルを生成してパスを返します。
      *
      * @return string ファイルパス
      */
     private function makeTempPath(): string
     {
         $tmp_fp = tmpfile();
         $meta   = stream_get_meta_data($tmp_fp);
         return $meta["uri"];
     }

}
