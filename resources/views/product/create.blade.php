@extends('layouts.app')
@section('style')
    <link rel="stylesheet" href="{{ asset('product/css/pickadate/classic.css') }}">
    <link rel="stylesheet" href="{{ asset('product/css/pickadate/classic.date.css') }}">
{{--    @if(config('app.locale') == 'ar')--}}
{{--        <link rel="stylesheet" href="{{ asset('product/css/pickadate/rtl.css') }}">--}}
{{--    @endif--}}
    <style>
        form.form label.error, label.error {
            color: red;
            font-style: italic;
        }
    </style>
@endsection
@section('content')
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    {{ __('Frontend/products.create_product') }}
                </div>

                <div class="card-body">
                    <form action="{{ route('product.store') }}" method="post" class="form">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="name">{{ __('Frontend/products.name') }}</label>
                                    <input type="text" name="name" class="form-control">
{{--                                    @error('name')<span class="help-block text-danger">{{ $message }}</span>@enderror--}}
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="description">{{ __('Frontend/products.description') }}</label>
                                    <input type="text" name="description" class="form-control">
{{--                                    @error('description')<span class="help-block text-danger">{{ $message }}</span>@enderror--}}
                                </div>
                            </div>
                        <div class="row">
                            <div class="col-4">
                                <div class="form-group">
                                    <label for="image">{{ __('Frontend/products.image') }}</label>
                                    <input type="text" name="image" class="form-control">
{{--                                    @error('image')<span class="help-block text-danger">{{ $message }}</span>@enderror--}}
                                </div>
                            </div>
                        </div>

{{--                        <div class="table-responsive">--}}
{{--                            <table class="table" id="invoice_details">--}}
{{--                                <thead>--}}
{{--                                <tr>--}}
{{--                                    <th></th>--}}
{{--                                    <th>{{ __('Frontend/products.name') }}</th>--}}
{{--                                    <th>{{ __('Frontend/products.description') }}</th>--}}
{{--                                    <th>{{ __('Frontend/products.details') }}</th>--}}
{{--                                    <th>{{ __('Frontend/products.unit_price') }}</th>--}}
{{--                                    <th>{{ __('Frontend/products.image') }}</th>--}}
{{--                                </tr>--}}
{{--                                </thead>--}}

{{--                            </table>--}}
{{--                        </div>--}}

                        <div class="text-right pt-3">
                            <button type="submit" name="save" class="btn btn-primary">{{ __('Frontend/products.save') }}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('script')
    <script src="{{ asset('product/js/form_validation/jquery.form.js') }}"></script>
    <script src="{{ asset('product/js/form_validation/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('product/js/form_validation/additional-methods.min.js') }}"></script>
    <script src="{{ asset('product/js/pickadate/picker.js') }}"></script>
    <script src="{{ asset('product/js/pickadate/picker.date.js') }}"></script>
    @if(config('app.locale') == 'ar')
        <script src="{{ asset('product/js/form_validation/messages_ar.js') }}"></script>
        <script src="{{ asset('product/js/pickadate/ar.js') }}"></script>
    @endif
    <script src="{{ asset('product/js/custom.js') }}"></script>
@endsection
