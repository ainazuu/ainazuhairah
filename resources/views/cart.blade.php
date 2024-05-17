@extends('main')

@section('content')
<section id="intro" class="wrapper style1 fullscreen fade-up">
    <div class="inner">
        <div class="container mt-5">
            <h1>Your Cart</h1>
            @if(count($cart) > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th>Pizza Size</th>
                        <th>Pepperoni</th>
                        <th>Cheese</th>
                        <th>Price (RM)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($cart as $order)
                    <tr>
                        <td>{{ ucfirst($order['size']) }}</td>
                        <td>{{ $order['addPepperoni'] ? 'Yes' : 'No' }}</td>
                        <td>{{ $order['addCheese'] ? 'Yes' : 'No' }}</td>
                        <td>{{ $order['price'] }}</td>
                    </tr>
                    @endforeach
                    <tr>
                        <td colspan="3" class="text-right"><strong>Total</strong></td>
                        <td><strong>RM{{ $total }}</strong></td>
                    </tr>
                </tbody>
            </table>
            <form method="post" id="clear_cart">
                @csrf
                <button type="submit" class="btn btn-danger">Clear Cart</button>
                <a href="{{ route('order.show') }}" class="btn btn-secondary" style="margin-left: 10px;">Order More</a>

            </form>
            @else
            <p>Your cart is empty.</p>
            <a href="{{ route('order.show') }}" class="btn btn-secondary" style="margin-left: 10px;">Order More</a>
            @endif
        </div>
    </div>


            
    </div>
</section>
@endsection
@push('scripts')
<script>
    $(document).ready(function() {
        $('#clear_cart').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '/cart',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {

                    Swal.fire({
                        title: 'Cart Cleared',
                        text: 'Your cart has been cleared',
                        icon: 'success',
                        showCancelButton: true,
                        cancelButtonText: 'Close',
                        confirmButtonText: 'New Order',
                    }).then((result) => {
                        if (result.isConfirmed) {
                            window.location.href = '/order';
                        } else {
                            window.location.href = '/cart';
                        }
                    });
                    
                },
                error: function(xhr) {
                    Swal.fire({
                        title: 'Error',
                        text: xhr.responseJSON.message,
                        icon: 'error'
                    });
                }
            });
        });
    });
</script>
@endpush

