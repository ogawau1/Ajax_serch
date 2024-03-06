console.log('読み込み成功');

// テーブルソーターの初期化
function sort() {
    $("#table_sort").tablesorter({
        sortList: [[0, 1]] // 初期は1列目(ID)を降順でソート
    });
}

$(document).ready(function() {
    sort();

    $('#search').click(function(event) {
        event.preventDefault(); // デフォルトのフォーム送信をキャンセル

        var formData = $('#search-form').serializeArray(); // フォームデータを取得

        $.ajax({
            type: 'GET',
            url: '/products',
            data: formData,
            success: function(response) {
                $('#search-results').html(response); // 検索結果を画面に表示
                sort();
                $("#table_sort").trigger("update");
            },
            error: function(xhr, status, error) {
                console.error(xhr.responseText);
            }
        });
    });
});

var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

// 削除
$(document).on('click', '.delete-product', function() {
    var productId = $(this).data('product-id');
    $.ajax({
        type: 'DELETE',
        url: '/products/' + productId,
        headers: {
            'X-CSRF-TOKEN': csrfToken // CSRFトークンをヘッダーに追加
        },
        success: function(response) {
            $('#product-' + productId).remove();
            $("#table_sort").trigger("update");
        },
        error: function(xhr, status, error) {
            console.error(xhr.responseText);
        }
    });
});
