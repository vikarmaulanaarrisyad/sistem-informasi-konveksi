@extends('frontend.main_master')

@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="breadcrumb-inner">
                <ul class="list-inline list-unstyled">
                    <li><a href="{{ url('/') }}">Home</a></li>
                    <li class='active'>Detail Custom Order</li>
                </ul>
            </div><!-- /.breadcrumb-inner -->
        </div><!-- /.container -->
    </div>

    <div class="body-content">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <br>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>Date</th>
                                    <th>Total</th>
                                    <th>Deskripsi</th>
                                    <th>Size</th>
                                    <th>Price</th>
                                    <th>Subtotal</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>{{ $customOrder->order_date }}</td>
                                    <td>{{ $customOrder->name }}</td>
                                    <td>{{ $customOrder->design_description }}</td>
                                    <td>{{ $customOrder->size }}</td>
                                    <td>{{ $customOrder->price }}</td>
                                    <td>{{ $customOrder->total_price }}</td>
                                    <td>{{ $customOrder->status }}</td>
                                    <td>
                                        @if ($customOrder->status == 'Progress')
                                            <button class="btn btn-primary" id="pay-button">Pay Now</button>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

    {{--  @include('frontend.body.brands')  --}}


    <form action="{{ route('user.customorder.payment') }}" method="post" id="submitForm">
        @csrf
        <input type="hidden" name="json" id="js_callback">
        <input type="hidden" name="custom_order_id" id="custom_order_id" value="{{ $customOrder->id }}">
    </form>


    <script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js"
        data-client-key="{{ config('midtrans.client_key') }}"></script>

    <script type="text/javascript">
        // For example trigger on button clicked, or any time you need
        var payButton = document.getElementById('pay-button');
        payButton.addEventListener('click', function() {
            // Trigger snap popup. @TODO: Replace TRANSACTION_TOKEN_HERE with your transaction token.
            // Also, use the embedId that you defined in the div above, here.
            window.snap.pay('{{ $snapToken }}', {
                onSuccess: function(result) {
                    /* You may add your own implementation here */
                    sendResponseToForm(result)
                },
                onPending: function(result) {
                    /* You may add your own implementation here */
                    sendResponseToForm(result)
                },
                onError: function(result) {
                    /* You may add your own implementation here */
                    sendResponseToForm(result)
                },
                onClose: function() {
                    /* You may add your own implementation here */
                    alert('you closed the popup without finishing the payment');
                }
            });
        });

        function sendResponseToForm(result) {
            document.getElementById('js_callback').value = JSON.stringify(result);
            $('#submitForm').submit();
            document.getElementById('custom_order_id').value = $(this).val()
        }
    </script>
@endsection
