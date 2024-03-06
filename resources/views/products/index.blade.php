@extends('layouts.app')

@section('content')
<div class="container">
<div class="row justify-content-center">
<div class="col-md-10">
<div class="card">
<div class="card-header"><h2>商品一覧</h2></div>

<div class="card-body">
    <div class="search mt-5">

        <form id="search-form" class="row g-3">
            <div class="col-sm-12 col-md-4">
                <input type="text" name="search" class="form-control" placeholder="検索キーワード" value="{{ request('search') }}">
            </div>

            <div class="col-sm-12 col-md-4">
            <select name="company_id" data-toggle="select" class="form-control">
                <option value="">メーカー名</option>
                @foreach ($companies as $company)
                <option value="{{$company->id}}">{{$company->company_name}}</option>
                @endforeach
            </select>
            </div>

            <div class="col-sm-12 col-md-4">
                <input type="number" name="min_price" class="form-control" placeholder="最小価格" value="{{ request('min_price') }}">
            </div>

            <div class="col-sm-12 col-md-4">
                <input type="number" name="max_price" class="form-control" placeholder="最大価格" value="{{ request('max_price') }}">
            </div>

            <div class="col-sm-12 col-md-4">
                <input type="number" name="min_stock" class="form-control" placeholder="最小在庫" value="{{ request('min_stock') }}">
            </div>

            <div class="col-sm-12 col-md-4">
                <input type="number" name="max_stock" class="form-control" placeholder="最大在庫" value="{{ request('max_stock') }}">
            </div>
            
            <div class="col-sm-12 col-md-4">
                <button id="search" class="btn btn-outline-secondary" type="button">検索</button>
            </div>
        </form>
    </div>

    <div class="products mt-5" id="search-results">
        @include('products.product_list')
    </div>

    {{ $products->appends(request()->query())->links() }}

</div>
</div>
</div>
</div>
</div>

@endsection
