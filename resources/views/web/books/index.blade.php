@extends('layouts.base')

@section('css')
@endsection

@section('content')
    <div class="row">
        <div class="card">
            <div class="card-header">Livros</div>
            <div class="card-body">
                <table class="table table-bordered" id="content">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Título</th>
                            <th>Autor</th>
                            <th>Data de publicação</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($books as $book)
                            <tr>
                                <td>{{ $book->id }}</td>
                                <td>{{ $book->title }}</td>
                                <td>{{ $book->author->name }}</td>
                                <td>{{ $book->published_at->format('d/m/Y') }}</td>
                                <td>
                                    <a href="{{ route('books.edit', $book->id) }}" class="btn btn-warning">Edit</a>
                                    <button type="button" class="btn btn-danger" data-id={{ $book->id }}>Delete</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    @parent
@endsection