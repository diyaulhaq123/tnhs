
    <!-- Core JS -->
    <!-- build:js assets/vendor/js/core.js -->

    <script src="{{ asset('assets/vendor/libs/jquery/jquery.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/popper/popper.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/node-waves/node-waves.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/perfect-scrollbar/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/hammer/hammer.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/i18n/i18n.js') }}"></script>
    <script src="{{ asset('assets/vendor/libs/typeahead-js/typeahead.js') }}"></script>
    <script src="{{ asset('assets/vendor/js/menu.js') }}"></script>
    <!-- endbuild -->
    <!-- Main JS -->
    <script src="{{ asset('assets/js/main.js') }}"></script>
    <!-- Page JS -->
    <script src="{{ asset('assets/js/ui-navbar.js') }}"></script>
    <script  src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    @stack('scripts')

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
                toastr.error('{{ $error }}', 'Warning');
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

  </body>
</html>
