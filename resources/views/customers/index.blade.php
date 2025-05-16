<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Khách Hàng</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 40px; background-color: #fff; }
        .container { max-width: 1100px; margin: 0 auto; padding: 20px; border: 1px solid #ccc; border-radius: 5px; }
        h2 { margin-bottom: 20px; }

        .search-bar {
            display: flex;
            justify-content: flex-end;
            margin-bottom: 15px;
        }

        .search-bar input[type="text"] {
            padding: 5px;
            width: 200px;
        }

        .search-bar button, .add-btn {
            padding: 6px 12px;
            margin-left: 5px;
            border: 1px solid #ccc;
            background-color: #f5f5f5;
            cursor: pointer;
        }

        .add-btn {
            float: right;
            background-color: #e1f5fe;
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }

        th, td {
            border: 1px solid #aaa;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .actions button {
            margin-right: 5px;
            padding: 4px 10px;
            border-radius: 5px;
            cursor: pointer;
            border: 1px solid #aaa;
        }

        .edit-btn {
            color: blue;
        }

        .delete-btn {
            color: red;
        }

        .pagination {
            text-align: center;
            margin-top: 20px;
        }

        .pagination a {
            margin: 0 5px;
            text-decoration: none;
            border: 1px solid #ccc;
            padding: 6px 10px;
            border-radius: 4px;
            color: black;
        }

        .pagination a.active {
            background-color: #4CAF50;
            color: white;
        }

    </style>
</head>
<body>
<div class="container">
    <h2>Quản Lý Khách Hàng</h2>

    <form method="GET" action="{{ route('customers.index') }}" class="search-bar">
        <input type="text" name="search" value="{{ $search }}" placeholder="Tìm kiếm">
        <button type="submit">Tìm</button>
        <a href="{{ route('customers.create') }}" class="add-btn">+ Thêm khách hàng</a>
    </form>

    <table>
        <thead>
        <tr>
            <th>STT</th>
            <th>Tên khách hàng</th>
            <th>Điện thoại</th>
            <th>Email</th>
            <th>Địa chỉ</th>
            <th>Tùy chỉnh</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($customers as $index => $customer)
            <tr>
                <td>{{ ($page - 1) * $limit + $index + 1 }}</td>
                <td>{{ $customer->name }}</td> <!-- Đã sửa lại đúng -->
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->address }}</td>
                <td class="actions">
                    <a href="{{ route('customers.edit', $customer->id) }}">
                        <button type="button" class="edit-btn">Chỉnh sửa</button>
                    </a>
                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn">Xóa</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="6" style="text-align: center;">Không có dữ liệu</td></tr>
        @endforelse
        </tbody>
    </table>

    @if ($totalPages > 1)
    <div class="pagination">
        @for ($i = 1; $i <= $totalPages; $i++)
            <a href="{{ route('customers.index', ['search' => $search, 'page' => $i, 'limit' => $limit]) }}" class="{{ $i == $page ? 'active' : '' }}">
                {{ $i }}
            </a>
        @endfor
    </div>
    @endif

</div>
</body>
</html>
