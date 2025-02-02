@extends('layouts.base')

@section('content')
    <form method="POST" id="form-{{ $action }}">
        @include('forms.book')
    </form>
@endsection

@section('scripts')
@parent
<script type="text/javascript">
    jQuery( document ).ready(function( $ ) {
        $("#form-create").validate({
            errorClass: "forminputerror",
            rules : {},
            errorPlacement: function(error, element)
            {
                
            },
            submitHandler: function(form)
            {
                $('#btn-submit').attr('disabled', true)

                const formData = getFormData()

                $.ajax(
                {
                    url: "{{ route('books.store') }}",
                    type: "POST",
                    data: formData,
                    processData: false,
                    contentType: false,
                }).done(function (response) {
                    if (response.success) {
                        Swal.fire({
                            title: 'Livro',
                            text: 'Livro criado com sucesso',
                            type: 'success',
                            icon: 'success',
                        }).then(() => {
                            window.location.href = '{{ route("books.index") }}'
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
        });
    });
</script>
@endsection