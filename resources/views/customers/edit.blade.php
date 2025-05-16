<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Quản Lý Khách Hàng</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }

        .container {
            max-width: 1000px;
            margin: 0 auto;
            border: 1px solid #ccc;
            padding: 20px;
        }

        h2 {
            display: inline-block;
            margin-right: 20px;
        }

        .search-form {
            float: right;
        }

        input[type="text"] {
            padding: 5px;
            width: 200px;
        }

        button, .add-btn {
            padding: 6px 12px;
            border: 1px solid #aaa;
            background-color: #f9f9f9;
            cursor: pointer;
        }

        .add-btn {
            margin-left: 10px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th, td {
            border: 1px solid #aaa;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        .actions a {
            margin-right: 5px;
            padding: 4px 8px;
            text-decoration: none;
            border: 1px solid #ccc;
            border-radius: 4px;
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
            margin: 0 3px;
            padding: 5px 10px;
            border: 1px solid #aaa;
            text-decoration: none;
            color: black;
        }

        .pagination a.active {
            font-weight: bold;
            background-color: #ddd;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>Quản Lý Khách Hàng</h2>

    <form action="{{ route('customers.index') }}" method="GET" class="search-form">
        <input type="text" name="search" placeholder="Tìm kiếm" value="{{ $search }}">
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
        @forelse($customers as $index => $customer)
            <tr>
                <td>{{ ($page - 1) * $limit + $index + 1 }}</td>
                <td>{{ $customer->customer_name }}</td>
                <td>{{ $customer->phone }}</td>
                <td>{{ $customer->email }}</td>
                <td>{{ $customer->address }}</td>
                <td class="actions">
                    <a href="{{ route('customers.edit', $customer->id) }}" class="edit-btn">Chỉnh sửa</a>
                    <form action="{{ route('customers.destroy', $customer->id) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-btn" onclick="return confirm('Bạn có chắc muốn xóa khách hàng này?')">Xóa</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="6" style="text-align: center;">Không có dữ liệu</td>
            </tr>
        @endforelse
        </tbody>
    </table>

    <div class="pagination">
        @for($i = 1; $i <= $totalPages; $i++)
            <a href="{{ route('customers.index', ['page' => $i, 'limit' => $limit, 'search' => $search]) }}"
               class="{{ $i == $page ? 'active' : '' }}">{{ $i }}</a>
        @endfor
    </div>
</div>
</body>
</html>
