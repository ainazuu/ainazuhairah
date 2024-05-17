@extends('main')

@section('content')
<section id="intro" class="wrapper style1 fullscreen fade-up">
    <div class="inner">
        <h1>Password Generator</h1>
        <p>Generate a random password with the options you choose</p>
        <form id="passwordForm">
            @csrf
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="password" id="password">
                <label for="passwordLength">Password length</label>
                <input type="number" name="passwordLength" id="passwordLength" placeholder="Enter password length" style="width: 20%; border-radius: 25px; text-align: center;">
            </div>
            <div style="margin-top:20px;">
                <label>Character Type</label>
                <div class="options" style="margin:20px">
                    <input type="checkbox" name="uppercase" id="uppercase">
                    <label for="uppercase">Uppercase</label>
                </div>
                <div class="options" style="margin:20px">
                    <input type="checkbox" name="lowercase" id="lowercase">
                    <label for="lowercase">Lowercase</label>
                </div>
                <div class="options" style="margin:20px">
                    <input type="checkbox" name="numbers" id="numbers">
                    <label for="numbers">Numbers</label>
                </div>
                <div class="options" style="margin:20px">
                    <input type="checkbox" name="symbols" id="symbols">
                    <label for="symbols">Symbols</label>
                </div>
            </div>
            <button type="submit" id="generate" class="primary">Generate Password</button>
        </form>
    </div>
</section>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('#passwordForm').on('submit', function(e) {
            e.preventDefault();

            $.ajax({
                url: '/generate',
                type: 'POST',
                data: $(this).serialize(),
                success: function(response) {
                    Swal.fire({
                        title: 'Generated Password',
                        html: `<div style=" align-items: center; border:1px solid grey; border-radius:25px;">
                                <span id="generated-password">${response.password}</span>
                                <button id="copy-button" onclick="copyPassword()" style="font-size:larger; cursor: pointer; "> Copy 📋</button>
                                <span id="tooltip" style="visibility: hidden; background-color: #555; color: #fff; text-align: center; border-radius: 5px; padding: 5px; z-index: 1;">Copied!</span>
                            </div>`,
                        icon: 'success',
                        customClass: {
                            confirmButton: 'swal-button',
                            container: 'swal-container'
                        }
                    });
                },
                error: function(response) {
                    let errors = response.responseJSON.errors;
                    let errorMessage = '';
                    for (let key in errors) {
                        errorMessage += errors[key][0] + '\n';
                    }
                    Swal.fire({
                        title: 'Error!',
                        text: errorMessage,
                        icon: 'error',
                        customClass: {
                            confirmButton: 'swal-button',
                            container: 'swal-container'
                        }
                    });
                }
            });
        });
    });

    // Function to copy the password to the clipboard and show the tooltip
    function copyPassword() {
        var password = document.getElementById('generated-password').textContent;
        var tempInput = document.createElement('input');
        tempInput.value = password;
        document.body.appendChild(tempInput);
        tempInput.select();
        document.execCommand('copy');
        document.body.removeChild(tempInput);

        // Show the tooltip
        var tooltip = document.getElementById('tooltip');
        tooltip.style.visibility = 'visible';

        // Hide the tooltip after 1.5 seconds
        setTimeout(function() {
            tooltip.style.visibility = 'hidden';
        }, 1500);
    }
</script>
@endpush
