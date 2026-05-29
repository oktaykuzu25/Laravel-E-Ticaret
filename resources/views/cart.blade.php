@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-8">

                <div class="card">

                    <div class="card-header">
                        <div class="row">
                            <div class="col-6"> {{ __('Sepet') }}</div>
                            <div class="col-6 d-flex justify-content-end">
                                Sepette {{ ShoppingCart::countRows() }} adet kitap var
                            </div>
                        </div>
                    </div>

                    <div class="card-body">

                        @if ($items->isEmpty())
                            <p class="text-center text-muted">Sepetiniz boş.</p>
                        @else
                            <table class="table table-striped align-middle">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Kitabın İsmi</th>
                                        <th scope="col">Adet</th>
                                        <th scope="col">Fiyatı</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($items as $item)
                                        <tr>
                                            <th scope="row">{{ $item->id }}</th>
                                            <td>{{ $item->name }}</td>
                                            <td>
                                                <a href="{{ route('shopping.decrease', $item->rawId()) }}"
                                                    class="btn btn-danger btn-sm">-</a>
                                                <span class="mx-2">{{ $item->qty }}</span>
                                                <a href="{{ route('shopping.increase', $item->rawId()) }}"
                                                    class="btn btn-success btn-sm">+</a>
                                            </td>
                                            <td>{{ $item->price }}₺</td>
                                            <td>
                                                <a href="{{ route('shopping.removefromcart', $item->rawId()) }}"
                                                    class="btn btn-danger"
                                                    onclick="return confirm('Bu ürünü sepetten çıkarmak istiyor musunuz?');">Sepetten
                                                    Çıkar</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <th scope="row">Toplam</th>
                                        <td colspan="4">{{ $total }} ₺</td>
                                    </tr>
                                </tbody>
                            </table>
                            <h2>Sipariş Bilgileri</h2>
                            <form action="{{ route('order.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="">Ad</label>
                                    <input type="text" class="form-control" name="name" placeholder="Ad"
                                        value="{{ old('name') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Soyad</label>
                                    <input type="text" class="form-control" name="surname" placeholder="Soyad"
                                        value="{{ old('surname') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Adres</label>
                                    <input type="text" class="form-control" name="address" placeholder="Adres"
                                        value="{{ old('address') }}" required>
                                </div>
                                <div class="form-group">
                                    <label for="">Mesaj</label>
                                    <textarea class="form-control" name="message" placeholder="Sipariş notu (opsiyonel)"
                                        rows="3">{{ old('message') }}</textarea>
                                </div>
                                <button type="submit" class="btn btn-primary mt-3">Sipariş Ver</button>
                            </form>
                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
