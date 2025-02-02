<div class="row">
    <div class="card">
        <div class="card-header">Registrar Livro</div>
        <div class="card-body">
            <div class="col-lg-12">
                <div class="row mb-3">
                    <div class="col-lg-4 mb-3">
                        <label for="title" class="form-label">Título</label>
                        <input type="text" class="form-control" id="title" name="title" required value="{{ $book->title }}">
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label for="author" class="form-label">Autor</label>
                        <select class="form-control" id="author" name="author" required>
                            @foreach ($authors as $author)
                                <option value="{{ $author->id }}" {{ !empty($book->author->id ) && $book->author->id == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label for="published-at" class="form-label">Ano de publicação</label>
                        <input type="text" class="form-control date" id="published-at" name="published-at" required value="{{ !empty($book->published_at) ?  $book->published_at->format('d/m/Y') : $book->published_at }}">
                    </div>
                    <div class="col-lg-4 mb-3">
                        <label for="description" class="form-label">Descrição</label>
                        <textarea class="form-control" id="description" name="description" required>{{ $book->description }}</textarea>
                    </div>
                </div>
                <div class="row mb-3">
                    <div class="col-lg-3">
                        <button type="submit" class="btn btn-primary" id="btn-submit">Salvar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@section('scripts')
@parent
    <script type="text/javascript">
        jQuery( document ).ready(function( $ ) {
            $('.date').datepicker({
                autoclose: true,
                format: "dd/mm/yyyy",
                language: "pt-BR",
                daysOfWeekHighlighted: "0",
                todayHighlight: true,
            });
        });
                
        function getFormData () {
            const formData = new FormData()

            formData.append('id', parseInt('{{ $book->id }}'))
            formData.append('title', $('#title').val())
            formData.append('author_id', $('#author').val())
            
            let dateParts = $('#published-at').val().split('/');
            let publishedAt = `${dateParts[2]}-${dateParts[1]}-${dateParts[0]}`; // YYYY-MM-DD

            formData.append('published_at', publishedAt);

            formData.append('description', $('#description').val())

            return formData
        }
    </script>    
@endsection