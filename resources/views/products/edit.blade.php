@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card">
                <div class="card-header"><h2>商品情報編集</h2></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('products.update', $product) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row mb-3">
                            <label for="product_name" class="col-md-4 col-form-label text-md-end">商品名<span style="color: red;">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product->product_name }}" required>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="company_id" class="col-md-4 col-form-label text-md-end">メーカー名<span style="color: red;">*</span></label>
                            <div class="col-md-8">
                                <select class="form-select" id="company_id" name="company_id">
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}" {{ $company->id == $product->company_id ? 'selected' : '' }}>
                                            {{ $company->company_name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="price" class="col-md-4 col-form-label text-md-end">価格<span style="color: red;">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="price" name="price" value="{{ $product->price }}" pattern="[0-9]+" required>
                                @error('price')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="stock" class="col-md-4 col-form-label text-md-end">在庫数<span style="color: red;">*</span></label>
                            <div class="col-md-8">
                                <input type="text" class="form-control" id="stock" name="stock" value="{{ $product->stock }}" pattern="[0-9]+" required>
                                @error('stock')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="comment" class="col-md-4 col-form-label text-md-end">コメント</label>
                            <div class="col-md-8">
                                <textarea id="comment" name="comment" class="form-control" rows="3">{{ $product->comment }}</textarea>
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="img_path" class="col-md-4 col-form-label text-md-end">商品画像:</label>
                            <div class="col-md-8">
                                <input id="img_path" type="file" name="img_path" class="form-control">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <img src="{{ asset($product->img_path) }}" alt="商品画像" class="product-image mt-2">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary mx-1">更新</button>
                                <a href="{{ route('products.show', $product) }}" class="btn btn-secondary mx-1">戻る</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
