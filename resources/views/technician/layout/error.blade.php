<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

@if (session('success'))
    <script>
        $(document).ready(function() {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "timeOut": 500000
            }
            toastr.success("{{ session('success') }}");
        });
    </script>
@endif

@if (session('error'))
    <script>
        $(document).ready(function() {
            toastr.options = {
                "closeButton": true,
                "progressBar": true,
                "positionClass": "toast-bottom-right",
                "timeOut": 10000
            }
            toastr.error("{{ session('error') }}");
        });
    </script>
@endif

@if (session('errors'))
    <script>
        $(document).ready(function() {
            @foreach ($errors->all() as $error)
                toastr.options = {
                    "closeButton": true,
                    "progressBar": true,
                    "positionClass": "toast-bottom-right",
                    "timeOut": 10000
                }
                toastr.error("{{ $error }}");
            @endforeach
        });
    </script>
@endif
