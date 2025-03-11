<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        .t-text{
            font-size: 13px
        }
        .h-text{
            border-bottom: 1px solid rgb(247, 243, 243)
        }
    </style>
  </head>
  <body>
    <div class="container">
        <div class="row justify-content-center p-3">
            <div class="col-8">
                <div class="card" style="border:0px solid white">
                    <div class="row justify-content-between ">
                        <div class="col-5 m-2">
                            <h5 class="" style="color: rgb(165, 115, 21); ">e-Invoice</h5>
                            <div style="font-size:12px; ">Paid on 1st May, 2024</div>
                        </div>
                        <div class="col-6 text-right">
                            <div class="card p-2 m-1" style="background:rgb(191, 210, 191); border-radius:0; border:0px solid white;">
                                <h6>Remita Retrieval Reference (RRR):</h6>
                                <h4>2344-0135-9875</h4>
                                <div class="row justify-content-center" style="color: rgb(165, 115, 21); font-size:12px">This is not a reciept</div>
                            </div>
                        </div>
                    </div>

                    <div class="card p-3 " style="border:0px solid white">
                        <div class="row" style="background: rgb(210, 184, 134)">Biller Information</div>
                        <div class="">
                            <table class="table">
                                <tr>
                                    <div class="row" style="background: rgb(177, 211, 177)">
                                        <div class="col-3 ms-2" style="background: rgb(177, 211, 177)">
                                            <div class="t-text h-text">NAME</div>
                                            <div class="t-text h-text">ADDRESS</div>
                                            <div class="t-text h-text">PHONE NUMBER</div>
                                            <div class="t-text h-text">EMAIL</div>
                                            <div class="t-text h-text">TAX NUMBER</div>
                                        </div>
                                        <div class="col-8 " style="background:rgb(191, 210, 191)">
                                            <div class="t-text">UNIVERSITY OF IBADAN - 1000107</div>
                                            <div class="t-text">IBADAN</div>
                                            <div class="t-text"></div>
                                            <div class="t-text"></div>
                                            <div class="t-text">0145675-0001</div>
                                        </div>
                                    </div>
                                </tr>
                            </table>
                        </div>

                        <div class="row" style="background: rgb(210, 184, 134)">Payer Information</div>
                        <div class="">
                            <table class="table">
                                <tr>
                                    <div class="row" style="background: rgb(177, 211, 177)">
                                        <div class="col-3 ms-2" style="background: rgb(177, 211, 177)">
                                            <div class="t-text h-text">NAME</div>
                                            <div class="t-text h-text">PHONE NUMBER</div>
                                            <div class="t-text h-text">EMAIL</div>
                                        </div>
                                        <div class="col-8 " style="background:rgb(191, 210, 191)">
                                            <div class="t-text">JOY ENE ONUH</div>
                                            <div class="t-text">090978787660</div>
                                            <div class="t-text">EMAIL</div>
                                        </div>
                                    </div>
                                </tr>
                            </table>
                        </div>

                        <div class="row" style="background: rgb(210, 184, 134)">Payement Details</div>
                        <div class="">
                            <table class="table">
                                <tr>
                                    <div class="row justify-content-between" style="background: rgb(177, 211, 177)">

                                        <div class="row ms-0 justify-content-between" style="background: rgb(145, 191, 145)">
                                            <div class="col-8" style="font-size: 9px;" >
                                                <span>DESCRIPTION</span>
                                            </div>
                                            <div class="col-3">
                                                <span style="float:right; font-size: 9px;"> AMOUNT (NGN)</span>
                                            </div>
                                        </div>

                                        <div class="col-8 ms-2">
                                            <div class="t-text">Being amount payable in respect of Grants UI: MCrl Analytic Services</div>
                                            <div class="t-text" style="float:right">*Charges</div><br>
                                            <div class="t-text" style="float:right">VAT Amount</div>
                                        </div>
                                        <div class="col-3 " >
                                            <div class="t-text" style="float:right;">1,750.00</div><br>
                                            <div class="t-text" style="float:right;">157.50</div><br>
                                            <div class="t-text" style="float:right;">0.00</div>
                                        </div>

                                        <div class="row ms-0 justify-content-between" style="background: rgb(145, 191, 145)">
                                            <div class="col-8" style="" >
                                                <b style="float:right">Total</b>
                                            </div>
                                            <div class="col-3">
                                                <b style="float:right; ;"> 1,907.50</b>
                                            </div>
                                        </div>

                                    </div>
                                </tr>
                            </table>
                        </div>

                        <div class="row justify-content-between">
                            <div class="col-4">
                                <div class="card m-2 p-0" style="border-radius:0;">
                                  {{-- <div>Scan Barcode below </div> --}}
                                  <div class="d-flex justify-content-center">
                                  <img src="{{ asset('assets/img/qr1.jpg') }}" width="170px" height="170px" alt="QR Code">
                                 </div>
                                </div>
                            </div>
                            <div class="col-8"></div>
                        </div>


                    </div>



                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  </body>
</html>

{{-- <div class="row" style="background: rgb(210, 184, 134)">BILLER-REQUIRED INFORMATION</div> --}}
{{-- <div class="">
    <table class="table">
        <tr>
            <div class="row justify-content-between" style="background: rgb(177, 211, 177)">

                <div class="row ms-0 justify-content-between" style="background: rgb(145, 191, 145)">
                    <div class="col-6" style="font-size: 10px;" >
                        <b>ITEM</b>
                    </div>
                    <div class="col-6">
                        <b style="float:left; font-size: 10px;"> DESCRIPTION</b>
                    </div>
                </div>
                <div class="row ms-0 justify-content-between" style="background:white">
                    <div class="col-6" style="font-size: 10px;" >
                            <div class="t-text">Gifmis Code - (If Unknown Contact Mda)</div>
                            <div class="t-text">Purposes</div><br>
                    </div>
                    <div class="col-6">
                        <div class="t-text" style="float:right;"></div><br>
                        <div class="t-text" style="float:right;">Payment INTO MCRL ACCOUNT 7/181/47</div>
                    </div>
                </div>



            </div>
        </tr>
    </table>
</div> --}}
