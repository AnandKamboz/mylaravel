<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Application for Cash Award</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f2f8f7;
            font-family: 'Segoe UI', sans-serif;
        }

        .header-bar {
            background-color: #008080;
            color: white;
            padding: 4px 15px;
            /* Smaller padding */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .main-logo,
        .gov-logo {
            height: 36px;
            /* Smaller logos */
        }

        .form-container {
            max-width: 360px;
            /* Even smaller width */
            margin: 30px auto;
            background-color: #ffffff;
            border-radius: 10px;
            padding: 20px 18px;
            /* Compact padding */
            box-shadow: 0 0 12px rgba(0, 0, 0, 0.04);
        }

        .form-title {
            color: #006666;
            font-weight: bold;
            font-size: 18px;
            text-align: center;
            margin-bottom: 6px;
        }

        .form-subtitle {
            font-size: 12px;
            color: #444;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-label {
            font-weight: 600;
            font-size: 14px;
        }

        .form-control,
        .form-select {
            border-radius: 8px;
            font-size: 14px;
            padding: 8px 10px;
        }

        .btn-submit {
            background-color: #008080;
            color: #fff;
            font-weight: 600;
            border-radius: 8px;
            padding: 8px;
            width: 100%;
            margin-top: 6px;
            transition: 0.3s;
            font-size: 15px;
        }

        .btn-submit:hover {
            background-color: #006666;
        }

        @media (max-width: 768px) {
            .header-bar {
                flex-direction: column;
                align-items: flex-start;
                gap: 8px;
            }

            .form-container {
                margin: 20px 15px;
                padding: 18px;
            }
        }

    </style>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.16.1/sweetalert2.min.js" integrity="sha512-LGHBR+kJ5jZSIzhhdfytPoEHzgaYuTRifq9g5l6ja6/k9NAOsAi5dQh4zQF6JIRB8cAYxTRedERUF+97/KuivQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert2/11.16.1/sweetalert2.css" integrity="sha512-fjO3Vy3QodX9c6G9AUmr6WuIaEPdGRxBjD7gjatG5gGylzYyrEq3U0q+smkG6CwIY0L8XALRFHh4KPHig0Q1ug==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>

    <!-- Header -->
    <div class="header-bar">
        <div class="d-flex align-items-center gap-2">
            <img src="your_logo_left.png" alt="Haryana Logo" class="main-logo">
            <span style="font-size: 13px;">sports[dot]hry[at]gmail[dot]com</span>
        </div>
        <div class="d-flex align-items-center gap-2">
            <span style="font-size: 13px;"><strong>📞</strong> 0172-2992868</span>
            <img src="your_logo_right.png" alt="Gov Logo" class="gov-logo">
        </div>
    </div>

    <!-- Titles -->
    <div class="text-center mt-3">
        <h6 class="fw-bold text-uppercase mb-1">Department of Sports Haryana</h6>
        <p class="fw-normal mb-1" style="font-size: 14px;">Cash Award Management System</p>
    </div>

    <!-- Form -->
    <div class="form-container">
        <div class="form-title">Application for Cash Award</div>
        <p class="form-subtitle">Achievements on or after <strong>01-04-2024</strong></p>

        <form>
            <!-- Family ID -->
            <div class="mb-2">
                <label for="familyId" class="form-label">Family ID <span class="text-danger">*</span></label>
                <input type="text" id="familyId" class="form-control" placeholder="e.g., 1kqp3440">
                <a id="get-member" class="btn btn-submit">Get Member</a>
            </div>

            <!-- Member -->
            <div class="mb-2 d-none">
                <label for="memberSelect" class="form-label">Select Member <span class="text-danger">*</span></label>
                <select id="memberSelect" class="form-select">
                    <option selected disabled value="">Choose...</option>
                    <option value="PINKI">PINKI</option>
                    <option value="RAJU">RAJU</option>
                    <option value="REKHA">REKHA</option>
                </select>
            </div>

            <!-- OTP -->
            <div class="mb-2 d-none">
                <label for="otp" class="form-label">Enter OTP <span class="text-danger">*</span></label>
                <input type="text" id="otp" class="form-control" placeholder="6-digit OTP">
            </div>

            <button type="submit" class="btn btn-submit d-none">Submit</button>
        </form>
    </div>
    <script>
        $(document).ready(function() {
            $('#get-member').on('click', function() {
                let familyId = $('#familyId').val();
                if (!familyId) {
                    Swal.fire({
                        icon: 'error'
                        , title: 'Missing Family ID'
                        , text: 'Please fill your family ID.'
                    , });
                    return false;
                }

                $.ajax({
                    url: "{{ route('get-members-details') }}",
                    type: 'GET',
                    data: {
                        familyId: familyId,
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#memberSelect').removeClass('d-none');
                            $('#otp').removeClass('d-none');
                            $('#get-member').addClass('d-none');
                            $('#memberSelect').html(response.data);
                        } else {
                            Swal.fire({
                                icon: 'error'
                                , title: 'Error'
                                , text: response.message
                            , });
                        }
                    },
                    error: function(xhr, status, error) {
                        Swal.fire({
                            icon: 'error'
                            , title: 'Error'
                            , text: 'An error occurred. Please try again.'
                        , });
                    }
                });

            })
        })

    </script>
</body>

</html>
