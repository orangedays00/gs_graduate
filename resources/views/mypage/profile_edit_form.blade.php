@extends('layouts.app')

@section('title')
    プロフィール編集
@endsection

@section('content')
    <div id="profile-edit-form" class="container">
        <div class="row">
            <div class="col-8 offset-2">
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-10 offset-1 bg-white">

                <div class="font-weight-bold text-center border-bottom pb-3 pt-3" style="font-size: 24px">プロフィール編集</div>

                <form method="POST" action="{{ route('mypage.edit-profile') }}" class="p-1" enctype="multipart/form-data">
                    @csrf

                    {{-- アバター画像 --}}
                    <span class="avatar-form image-picker">
                        <div>画像を変更する場合は、画像をクリックしてください。</div>
                        <input type="file" name="avatar" class="d-none" accept="image/png,image/jpeg,image/gif" id="avatar" />
                        <label for="avatar" class="d-inline-block">
                            @if (!empty($member->avatar_file_name))
                                 <img src="/storage/avatars/{{$member->avatar_file_name}}" class="" style="object-fit: cover; width: 200px; height: 200px;">
                             @else
                                 <img src="/images/avatar-default.svg" class="rounded-circle" >
                             @endif
                        </label>
                    </span>
                    

                    {{-- 名前 --}}
                    <div class="form-group mt-3">
                        <label for="name">名前</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name', $user->name) }}" required autocomplete="name" autofocus>
                        @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="email">メールアドレス</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $user->email) }}" required autocomplete="email" autofocus>
                        @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="gender">性別</label>
                        <input id="gender" type="text" class="form-control @error('gender') is-invalid @enderror" name="gender" value="{{ old('gender', $member->gender) }}" autocomplete="gender" autofocus>
                        @error('gender')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="prefecture">都道府県（居住地）</label>
                        <input id="prefecture" type="text" class="form-control @error('prefecture') is-invalid @enderror" name="prefecture" value="{{ old('prefecture', $member->prefecture) }}" autocomplete="prefecture" autofocus>
                        <div class="small text-muted">東京都　大阪府　愛知県 のように、都道府県も含めて入力してください。</div>
                        @error('prefecture')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="birthday">誕生日</label>
                        <input id="birthday" type="date" class="form-control @error('birthday') is-invalid @enderror" name="birthday" value="{{ old('birthday', $member->birthday) }}" autocomplete="birthday" autofocus>
                        @error('birthday')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="github_account">GitHubアカウント</label>
                        <input id="github_account" type="url" class="form-control @error('github_account') is-invalid @enderror" name="github_account" value="{{ old('github_account', $member->github_account) }}" autocomplete="github_account" autofocus>
                        <div class="small text-muted">GitHubアカウントのURLを入力してください。</div>
                        @error('github_account')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="qiita_account">Qiitaアカウント</label>
                        <input id="qiita_account" type="url" class="form-control @error('qiita_account') is-invalid @enderror" name="qiita_account" value="{{ old('qiita_account', $member->qiita_account) }}" autocomplete="qiita_account" autofocus>
                        <div class="small text-muted">QiitaアカウントのURLを入力してください。</div>
                        @error('qiita_account')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="period">在籍期</label>
                        <input id="period" type="text" class="form-control @error('period') is-invalid @enderror" name="period" value="{{ old('period', $member->period) }}" autocomplete="period" autofocus>
                        <div class="small text-muted">DEV18期やLAB10期、札幌unit1期のように入力してください。</div>
                        @error('period')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="reasons_admission">入学理由</label>
                        <textarea id="reasons_admission" type="text" class="form-control @error('reasons_admission') is-invalid @enderror" name="reasons_admission" autocomplete="reasons_admission" autofocus rows="4">{{ old('reasons_admission', $member->reasons_admission) }}
                        </textarea>
                        @error('reasons_admission')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="selected_mentor">選択したメンター</label>
                        <input id="selected_mentor" type="text" class="form-control @error('selected_mentor') is-invalid @enderror" name="selected_mentor" value="{{ old('selected_mentor', $member->selected_mentor) }}"  autocomplete="selected_mentor" autofocus>
                        <div class="small text-muted">メンターの名前（敬称不要）を入力してください。</div>
                        @error('selected_mentor')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="submission_assignments">提出した課題</label>
                        <input id="submission_assignments" type="url" class="form-control @error('submission_assignments') is-invalid @enderror" name="submission_assignments" value="{{ old('submission_assignments', $member->submission_assignments) }}"  autocomplete="submission_assignments" autofocus>
                        <div class="small text-muted">課題提出したGitHubアカウントのURLを入力してください。</div>
                        @error('submission_assignments')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="graduation_project_url">卒業制作（URL）</label>
                        <input id="graduation_project_url" type="url" class="form-control @error('graduation_project_url') is-invalid @enderror" name="graduation_project_url" value="{{ old('graduation_project_url', $member->graduation_project_url) }}"  autocomplete="graduation_project_url" autofocus>
                        <div class="small text-muted"></div>
                        @error('graduation_project_url')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                    <div class="form-group mt-3 ori-flex-column">
                        <label for="graduation_project_proposal">卒業制作（企画書）</label>
                        <input id="graduation_project_proposal" type="file" name="graduation_project_proposal" accept="application/pdf"/>
                        <div class="small text-muted">PDFファイルをアップしてください。</div>
                        @error('graduation_project_proposal')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                        @if (!empty($member->graduation_project_proposal))
                        <div class="mt-2">※アップロード済み資料</div><a target="_blank" href="/storage/pdf/{!! nl2br(e($member->graduation_project_proposal)) !!}">{!! nl2br(e($member->graduation_project_proposal)) !!}</a>
                        @endif
                    </div>
                    
                    <div class="form-group mt-3">
                        <label for="stressed_gs">G'sに通っている中で悩んだこと</label>
                        <textarea id="stressed_gs" type="text" class="form-control @error('stressed_gs') is-invalid @enderror" name="stressed_gs" autocomplete="stressed_gs" autofocus rows="4">{{ old('stressed_gs', $member->stressed_gs) }}
                        </textarea>
                        @error('stressed_gs')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>


                    <div class="form-group mb-0 mt-3">
                        <button type="submit" class="btn btn-block btn-secondary">
                            保存
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('mainscript')
<script src="{{ asset('js/app.main.js') }}" defer></script>
@endsection