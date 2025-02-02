@extends('layouts.base')

@section('css')
    <link rel="stylesheet" href="//cdn.datatables.net/2.2.1/css/dataTables.dataTables.min.css"></link>
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
    <script src="//cdn.datatables.net/2.2.1/js/dataTables.min.js"></script>

    <script>
        jQuery( document ).ready(function( $ ) {
            $('#content').DataTable();

            $('#content').on('click', 'button', function () {
                const id = $(this).data('id')

                Swal.fire({
                    title: 'Você tem certeza?',
                    text: "Você não poderá reverter isso!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Sim, deletar!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $.ajax({
                            url: "{{ route('books.destroy') }}",
                            type: "POST",
                            data: {id: id},
                        }).done(function (response) {
                            if (response.success) {
                                Swal.fire({
                                    title: 'Livro',
                                    text: 'Livro criado com sucesso',
                                    type: 'success',
                                    icon: 'success',
                                }).then(() => {
                                    location.reload()
                                })
                            }
                        }).fail(function (err) {
                            let message = 'Erro ao criar o livro'
                            if (err.responseJSON && err.responseJSON.errors) {
                                console.log('err.responseJSON.errors', err.responseJSON.errors)
                                message = Object.values(err.responseJSON.errors)[0].join('\n')
                            }
                            Swal.fire({
                                title: 'Ops',
                                text: message,
                                type: 'error',
                                icon: 'error',
                            })
                        }).always(function () {
                            $('#btn-submit').attr('disabled', false)
                        });
                    }
                })
            });
        });
    </script>
@endsection