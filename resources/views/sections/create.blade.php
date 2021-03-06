@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Sections
            </div>
            <div class="card-body">
                <form action="{{ route('sections.store') }}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input name="name" type="text" class="form-control" id="name" placeholder="Enter name" required
                               value="{{ old('name') }}">
                    </div>
                    <div class="form-group">
                        <label for="description">Description</label>
                        <textarea name="description" class="form-control" id="description" rows="3"
                                  placeholder="Fill description">{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="logo">Logo</label>
                        <input type="file" class="form-control-file" id="logo" name="logo">
                    </div>
                    <h5>Users</h5>
                    @foreach($users as $user)
                        <div class="form-check">
                            <input name="users[]" type="checkbox" class="form-check-input" id="user-{{ $user->id }}"
                                   value="{{ $user->id }}">
                            <label class="form-check-label" for="user-{{ $user->id }}">
                                {{ $user->name }} ({{ $user->email }})
                            </label>
                        </div>
                    @endforeach
                    <button type="submit" class="btn btn-primary">Send</button>
                </form>
            </div>
        </div>
    </div>
@endsection
