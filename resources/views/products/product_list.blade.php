<table class="table table-striped text-center" id="table_sort">
    <thead>
        <tr>
            <th>ID.</th>
            <th>商品画像</th>
            <th>商品名</th>
            <th>価格</th>
            <th>在庫数</th>
            <th>メーカー名</th>
            <th><a href="{{ route('products.create') }}" class="btn btn-success">新規登録</a></th>
        </tr>
    </thead>
    <tbody>
        @foreach ($products as $product)
        <tr id="product-{{ $product->id }}">
            <td>{{ $product->id }}.</td>
            <td><img src="{{ asset($product->img_path) }}" alt="商品画像" width="100"></td>
            <td>{{ $product->product_name }}</td>
            <td>￥{{ $product->price }}</td>
            <td>{{ $product->stock }}</td>
            <td>{{ $product->company->company_name }}</td>
            <td>
                <a href="{{ route('products.show', $product) }}" class="btn btn-info btn-sm mx-1">詳細</a>
                <button class="btn btn-danger btn-sm mx-1 delete-product" data-product-id="{{ $product->id }}">削除</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
