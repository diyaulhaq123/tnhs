
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="../../assets/vendor/libs/jquery/jquery.js"></script>
    <script src="../../assets/vendor/libs/popper/popper.js"></script>
    <script src="../../assets/vendor/js/bootstrap.js"></script>
    <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>
    <script src="../../assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js"></script>
    <script src="../../assets/vendor/libs/hammer/hammer.js"></script>
    <script src="../../assets/vendor/libs/i18n/i18n.js"></script>
    <script src="../../assets/vendor/libs/typeahead-js/typeahead.js"></script>
    <script src="../../assets/vendor/js/menu.js"></script>
    <!-- endbuild -->
    <!-- Main JS -->
    <script src="../../assets/js/main.js"></script>
    <!-- Page JS -->
    <script src="../../assets/js/ui-navbar.js"></script>
    @stack('scripts')

    {{-- <script src="https://js.paystack.co/v1/inline.js"></script>
    <script type="text/javascript" src="https://login.remita.net/payment/v1/remita-pay-inline.bundle.js"></script> --}}

    @if (session()->has('success'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
        Toast.fire({
            icon: 'success',
            title: '{{ session()->get('success') }}'
        })
    </script>
    @endif

    @if ($errors->any())
        @foreach ($errors->all() as $error)
            <script>
                const Toast = Swal.mixin({
                toast: true,
                position: 'bottom-end',
                showConfirmButton: false,
                timer: 5000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'warning',
                title: '{{ $error }}'
            })
            </script>
        @endforeach
    @endif

    @if (session()->has('error'))
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'bottom-end',
            showConfirmButton: false,
            timer: 5000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'error',
            title: '{{ session()->get('error') }}'
        })
    </script>
    @endif

    <script>
        $(".delete").click(function(e) {
            e.preventDefault();
            var form = $(this).closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: "Do you want to remove this record?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, remove it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

        $('#state_id').change(function(){
            var state_id = $(this).val();
            if(state_id){
                $.ajax({
                    url: '/api/get-lgas/' + state_id,
                    type: 'GET',
                    dataType: 'json',
                    success: function(data){
                        $('#lga_id').empty();

                        $('#lga_id').append('<option value="">Select LGA</option>');

                        $.each(data, function(key, value){
                            $('#lga_id').append('<option value="'+ value.id +'">'+ value.name +'</option>');
                        });
                    }
                });
            } else {
                $('#lga_id').empty();
                $('#lga_id').append('<option value="">Select LGA</option>');
            }
        });
    </script>

    <script>
        const paymentForm = document.getElementById('paymentForm');
        paymentForm.addEventListener("submit", payWithPaystack, false);
        // function payWithPaystack(e) {
        //   e.preventDefault(e);
        //   let handler = PaystackPop.setup({
        //     key: 'pk_test_79c177b5d6ef026f61c49c74393eb343fd6c7db4', // Replace with your public key
        //     secret_key: 'sk_test_fc63f9b6760aa2428cdfc17904ec921e10cee737',
        //     email: document.getElementById("email").value,
        //     amount: document.getElementById("amount").value * 100,
        //     ref: ''+Math.floor((Math.random() * 1000000000) + 1), // generates a pseudo-unique reference. Please replace with a reference you generated. Or remove the line entirely so our API will generate one for you
        //     // label: "Optional string that replaces customer email"
        //     onClose: function(){
        //       alert('Window closed.');
        //     },
        //     callback: function(response){
        //       let message = 'Payment complete! Reference: ' + response.reference;
        //       alert(message);
        //     }
        //   });
        //   handler.openIframe();
        // }

    </script>

  </body>
</html>
