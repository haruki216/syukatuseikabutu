@extends('layouts.app1')

@section('content')
    <h3>メモ - {{ $date }}</h3>
    <form method="post">
        @csrf

        <div class="form-group">
            <label>カテゴリー</label>
            <select class="form-control" name="category">
                <option value="腹筋" {{ old('category', $memo->category) == '腹筋' ? 'selected' : '' }}>腹筋</option>
                <option value="ランニング" {{ old('category', $memo->category) == 'ランニング' ? 'selected' : '' }}>ランニング</option>
                <option value="スクワット" {{ old('category', $memo->category) == 'スクワット' ? 'selected' : '' }}>スクワット</option>
            </select>
        </div>

        <div class="form-group">
            <label>回数 / 距離</label>
            <input type="number" class="form-control" name="count" value="{{ old('count', $memo->count) }}" required>
        </div>

        <button type="submit" class="btn btn-primary">保存</button>
    </form>
@endsection
