<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order PDF</title>
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 0 auto;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #dee2e6;
            padding: 8px;
        }

        th {
            background-color: #f8f9fa;
            font-weight: bold;
        }

        .total {
            color: red;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Order {{$order->id}}</h1>
        <table>
            <tr>
                <th>Full Name</th>
                <td>{{ $order->name }}</td>
            </tr>
            <tr>
                <th>Email</th>
                <td>{{ $order->email }}</td>
            </tr>
            <tr>
                <th>Phone Number</th>
                <td>{{ $order->phone }}</td>
            </tr>
            <tr>
                <th>Address</th>
                <td>{{ $order->address }}</td>
            </tr>
        </table>
        <table>
            <tr>
                <th>Title</th>
                <th>Price</th>
                <th>Number</th>
                <th>Total Price</th>
            </tr>
            @php
                $total_money = 0;
            @endphp
            @foreach($order_detail as $item)
            <tr>
                <td>{{ $item->title }}</td>
                <td>{{ number_format($item->price, 0) }}</td>
                <td>{{ number_format($item->num) }}</td>
                <td>{{ number_format($item->total_money) }} VND</td>
            </tr>
            <?php $total_money += $item->total_money; ?>
            @endforeach
        </table>
        <h2 class="total">Total money: {{ number_format($total_money, 0) }} VND</h2>
    </div>
</body>
</html>
