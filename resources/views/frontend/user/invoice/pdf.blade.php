<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice</title>

    <style>
        * {
            font-family: Verdana, Arial, sans-serif
        }

        table {
            font-size: x-small
        }

        tfoot tr td {
            font-weight: bold;
            font-size: x-small
        }

        .gray {
            background-color: lightgray;
        }

        .font {
            font-size: 15px;
        }

        .thanks p {
            color: blue;
            font-size: 16px;
            font-weight: normal;
            font-family: serif
        }

        .authority {
            margin-top: -10px;
            color: blue;
            margin-left: 35px
        }
    </style>
</head>

<body>
    <table width="100%" style="background: #F7F7F7; padding: 0 20px 0 20px">
        <tr>
            <td align="top">
                <h2 style="color:blue; font-size: 26px;"><strong>Konveksi Store</strong></h2>
            </td>
            <td align="right">
                <pre>
                Toko Online
                Email : ema@gmail.com <br>
                Phone : 08787878 <br>

            </pre>
            </td>
        </tr>
    </table>

    <table width="100%" style="background: #F7F7F7; padding: 0 5 0px">
        <tr>
            <td>
                <p class="font" style="margin-left: 20px">
                    <strong>Name: </strong> {{ $order->name }} <br>
                    <strong>Email: </strong> {{ $order->email }}<br>
                    <strong>Phone: </strong> {{ $order->phone }}<br>
                    <strong>Address: </strong> {{ $order->address }}<br>
                    <strong>Post Code: </strong> {{ $order->post_code }}<br>
                </p>
            </td>
            <td>
                <h3>
                    <p class="font">
                        <span style="color:blue"> #{{ $order->invoice_no }} </span> <br> <br>
                        Order Date: {{ $order->order_date }}<br>
                        Delivery Date: {{ $order->delivered_date }} <br>
                        Payment Type: {{ $order->payment_type }}<br>
                    </p>
                </h3>
            </td>
        </tr>
    </table>
    <br>

    <h3>Products</h3>

    <table width="100%" class=" table-column">
        <thead style="background-color: blue; color:#FFFFFF">
            <tr class="font">
                <th>No</th>
                <th>Product Name</th>
                <th>Size</th>
                <th>Color</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($orderItem as $item)
                {{--  @dd(asset('storage/' . $orderItem->first()->product->product_thumbnail));  --}}
                <tr class="font">
                    <td align="center">{{ $loop->iteration }}</td>
                    <td align="center">{{ $item->product->product_name }}</td>
                    <td align="center">{{ $item->size }}</td>
                    <td align="center">{{ $item->color }}</td>
                    <td align="center">{{ $item->qty }}</td>
                    <td align="center">Rp. {{ format_uang($item->price) }}</td>
                    <td align="center">Rp. {{ format_uang($item->price * $item->qty) }}</td>

                </tr>
            @endforeach

        </tbody>
    </table>
    <br>

    <table width="100%" style="padding: 0 10px 0 10px;">
        <tr>
            <td align="right">
                <h2>
                    <span style="color:blue;">Subtotal: {{ $order->amount }}</span> <br>
                </h2>
                <h2> <span style="color:blue;">Total: {{ $order->amount }}</span>
                </h2>
                <h3>
                    <span style="color:green">Payment Status: {{ $order->status }}</span>

                </h3>
            </td>
        </tr>
    </table>

    <div class="thanks mt-3">
        <p>Thanks For Buying Product!</p>
    </div>
    <div class="authority float-right mt-3">
        <p>-----------------------</p>
        <h5>Authority Signature:</h5>
    </div>


</body>

</html>
