@extends('layouts.template')

        @section('konten')

            <form action="{{ route('comments.store') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <textarea name="content" class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
                    <button type="submit" class="btn btn-success">Submit</button>
                </div>
            </form>
        @endsection
