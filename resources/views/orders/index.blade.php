<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Delivery Status</title>

    <!-- Embedding CSS -->
    <style>
        /* Basic CSS styling */
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            color: white;
            text-align: center;
            padding: 1rem;
        }

        nav ul {
            list-style-type: none;
            padding: 0;
        }

        nav ul li {
            display: inline;
            margin-right: 20px;
        }

        nav ul li a {
            color: #333;
            text-decoration: none;
        }

        section {
            padding: 2rem;
            margin: 20px;
            background-color: white;
        }

        footer {
            text-align: center;
            padding: 1rem;
            background-color: #333;
            color: white;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            padding: 12px;
            text-align: left;
            border: 1px solid #ddd;
        }

        th {
            background-color: #333;
            color: white;
        }
    </style>

</head>

<body>

    <header>
        <h1>Welcome to the Delivery Status Page</h1>
    </header>

    <nav>
        <ul>
            <li><a href="#home">Home</a></li>
            <li><a href="#orders">Orders</a></li>
            <li><a href="#contact">Contact</a></li>
        </ul>
    </nav>

    <section>
        <h1>Delivery Status</h1>
        <table>
            <thead>
                <tr>
                    <th>Order Name</th>
                    <th>Order Number</th>
                    <th>Status</th>
                    <th>Assigned</th>
                    <th>Delivery Status</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $order)
                    <tr>
                        <td>{{ $order->order_name }}</td>
                        <td>{{ $order->order_number }}</td>
                        <td>{{ ucfirst($order->status) }}</td>
                        <td>{{ $order->assigned ? 'Yes' : 'No' }}</td>
                        <td>
                            @if ($order->status == 'delivered')
                                <span style="color: green;">Delivered</span>
                            @elseif($order->status == 'assigned')
                                <span style="color: orange;">In Progress</span>
                            @else
                                <span style="color: red;">Pending</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </section>

    <footer>
        <p>&copy; 2025 My Simple Page</p>
    </footer>

</body>

</html>
