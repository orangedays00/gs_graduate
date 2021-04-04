@extends('layouts.app')

@section('title')
    アカウント管理
@endsection

@section('content')
<div class="container">
    <div class="row mb-4">
        <a class="btn btn-secondary mt-1 ml-2 mb-1" href="{{ route('register') }}" role="button">アカウント登録</a>
    </div>
    <div class="row table-responsive">
        
        @if($delete_flag === 1)
            @can('admin')
                <table id='list' class="table table-hover table-condensed">
                    <tr>
                        <th>名前</th>
                        <th>作成日</th>
                        <th>更新日</th>
                        <th></th>
                    </tr>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->created_at->format('Y_m_d') }}</td>
                            <td>{{ $user->updated_at->format('Y_m_d') }}</td>
                            <td>
                                @if($role <= ($user->role))
                                <form action="{{ route('admin.delete', [$user->id]) }}" method='POST'>
                                    @csrf
                                    <button type="submit" class="btn btn-warning">削除</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </table>
            @endcan
        @endif
    </div>
</div>
@endsection