<!DOCTYPE html>

<html
  lang="en"
  class="light-style layout-navbar-fixed layout-menu-fixed layout-compact"
  dir="ltr"
  data-theme="theme-default"
  data-assets-path="../../assets/"
  data-template="vertical-menu-template">
  <head>
    <meta charset="utf-8" />
    <meta
      name="viewport"
      content="width=device-width, initial-scale=1.0, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0" />
    <title>Nigerian Hypertensive Society Receipt</title>
    <meta name="description" content="" />
    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="../../assets/img/favicon/favicon.ico" />

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <!-- Icons -->
    <link rel="stylesheet" href="../../assets/vendor/fonts/tabler-icons.css" />

    <!-- Core CSS -->
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/core.css" class="template-customizer-core-css" />
    <link rel="stylesheet" href="../../assets/vendor/css/rtl/theme-default.css" class="template-customizer-theme-css" />
    <link rel="stylesheet" href="../../assets/css/demo.css" />
    <link rel="stylesheet" href="../../assets/vendor/libs/node-waves/node-waves.css" />
    <style>
        @media print {
            /* Ensure the print div is the right width */
            #printDiv {
                width: 200mm; /* Adjust width for thermal printers (e.g., 80mm receipt printer) */
                font-size: 12px; /* Adjust text size for better fit */
            }

            /* Hide everything else on the page */
            body * {
                visibility: hidden;
            }

            #printDiv, #printDiv * {
                visibility: visible;
            }

            #printDiv {
                position: relative;
                left: 0;
                top: 0;
                margin: 0 auto;
                padding: 5px;
            }
        }

    </style>
  </head>
    <body>
        <div class="row justify-content-center">
            <div class="col-12 mt-2">
                <div class="col-3 float-end">
                    <button class="btn btn-primary btn-sm" id="printBtn"><i class="ti ti-printer"></i></button>
                </div>
            </div>
            <div class="col-xl-6 col-md-6 col-12 mb-md-0 mb-4">
                <div class="card invoice-preview-card mt-4" id="printDiv">
                    <div class="card-body">
                        <div class="d-flex justify-content-between flex-xl-row flex-md-column flex-sm-row flex-column m-sm-3 m-0">
                            <div class="mb-xl-0 mb-4">
                                <div class="d-flex svg-illustration mb-4 gap-2 align-items-center">
                                <svg width="32" height="22" viewBox="0 0 32 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M0.00172773 0V6.85398C0.00172773 6.85398 -0.133178 9.01207 1.98092 10.8388L13.6912 21.9964L19.7809 21.9181L18.8042 9.88248L16.4951 7.17289L9.23799 0H0.00172773Z" fill="#7367F0"></path>
                                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M7.69824 16.4364L12.5199 3.23696L16.5541 7.25596L7.69824 16.4364Z" fill="#161616"></path>
                                    <path opacity="0.06" fill-rule="evenodd" clip-rule="evenodd" d="M8.07751 15.9175L13.9419 4.63989L16.5849 7.28475L8.07751 15.9175Z" fill="#161616"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M7.77295 16.3566L23.6563 0H32V6.88383C32 6.88383 31.8262 9.17836 30.6591 10.4057L19.7824 22H13.6938L7.77295 16.3566Z" fill="#7367F0"></path>
                                </svg>

                                <span class="app-brand-text fw-bold fs-4"> Nigerian Hypertensive Society </span>
                                </div>
                                <p class="mb-2">Office 149, 450 South Brand Brooklyn</p>
                                <p class="mb-2">San Diego County, CA 91905, USA</p>
                                <p class="mb-0">+1 (123) 456 7891, +44 (876) 543 2198</p>
                            </div>
                            <div>
                                <h4 class="fw-medium mb-2">INVOICE #{{ $receipt->reference }}</h4>
                                <div class="mb-2 pt-1">
                                <span>Date Paid:</span>
                                <span class="fw-medium">{{ date('F d, Y', strtotime($receipt->created_at)) }}</span>
                                </div>
                                <div class="pt-1">
                                <span>Date Printed:</span>
                                <span class="fw-medium">{{ date('F d, Y', strtotime(date('Y-m-d'))) }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <hr class="my-0">
                    <div class="card-body">
                        <div class="row p-sm-3 p-0">
                            <div class="col-xl-6 col-md-12 col-sm-5 col-12 mb-xl-0 mb-md-4 mb-sm-0 mb-4">
                                <h6 class="mb-3">Invoice To:</h6>
                                <p class="mb-1">{{ $receipt->user?->name ?? 'NA' }}</p>
                                <p class="mb-1">{{ ucfirst($receipt->user?->profile->address_line_1 ?? 'NA' ) }}</p>
                                <p class="mb-1">{{ ucfirst($receipt->user?->profile->phone_number ?? 'NA' ) }}</p>
                                <p class="mb-0">{{ $receipt->user?->email  ?? 'NA' }}</p>
                            </div>
                            <div class="col-xl-6 col-md-12 col-sm-7 col-12">
                                {{-- <h6 class="mb-4">Bill To:</h6>
                                <table>
                                <tbody>
                                    <tr>
                                    <td class="pe-4">Total Due:</td>
                                    <td class="fw-medium">$12,110.55</td>
                                    </tr>
                                    <tr>
                                    <td class="pe-4">Bank name:</td>
                                    <td>American Bank</td>
                                    </tr>
                                    <tr>
                                    <td class="pe-4">Country:</td>
                                    <td>United States</td>
                                    </tr>
                                    <tr>
                                    <td class="pe-4">IBAN:</td>
                                    <td>ETD95476213874685</td>
                                    </tr>
                                    <tr>
                                    <td class="pe-4">SWIFT code:</td>
                                    <td>BR91905</td>
                                    </tr>
                                </tbody>
                                </table> --}}
                            </div>
                        </div>
                    </div>
                    <div class="table-responsive border-top">
                        <table class="table m-0">
                        <thead>
                            <tr>
                            <th>Payment Type</th>
                            <th>Description</th>
                            <th>Amount Due</th>
                            <th>Amount Paid</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                            <td class="text-nowrap">{{ $receipt->paymentType() }}</td>
                            <td class="text-nowrap">{{ $receipt->paymentType() }}</td>
                            <td>₦{{ number_format($receipt->user?->memberType->fee, 2) }}</td>
                            <td>₦{{ number_format($receipt->amount, 2) }}</td>
                            </tr>

                            <tr>
                            <td colspan="3" class="align-top px-4 py-4">
                                <span class="ms-3">Thanks for your Payment</span>
                                <p class="mb-2 mt-3">
                                    <span class="ms-3 fw-medium">Sign:</span>
                                    <span>Management</span>
                                    </p>
                            </td>
                            <td class="text-end pe-3 py-4">
                                {{-- <p class="mb-2 pt-3">Subtotal:</p>
                                <p class="mb-2">Discount:</p>
                                <p class="mb-2">Tax:</p> --}}
                                <p class="mb-0 pb-3">Total:</p>
                            </td>
                            <td class="ps-2 py-4">
                                {{-- <p class="fw-medium mb-2 pt-3">$154.25</p>
                                <p class="fw-medium mb-2">$00.00</p>
                                <p class="fw-medium mb-2">$50.00</p> --}}
                                <p class="fw-medium mb-0 pb-3">₦{{ number_format($receipt->amount, 2) }}</p>
                            </td>
                            </tr>
                        </tbody>
                        </table>
                    </div>

                    {{-- <div class="card-body mx-3">
                        <div class="row">
                        <div class="col-12">
                            <span class="fw-medium">Note:</span>
                            <span>It was a pleasure working with you and your team. We hope you will keep us in mind for
                            future freelance projects. Thank You!</span>
                        </div>
                        </div>
                    </div> --}}
                </div>
            </div>

        </div>
        <script src="../../assets/vendor/js/bootstrap.js"></script>
        <script src="../../assets/vendor/libs/node-waves/node-waves.js"></script>
        <script src="../../assets/js/main.js"></script>
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="https://rawgit.com/DoersGuild/jQuery.print/master/jQuery.print.js"></script>

        <script>
            $(document).ready(function(){
                $('#printBtn').click(function(){
                    $('#printDiv').print();
                });
            });
        </script>
    </body>
</html>
