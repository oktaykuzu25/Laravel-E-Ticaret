@extends('layouts.app')

@section('content')
    <div class="container">

        <div class="row justify-content-center">

            <div class="col-md-10">

                <div class="card">

                    <div class="card-header">
                        {{ __('Siparişlerim') }}
                    </div>

                    <div class="card-body">

                        @if ($orders->isEmpty())
                            <p class="text-center text-muted">Henüz siparişiniz yok.</p>
                        @else
                            @foreach ($orders as $order)
                                <div class="card mb-3">
                                    <div class="card-header d-flex justify-content-between">
                                        <span>Sipariş #{{ $order->id }} —
                                            {{ $order->created_at->format('d.m.Y H:i') }}</span>
                                        <span><strong>Toplam:</strong> {{ $order->total_price }} ₺</span>
                                    </div>
                                    <div class="card-body p-0">
                                        <table class="table table-striped mb-0">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Kitap</th>
                                                    <th>Adet</th>
                                                    <th>Birim Fiyat</th>
                                                    <th>Ara Toplam</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($order->details as $detail)
                                                    <tr>
                                                        <td>{{ $detail->id }}</td>
                                                        <td>{{ $detail->book->name ?? '—' }}</td>
                                                        <td>{{ $detail->qty }}</td>
                                                        <td>{{ $detail->per_price }} ₺</td>
                                                        <td>{{ $detail->subtotal }} ₺</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                        @endif

                    </div>

                </div>

            </div>

        </div>

    </div>
@endsection
