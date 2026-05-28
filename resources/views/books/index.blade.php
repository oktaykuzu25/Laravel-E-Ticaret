@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-6"> {{ __('Kitaplar') }}</div>
                            <div class="col-6 d-flex justify-content-end"><a href="{{ route('books.create') }}"
                                    class="btn btn-success">Kitap Ekle</a></div>
                        </div>
                    </div>

                    <div class="card-body">

                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th scope="col">#</th>
                                    <th scope="col">Kitabın Adı</th>
                                    <th scope="col">Kitabın Fiyatı</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($books as $book)
                                    <tr>
                                        <th scope="row">{{ $book->id }}</th>
                                        <td>{{ $book->name }}</td>
                                        <td>{{ $book->price }}</td>
                                        <td>
                                            <a href="{{ route('books.edit', $book->id) }}"
                                                class="btn btn-primary">Düzenle</a>
                                            <form action="{{ route('books.destroy', $book->id) }}" method="POST"
                                                style="display:inline"
                                                onsubmit="return confirm('Bu kitabı silmek istediğinize emin misiniz?');">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger">Sil</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach


                            </tbody>
                        </table>

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
