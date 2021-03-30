<div class="font-weight-bold text-center pb-3 pt-3" style="font-size: 24px">{{$user->name}}</div>

<!--co1は12分割してどれだけ画面を占めるかをやる。-->
<div class="col-12">
        @if (!empty($member->avatar_file_name))
        <img src="/storage/avatars/{{$member->avatar_file_name}}" class="rounded mx-auto d-block" style="width: 200px">
        @else
        <img src="/images/avatar_profile_default.svg" class="rounded mx-auto d-block" style="width: 200px">
        @endif
</div>