@extends('main')

@section('content')
<section id="intro" class="wrapper style1 fullscreen fade-up" >
    <div class="inner" style="background-color: black; opacity:0.5; margin:20px;">
        <h1>Order your Fav Pizza 🍕 here !</h1>

        <form metdod="post" id="orderForm">
            @csrf
            <div class="form-group">
                <label for="size">Pizza Size</label>
                <select name="size" id="size" class="form-control">
                    <option> -- Select Size -- </option>
                    <option value="small">Small (RM15)</option>
                    <option value="medium">Medium (RM22)</option>
                    <option value="large">Large (RM30)</option>
                </select>
            </div>
            <div class="form-group" id="pepperoni-option">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="pepperoni" id="pepperoni">
                    <label class="form-check-label" for="pepperoni">Add Pepperoni (RM3 for small, RM5 for medium)</label>
                </div>
            </div>
            <div class="form-group">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" name="cheese" id="cheese">
                    <label class="form-check-label" for="cheese">Add Extra Cheese (RM6)</label>
                </div>
            </div>
            <button type="submit" class="btn btn-primary">Add to Cart</button>
        </form>
        <div class="mt-4">
            <a href="{{ route('cart.show') }}" class="btn btn-secondary">View Cart</a>
        </div>
    </div>
</body>
</html>

            
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
    $('#orderForm').on('submit', function(e) {
        e.preventDefault();

        $.ajax({
            url: '/order',
            type: 'POST',
            data: $(this).serialize(),
            success: function(response) {
                const addPepperoniEmoji = response.order.addPepperoni ? '✅' : '❌';
                const addCheeseEmoji = response.order.addCheese ? '✅' : '❌';

                Swal.fire({
                    title: 'Your order added to cart',
                    html: `<div style="align-items: center; padding: 10px;">
                            <table style="width: 100%; border-collapse: collapse; color: black !important;">
                                <tr>
                                    <td style="border: 1px solid grey; padding: 8px; font-weight: bold;">Pizza Size</td>
                                    <td style="border: 1px solid grey; padding: 8px;">${response.order.size}</td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid grey; padding: 8px; font-weight: bold;">Add Pepperoni</td>
                                    <td style="border: 1px solid grey; padding: 8px;">${addPepperoniEmoji}</td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid grey; padding: 8px; font-weight: bold;">Add Cheese</td>
                                    <td style="border: 1px solid grey; padding: 8px;">${addCheeseEmoji}</td>
                                </tr>
                                <tr>
                                    <td style="border: 1px solid grey; padding: 8px; font-weight: bold;">Total (RM)</td>
                                    <td style="border: 1px solid grey; padding: 8px;">${response.order.price}</td>
                                </tr>
                            </table>
                           </div>`,
                    icon: 'success',
                    showCancelButton: true,
                    confirmButtonText: 'Finish Order',
                    cancelButtonText: 'Continue Order',
                    customClass: {
                        confirmButton: 'swal-button',
                        cancelButton: 'swal-button',
                        container: 'swal-container'
                    }
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = '/cart';
                    } else {
                        $('#orderForm').trigger('reset');
                    }
                });
            },
        });
    });
});


    document.addEventListener('DOMContentLoaded', function() {
        const sizeSelect = document.querySelector('select[name="size"]');
        const pepperoniDiv = document.getElementById('pepperoni-option');

        sizeSelect.addEventListener('change', function() {
            if (this.value === 'large') {
                pepperoniDiv.style.display = 'none';
            } else {
                pepperoniDiv.style.display = 'block';
            }
        });

        // Trigger change event on page load to set initial state
        sizeSelect.dispatchEvent(new Event('change'));
    });
</script>

@endpush

