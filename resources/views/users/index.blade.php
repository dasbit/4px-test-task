@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Users
                <a href="{{ route('users.create') }}" class="btn btn-primary btn-sm float-right">Add</a>
            </div>
            <div class="card-body">
                <table class="table">
                    @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->created_at->format('Y-m-d H:m:s') }}</td>
                            <td>
                                <a href="{{ route('users.edit', $user) }}" class="btn btn-secondary btn-sm float-left">Edit</a>
                                <form action="{{ route('users.destroy', $user) }}" method="post" onsubmit="!confirm('Are you sure?')?event.preventDefault():''" >
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
@endsection
