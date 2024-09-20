
@extends('layouts.app1')

@section('content')
    <h3>メモ - {{ $date }}</h3>
    <form method="post">
        @csrf

        <div class="form-group">
            <textarea class="form-control" name="memo" rows="1"　placeholder="腹筋">{{ old('memo', $memo->memo) }}</textarea>
        </div>   
        
        <div class="form-group">
            <textarea class="form-control" name="category" rows="5" placeholder="腹筋×１００回">{{ old('category', $memo->category) }}</textarea>
        </div>    
        <button type="submit" class="btn btn-primary">保存</button>
    </form>
@endsection
