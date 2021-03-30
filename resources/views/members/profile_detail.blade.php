@extends('layouts.app')

@section('title')
    {{$user->name}} | メンバー詳細
@endsection

@section('content')
<div class="container">
     <div class="mb-4">
            <a class="btn btn-primary" href="{{ route('top') }}">
                戻る
            </a>
        </div>
    <div class="row">
        <!--<div class="col-10 offset-1 bg-white">-->
        <div class="col-12 bg-white py-3">
            <div class="row mt-3">
                <div class="col-8 offset-2">
                    @if (session('message'))
                        <div class="alert alert-{{ session('type', 'success') }}" role="alert">
                            {{ session('message') }}
                        </div>
                    @endif
                </div>
            </div>

            @include('members.profile_detail_panel', [
                'user' => $user,
                'member' => $member
            ])
            
            

            <div class="card mt-5">
                <div class="card-header">プロフィール</div>
                <div class="col">
                    <dl class="row mt-2">
                        <dt class="col-sm-3">性別</dt>
                        @if (!empty($member->gender))
                        <dd class="col-sm-9">{!! nl2br(e($member->gender)) !!}</dd>
                        @else
                        <dd class="col-sm-9">未入力</dd>
                        @endif
                        
                        <dt class="col-sm-3">都道府県（居住地）</dt>
                        @if (!empty($member->prefecture))
                        <dd class="col-sm-9">{!! nl2br(e($member->prefecture)) !!}</dd>
                        @else
                        <dd class="col-sm-9">未入力</dd>
                        @endif
                        
                        <dt class="col-sm-3">誕生日</dt>
                        @if (!empty($member->birthday))
                        <dd class="col-sm-9">{!! nl2br(e($member->birthday)) !!}</dd>
                        @else
                        <dd class="col-sm-9">未入力</dd>
                        @endif
                        
                        <dt class="col-sm-3">GitHubアカウント</dt>
                        @if (!empty($member->github_account))
                        <dd class="col-sm-9"><a target="_blank" href="{!! nl2br(e($member->github_account)) !!}">{!! nl2br(e($member->github_account)) !!}</a></dd>
                        @else
                        <dd class="col-sm-9">未入力</dd>
                        @endif
                        
                        <dt class="col-sm-3">Qiitaアカウント</dt>
                        @if (!empty($member->qiita_account))
                        <dd class="col-sm-9"><a target="_blank" href="{!! nl2br(e($member->qiita_account)) !!}">{!! nl2br(e($member->qiita_account)) !!}</a></dd>
                        @else
                        <dd class="col-sm-9">未入力</dd>
                        @endif
                        
                        
                    </dl>
                </div>
            </div>
            <div class="card mt-5">
                <div class="card-header">G'sAcademyでの内容</div>
                <div class="col">
                    <dl class="row mt-2">
                        <dt class="col-sm-3">在籍期</dt>
                        @if (!empty($member->period))
                        <dd class="col-sm-9">{!! nl2br(e($member->period)) !!}</dd>
                        @else
                        <dd class="col-sm-9">未入力</dd>
                        @endif
                        
                        <dt class="col-sm-3">入学理由</dt>
                        @if (!empty($member->reasons_admission))
                        <dd class="col-sm-9">{!! nl2br(e($member->reasons_admission)) !!}</dd>
                        @else
                        <dd class="col-sm-9">未入力</dd>
                        @endif
                        
                        <dt class="col-sm-3">選択したメンター</dt>
                        @if (!empty($member->selected_mentor))
                        <dd class="col-sm-9">{!! nl2br(e($member->selected_mentor)) !!}さん</dd>
                        @else
                        <dd class="col-sm-9">未入力</dd>
                        @endif
                        
                        <dt class="col-sm-3">提出した課題（URL）</dt>
                        @if (!empty($member->submission_assignments))
                        <dd class="col-sm-9"><a target="_blank" href="{!! nl2br(e($member->submission_assignments)) !!}">{!! nl2br(e($member->submission_assignments)) !!}</a></dd>
                        @else
                        <dd class="col-sm-9">未入力</dd>
                        @endif
                        
                        <dt class="col-sm-3">卒業制作（URL）</dt>
                        @if (!empty($member->graduation_project_url))
                        <dd class="col-sm-9"><a target="_blank" href="{!! nl2br(e($member->graduation_project_url)) !!}">{!! nl2br(e($member->graduation_project_url)) !!}</a></dd>
                        @else
                        <dd class="col-sm-9">未入力</dd>
                        @endif
                        
                        <dt class="col-sm-3">卒業制作（企画書）</dt>
                        @if (!empty($member->graduation_project_proposal))
                        <dd class="col-sm-9"><a target="_blank" href="/storage/pdf/{!! nl2br(e($member->graduation_project_proposal)) !!}">{!! nl2br(e($member->graduation_project_proposal)) !!}</a></dd>
                        @else
                        <dd class="col-sm-9">未入力</dd>
                        @endif
                        
                        <dt class="col-sm-3">G'sに通っている中で悩んだこと</dt>
                        @if (!empty($member->stressed_gs))
                        <dd class="col-sm-9">{!! nl2br(e($member->stressed_gs)) !!}</dd>
                        @else
                        <dd class="col-sm-9">未入力</dd>
                        @endif
                        
                        
                    </dl>
                </div>
            </div>
            @include('members.member_review', [
                'user' => $user,
                'reviews' => $reviews,
            ])
        </div>
    </div>
</div>
@endsection
<!--<h5 class="card-title"></h5>-->
<!--                        <p class="card-text"></p>-->