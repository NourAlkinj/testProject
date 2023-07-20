@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
{{--                    <h2>{{ __('Frontend/product.invoice', ['invoice_number' => $invoice->invoice_number]) }}</h2>--}}
                    <a href="{{ route('product.index') }}" class="btn btn-primary ml-auto"><i class="fa fa-home"></i> {{ __('Frontend/products.back_to_product') }}</a>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <tr>
                                <th>{{ __('Frontend/products.name') }}</th>
                                <td>{{ $product->name }}</td>

                            </tr>
                            <tr>

                                <th>{{ __('Frontend/products.description') }}</th>
                                <td>{{ $product->description }}</td>
                            </tr>
                            <tr>
                                <th>{{ __('Frontend/products.image') }}</th>
                                <td>{{ $product->image }}</td>
                            </tr>

                        </table>

                    </div>


                </div>
            </div>
        </div>
    </div>


@endsection
