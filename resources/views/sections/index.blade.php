@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="card">
            <div class="card-header">
                Sections
                <a href="{{ route('sections.create') }}" class="btn btn-primary btn-sm float-right">Add</a>
            </div>
            <div class="card-body">
                <table class="table">
                    @foreach($sections as $section)
                        <tr>
                            <td>
                                @php($media = $section->getFirstMedia('logo'))
                                @if($media !== null)
                                    <img src="{{ $media->getUrl('thumb') }}" alt="{{ $section->name }}">
                                @else
                                    <img src="/150.png" alt="{{ $section->name }}">
                                @endif
                            </td>
                            <td>
                                <h6>{{ $section->name }}</h6> <br>
                                <p>
                                    {{ $section->descr }}
                                </p>
                            </td>
                            <td>
                                @if(count($section->users))
                                    <h6>Users</h6>
                                    <ul>
                                        @foreach($section->users as $user)
                                            <li>{{ $user->name }}</li>
                                        @endforeach
                                    </ul>
                                @endif
                            </td>
                            <td>
                                <a href="{{ route('sections.edit', $section) }}"
                                   class="btn btn-secondary btn-sm float-left">Edit</a>
                                <form action="{{ route('sections.destroy', $section) }}" method="post"
                                      onsubmit="!confirm('Are you sure?')?event.preventDefault():''">
                                    @csrf
                                    @method('delete')
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </table>
                {{ $sections->links() }}
            </div>
        </div>
    </div>
@endsection
