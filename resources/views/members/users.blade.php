@extends('layouts.app')

@section('title')
    メンバー一覧
@endsection

@section('content')
<div class="container">
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif
    <div class="mt-3">
        <form class="col-sm-10" method="GET" action="{{ route('top') }}">
             <div class="input-group">
                 <input type="text" name="keyword" class="form-control" placeholder="キーワード検索">
                 <div class="input-group-append">
                     <button type="submit" class="btn btn-primary">
                         <i class="fas fa-search"></i>
                     </button>
                 </div>
             </div>
         </form>
    </div>
    <!--<form action="{{url('/books')}}" method="GET">-->
    <!--    <p><input type="text" name="keyword" value=""></p>-->
    <!--    <p><input type="submit" value="検索"></p>-->
    <!--</form>-->
    <div class="row mt-5">
        @foreach ($users as $user)
            <div class="col-5 mb-3 mx-2 col-sm-4 col-md-2" style="width: 10rem;">
                <div class="card h-100">
                    <div class="position-relative overflow-hidden">
                        @if (!empty($user->avatar_file_name))
                        <img src="/storage/avatars/{{$user->avatar_file_name}}" class="card-img-top">
                        <!--<img src="{{url(\Storage::disk('public')->url($user->avatar_file_name))}}" class="card-img-top">-->
                        @else
                        <!--<img src="/images/avatar-default.svg" class="rounded-circle" style="object-fit: cover; width: 35px; height: 35px;">-->
                        <img src="/images/avatar_profile_default.png" class="card-img-top">
                        @endif
                        
                        @if(!empty($user->period))
                        <div class="position-absolute py-1 px-2" style="left: 0; bottom: 10px; color: white; background-color: rgba(0, 0, 0, 0.70)">
                            <span class="ml-1">{{$user->period}}</span>
                        </div>
                        @endif
                    </div>
                    <div class="card-body">
                        <h6 class="card-title">{{$user->name}}</h6>
                    </div>
                    <!--rotute web.php の name を第一引数に、第二引数に値を-->
                    <a href="{{route("profile",[$user->id])}}" class="stretched-link"></a>
                </div>
            </div>
        @endforeach
    </div>
    <div class="row">
    	<div class="col-xs-6 mb-3 mx-2 col-sm-4 col-md-2">
    		{{ $users->links()}}
        </div>
    </div>
</div>



@endsection