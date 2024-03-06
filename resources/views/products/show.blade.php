@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>商品情報詳細</h2></div>

                    <div class="card-body">
                        <dl class="row mt-3">
                            <dt class="col-sm-3">商品名</dt>
                            <dd class="col-sm-9">{{ $product->product_name }}</dd>

                            <dt class="col-sm-3">メーカー名</dt>
                            <dd class="col-sm-9">{{ $product->company->company_name }}</dd>

                            <dt class="col-sm-3">価格</dt>
                            <dd class="col-sm-9">{{ $product->price }}</dd>

                            <dt class="col-sm-3">在庫数</dt>
                            <dd class="col-sm-9">{{ $product->stock }}</dd>

                            <dt class="col-sm-3">商品画像</dt>
                            <dd class="col-sm-9"><img src="{{ asset($product->img_path) }}" width="300"></dd>
                        </dl>

                        <div class="row mb-3">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <a href="{{ route('products.edit', $product) }}" class="btn btn-primary mx-1">編集</a>
                                <a href="{{ route('products.index') }}" class="btn btn-secondary mx-1">戻る</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection