@extends('layouts.app')
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-flex">
{{--                    <h2 >{{ __('Frontend/products.products') }}</h2>--}}
                    <a href="{{ route('product.create') }}"   class="btn btn-primary ml-auto"><i class="fa fa-plus"></i> {{ __('Frontend/products.create_product') }}</a>
                </div>


                    <div class="table-responsive">
                        <table class="table card-table">
                            <thead>
                            <tr>
                                <th>{{ __('Frontend/products.name') }}</th>
                                <th>{{ __('Frontend/products.description') }}</th>
                                <th>{{ __('Frontend/products.actions') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($products as $product)
                            <tr>
                                <td><a href="{{ route('product.show', $product->id) }}">
                                        {{ $product->name }}
                                    </a></td>
                                <td>{{ $product->description }}</td>
                                <td>
                                    <a href="{{ route('product.update', $product->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i></a>
                                    <a href="javascript:void(0)" onclick="if (confirm('{{ __('Frontend/products.r_u_sure') }}')) { document.getElementById('delete-{{ $product->id }}').submit(); } else { return false; }" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></a>
                                    <form action="{{ route('product.delete', $product->id) }}" method="get" id="delete-{{ $product->id }}" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                            </tbody>
                            <tfoot>
                            <tr>
                                <td colspan="4">
                                    <div class="float-right">
{{--                                        {!! $product->links() !!}--}}
                                    </div>
                                </td>
                            </tr>
                            </tfoot>
                        </table>
                    </div>


            </div>
        </div>
    </div>


@endsection
