@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h2>商品新規登録</h2></div>

                <div class="card-body">
                    <form method="POST" action="{{ route('products.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3 row">
                            <label for="product_name" class="col-md-4 col-form-label text-md-end">商品名<span style="color: red;">*</span></label>
                            <div class="col-md-8">
                                <input id="product_name" type="text" name="product_name" class="form-control" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="company_id" class="col-md-4 col-form-label text-md-end">メーカー<span style="color: red;">*</span></label>
                            <div class="col-md-8">
                                <select class="form-select" id="company_id" name="company_id">
                                    @foreach($companies as $company)
                                        <option value="{{ $company->id }}">{{ $company->company_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="price" class="col-md-4 col-form-label text-md-end">価格<span style="color: red;">*</span></label>
                            <div class="col-md-8">
                                <input id="price" type="text" name="price" class="form-control" pattern="\d+" title="数字を入力してください" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="stock" class="col-md-4 col-form-label text-md-end">在庫数<span style="color: red;">*</span></label>
                            <div class="col-md-8">
                                <input id="stock" type="text" name="stock" class="form-control" pattern="\d+" title="数字を入力してください" required>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="comment" class="col-md-4 col-form-label text-md-end">コメント</label>
                            <div class="col-md-8">
                                <textarea id="comment" name="comment" class="form-control" rows="3"></textarea>
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label for="img_path" class="col-md-4 col-form-label text-md-end">商品画像</label>
                            <div class="col-md-8">
                                <input id="img_path" type="file" name="img_path" class="form-control">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <div class="col-md-4"></div>
                            <div class="col-md-8">
                                <button type="submit" class="btn btn-primary mx-1">登録</button>
                                <a href="{{ route('products.index') }}" class="btn btn-secondary mx-1">戻る</a>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
