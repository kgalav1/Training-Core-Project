<?php
include('../comman/header.php');
$main_invoice = new DbConnectivity1();

session_start();

if (!isset($_SESSION['name'])) {
    header('location:../loginsystem/login.php');
}
?>

<title>Project - Invoice Master</title>

</head>

<body id="body">

    <?php include('../comman/sidebar.php'); ?>

    <!------------------------------ Tabs Code ------------------------------->
    <div class="mybox" style="border-radius: 10px;">
        <div class="container-fluid bg-light p-3 rounded">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true"
                        onclick="invoicehide()">All
                        Invoice</button>

                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Add Invoice</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">

                <!------------------------------ All Users Form ------------------------------->

                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                    <div class="form mt-3">
                        <div class="mybox" style="padding: 1%; border-radius: 10px;">
                            <form class="mt-4 fw-bold">
                                <div class="mb-3 mx-3 d-inline-block" id="sinvoicenumberdiv">
                                    <label for="invoicenumber" class="form-label">Invoice Number</label>
                                    <input type="text" class="form-control" id="sinvoicenumber" name="sinvoicenumber"
                                        aria-describedby="invoicenumber" maxlength="3"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />

                                </div>

                                <div class="mb-3 mx-3 d-inline-block" id="snamediv">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="sname" name="sname"
                                        aria-describedby="username" maxlength="15"
                                        oninput=" this.value = this.value.replace(/[^A-za-z\s]/g, '');" />
                                </div>

                                <div class="mb-3 mx-3 d-inline-block" id="semaildiv">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control" id="semail" name="semail"
                                        aria-describedby="emailHelp" maxlength="50">
                                </div>

                                <div class="mb-3 mx-3 d-inline-block" id="sphonediv">
                                    <label for="phone" class="form-label">Phone No.</label>
                                    <input type="text" class="form-control" id="sphone" name="sphone"
                                        aria-describedby="emailHelp" maxlength="10"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                </div>

                                <div class="mt-3 mx-3 d-inline-block">
                                    <input type="hidden" name="action" id="action" value="invoice" />
                                    <button type="button" name="search" id="search" class="btn btn-primary"
                                        onclick="invoice_search();"><i
                                            class="fa-solid fa-magnifying-glass me-2"></i>Search</button>
                                </div>
                            </form>
                        </div>
                    </div>

                    <!-- --------------Table to fetch data--------------- -->

                    <div class="mybox mt-2" style="padding: 1%; border-radius: 10px;">
                        <div class="mb-1 ps-1">
                            <label for='number-dd'><b>No. of records :</b></label>
                            <select id='list' name='list' onchange="invoice_search()">
                                <option value='5'>5</option>
                                <option value='10'>10</option>
                                <option value='15'>15</option>
                            </select>
                        </div>
                        <div class="table-container" style="max-height: 335px;">
                            <table class="table table-striped">
                                <thead>
                                    <tr class="table-primary">
                                        <!-- <th>S No.</th> -->
                                        <th><a href="javascript:void(0);" class="asc"
                                                onclick="sort(`asc`, `invoice_id`)">
                                                Invoice Id<i class="fa fa-sort-asc d-asc" aria-hidden="true"
                                                    style="display: none; "></i></a>
                                            <a href="javascript:void(0);" class="desc"
                                                onclick="sort(`desc`, `invoice_id`)" style="display: none;">Invoice Id
                                                <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
                                        </th>
                                        <th><a href="javascript:void(0);" class="asc"
                                                onclick="sort(`asc`, `client_name`)">Client Name
                                                <i class="fa fa-sort-asc d-asc" aria-hidden="true"
                                                    style="display: none; "></i></a>
                                            <a href="javascript:void(0);" class="desc"
                                                onclick="sort(`desc`, `client_name`)" style="display: none;">Client Name
                                                <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
                                        </th>
                                        <th><a href="javascript:void(0);" class="asc"
                                                onclick="sort(`asc`, `email`)">Email
                                                <i class="fa fa-sort-asc d-asc" aria-hidden="true"
                                                    style="display: none; "></i></a>
                                            <a href="javascript:void(0);" class="desc" onclick="sort(`desc`, `email`)"
                                                style="display: none;">Email
                                                <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
                                        </th>
                                        <th><a href="javascript:void(0);" class="asc"
                                                onclick="sort(`asc`, `phone`)">Phone
                                                <i class="fa fa-sort-asc d-asc" aria-hidden="true"
                                                    style="display: none; "></i></a>
                                            <a href="javascript:void(0);" class="desc" onclick="sort(`desc`, `phone`)"
                                                style="display: none;">Phone
                                                <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
                                        </th>
                                        <th><a href="javascript:void(0);" class="asc"
                                                onclick="sort(`asc`, `address`)">Address
                                                <i class="fa fa-sort-asc d-asc" aria-hidden="true"
                                                    style="display: none; "></i></a>
                                            <a href="javascript:void(0);" class="desc" onclick="sort(`desc`, `address`)"
                                                style="display: none;">Address
                                                <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
                                        </th>
                                        <th><a href="javascript:void(0);" class="asc"
                                                onclick="sort(`asc`, `grand_total`)">Total Amount
                                                <i class="fa fa-sort-asc d-asc" aria-hidden="true"
                                                    style="display: none; "></i></a>
                                            <a href="javascript:void(0);" class="desc"
                                                onclick="sort(`desc`, `grand_total`)" style="display: none;">Total
                                                Amount
                                                <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
                                        </th>

                                        <th>Action</th>
                                        <th>Pdf</th>
                                        <th>Gmail</th>
                                    </tr>

                                </thead>
                                <tbody id="data"></tbody>
                            </table>
                            <div id="pagin" class="d-flex justify-content-start"></div>
                        </div>
                        <input type="hidden" id="sort_field" value="">
                        <input type="hidden" id="sort_type" value="">

                    </div>
                    <!-- Email Modal -->
                    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Email Details:</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                        aria-label="Close"></button>
                                </div>
                                <form id="email_send">
                                    <input type="hidden" name="invoice_id" id="invo_id" value="" />
                                    <div class="modal-body">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">To:</label>
                                            <input type="email" class="form-control" id="invoice_email" name="to"
                                                placeholder="name@example.com">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1" class="form-label">Subject:</label>
                                            <input type="text" class="form-control" id="invoice_subject" name="subject">
                                        </div>
                                        <div class="mb-3">
                                            <label for="exampleFormControlTextarea1" class="form-label">Body</label>
                                            <textarea class="form-control" id="invoice_body" name="body"
                                                rows="3"></textarea>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Close</button>
                                        <button type="button" class="btn btn-success" onclick="sendmail()">Send</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>

                <!------------------------------ Add Users Form ------------------------------->

                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                    <div class="form mt-3" id="addblock">
                        <div class="mybox" style="padding: 1%; border-radius: 10px;">
                            <form class="mt-4 fw-bold" id="add_name">
                                <input type="hidden" name="asno" id="asno">
                                <div class="form" id="invoiceclient">
                                    <div class="row mx-3">
                                        <div class="col-md-3 mb-1">
                                            <label for="number" class="form-label">Invoice Number</label>
                                            <div class="input-group input-group-md ">
                                                <?php
                                                $max = "SELECT max(invoice_id) as max FROM `main_invoice`";
                                                $max_result = $main_invoice->Execute($max);
                                                while ($max_row = mysqli_fetch_assoc($max_result)) {
                                                    $hey = $max_row['max'];
                                                ?>
                                                <span
                                                    class="input-group-text input-group-prepend input-group-md ">SAN</span>
                                                <input type="text" id="anumber" name="number"
                                                    class="form-control form-control-md input-group-md"
                                                    value="<?php echo $hey + 1 ?>" readonly />
                                                <?php
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="mb-3 col-md-3" id="datediv">
                                            <label for="date" class="form-label">Invoice date</label> <span
                                                class="formerror">*</span>
                                            <input type="date" class="form-control empty" id="adate" name="date"
                                                aria-describedby="emailHelp">
                                        </div>
                                    </div>
                                    <div class="row mx-3">
                                        <div class="mb-3 col-md-3" id="namediv">
                                            <label for="name" class="form-label">Client Name<span
                                                    style="color: red;">*</span></label> <span class="formerror"></span>
                                            <input type="text" class="form-control empty" id="aname" name="name"
                                                onkeypress="clientsearch()" aria-describedby="emailHelp" value=""
                                                maxlength="15" autocomplete="off">
                                        </div>

                                        <div class="mb-3 col-md-3" id="emaildiv">
                                            <label for="email" class="form-label">Email</label>
                                            <input type="email" class="form-control empty" id="aemail" name="email"
                                                value="" aria-describedby="emailHelp" readonly>
                                        </div>

                                        <div class="mb-3 col-md-3" id="phonediv">
                                            <label for="phone" class="form-label">Phone No.</label>
                                            <input type="text" class="form-control empty" id="aphone" name="phone"
                                                aria-describedby="emailHelp" readonly>
                                        </div>

                                        <div class="mb-3 col-md-3" id="addressdiv">
                                            <label for="address" class="form-label">Address</label>
                                            <input type="text" class="form-control empty" id="aaddress" name="address"
                                                aria-describedby="emailHelp" readonly>

                                            <!-- <a class="" id="client" href="clientmaster.php">Not Our Client?</a> -->
                                        </div>
                                    </div>
                                </div>

                                <div class="form" id="invoiceitem">
                                    <div class="mybox" style="padding: 1%; border-radius: 10px;">
                                        <div class="addMoreTable">
                                            <div class="row mx-3">
                                                <table class="table table-light table-striped" id="itemTable">
                                                    <thead>
                                                        <tr>
                                                            <th>Item Name</th>
                                                            <th>Item Price</th>
                                                            <th>Item Quantity</th>
                                                            <th>Amount</th>
                                                            <th>Action</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody id="dynamic_item">
                                                        <tr class='tr_input' id='row_'>
                                                            <td class="d-none"><input type="hidden" name="itemsno[]"
                                                                    class="itemsno">
                                                            </td>
                                                            <td><input type='text' id='itemname_1' class='itemname not'
                                                                    name='itemname[]' placeholder='Enter Item Name'
                                                                    value="" onkeypress="itemsearch()"
                                                                    autocomplete="off"></td>
                                                            <td><input type='text' class="itemprice" name='itemprice[]'
                                                                    id='itemprice_1' value="" dir="rtl" readonly>
                                                            </td>
                                                            <td><input type='number' class="itemquantity"
                                                                    id='itemquantity_1' value="" name='itemquantity[]'
                                                                    min="1" style="text-align: right;"></td>
                                                            <td><input type='text' class="itemamount" id="itemamount_1"
                                                                    name='itemamount[]' dir="rtl" readonly></td>
                                                            <td><button type='button' class='bremove d-none'
                                                                    id="delete"><img style='width:24px'
                                                                        src='../assets/images/delete.png'
                                                                        alt='send'></button></td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-3">
                                    <div class="col-md-8">
                                        <button type="button" name="addmore" id="addmore"
                                            class="btn btn-outline-success ms-4" onclick="addHide();">Add
                                            More</button>
                                    </div>
                                    <div class="col-md-2" style="max-width: 135px; margin-top: 5px;">
                                        <label for="TotalAmount" class="form-label fw-bold">Total Amount:</label>
                                    </div>
                                    <div class="col-md-2" id="tamountdiv">
                                        <input type="text" class="form-control empty" id="tamount" name="tamount"
                                            aria-describedby="emailHelp" readonly>
                                    </div>

                                    <div class="row mt-4 mb-4">
                                        <div class="col-md-11">

                                        </div>
                                        <div class="col-md-1">
                                            <input type="hidden" name="form_action" id="form_action" value="insert" />
                                            <input type="submit" name="submit" id="submit" class="btn btn-primary"
                                                value="Save" />
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        <?php include('../comman/footer.php'); ?>

        <script>
        $(document).ready(function() {
            $(document).on("click", "#pagi a", function(e) {
                e.preventDefault();
                var page_id = $(this).attr("id");
                invoice_search(page_id);
            })

            invoice_search();

            var date = new Date();
            var NewDate = date.getFullYear().toString() + '-' + (date.getMonth() + 1).toString().padStart(2,
                    0) +
                '-' + date.getDate().toString().padStart(2, 0);
            $("#adate").val(NewDate);

            $("#side_invoice").addClass("active");
        });
        </script>

        <script>
        //------------------------------ Edit time details fill code-----------------------------------------

        function invoiceEdit(id) {
            var invoice_id = id;
            $.ajax({
                url: "invoiceAll.php",
                type: 'POST',
                dataType: "json",
                async: "false",
                mode: "abort",
                asyn: false,
                data: {
                    type: 'editdetailsfill',
                    invoice_id: invoice_id,
                },
                success: function(responce) {
                    invoiceTabShow();
                    console.log(responce);
                    $("#asno").val(responce[0]["client_id"]);
                    $('#anumber').val(responce[0]["invoice_id"])
                    $('#adate').val(responce[0]["invoice_date"])
                    $('#aname').val(responce[0]["client_name"])
                    $('#aemail').val(responce[0]["email"])
                    $('#aphone').val(responce[0]["phone"])
                    $('#aaddress').val(responce[0]["full_address"])
                    $("#tamount").val(responce[0]["grand_total"]);
                    $("#adate").prop("readonly", true);
                    $('#form_action').val("edit");
                    $('#submit').val("Update");

                    var prnt = $(".itemname").parent().parent().parent();
                    var trFrstChild = prnt.find("tr:first-child");
                    var itemdata = "";

                    for (var i = 0; i < responce.length; i++) {

                        if (i == 0) {
                            trFrstChild.find(".itemsno").val(responce[i]["item_id"])
                            trFrstChild.find(".itemname").val(responce[i]["name"]);
                            trFrstChild.find(".itemprice").val(responce[i]["item_price"])
                            trFrstChild.find(".itemquantity").val(responce[i]["item_quantity"])
                            trFrstChild.find(".itemamount").val(responce[i]["item_amount"])
                        } else {
                            $('#delete').removeClass('d-none');
                            var cloneChild = trFrstChild.clone();
                            cloneChild.find(".itemsno").val(responce[i]["item_id"])
                            cloneChild.find(".itemname").val(responce[i]["name"]);
                            cloneChild.find(".itemprice").val(responce[i]["item_price"])
                            cloneChild.find(".itemquantity").val(responce[i]["item_quantity"])
                            cloneChild.find(".itemamount").val(responce[i]["item_amount"])

                            $('#dynamic_item').append(cloneChild);
                            CalculateGrandTotal();

                        }
                    }
                }
            });
        }

        //------------------------------ Invoice Submit And Edit-----------------------------------------

        $('#add_name').on('submit', function(event) {
            event.preventDefault();
            var data = new FormData(this);
            data.append('type', "addupdate");
            var valueitem = validateInvoice();
            if (valueitem == true) {
                $.ajax({
                    url: "invoiceAll.php",
                    type: "POST",
                    data: data,
                    contentType: false,
                    cache: false,
                    processData: false,
                    success: function(data) {
                        if (data == "2") {
                            $.notify("Record Saved Successfully", {
                                globalPosition: 'bottom right',
                                className: 'success'
                            });
                            setTimeout("window.location.reload()", 1500);
                        } else if (data == '3') {
                            $.notify("Record Edit Successfully", {
                                globalPosition: 'bottom right',
                                className: 'success'
                            });
                            setTimeout("window.location.reload()", 1500);
                        } else {
                            $.notify(data, {
                                globalPosition: 'bottom right',
                                className: 'error'
                            })
                        }
                    }
                });
            } else {
                return false;
            }
        });

        //------------------------------ Invoice Client Autofill-----------------------------------------
        function clientsearch() {
            $('#aname').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "invoiceAll.php",
                        type: 'POST',
                        dataType: "json",
                        async: "false",
                        mode: "abort",
                        asyn: false,
                        data: {
                            type: 'clientautofill',
                            search: request.term
                        },
                        beforeSend: function() {},
                        success: function(responce) {
                            response($.map(responce, function(client, input) {
                                return {
                                    label: client.client_name,
                                    value: client.client_name,
                                    sno: client.sno,
                                    email: client.email,
                                    phone: client.phone,
                                    address: client.address,
                                }
                            }));
                        }
                    })
                },
                minLength: 0,
                selectFirst: true,
                selectOnly: true,
                select: function(event, ui) {
                    $('#asno').val(ui.item.sno);
                    $('#aemail').val(ui.item.email);
                    $('#aphone').val(ui.item.phone);
                    $('#aaddress').val(ui.item.address);
                },
                focus: function(event, ui) {}
            }).focus(function() {
                $(this).autocomplete("search");
            });
        };

        //------------------------------ Invoice Item Autofill-----------------------------------------

        function itemsearch() {
            $('.itemname').autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "invoiceAll.php",
                        type: 'POST',
                        dataType: "json",
                        async: "false",
                        mode: "abort",
                        asyn: false,
                        data: {
                            type: 'itemautofill',
                            search: request.term
                        },
                        beforeSend: function() {},
                        success: function(responce) {
                            response($.map(responce, function(item, input) {
                                return {
                                    label: item.name,
                                    value: item.name,
                                    sno: item.sno,
                                    price: item.price,
                                }
                            }));
                        }
                    })
                },
                minLength: 0,
                selectFirst: true,
                selectOnly: true,
                select: function(event, ui) {
                    var parentTr = $(this).parents('tr');
                    parentTr.find('.itemsno').val(ui.item.sno).trigger('change');
                    parentTr.find('.itemprice').val(ui.item.price).trigger('change');
                    parentTr.find('.itemquantity').val(1).trigger('change');

                },
                focus: function(event, ui) {}
            }).focus(function() {
                $(this).autocomplete("search");

            });
        };

        // ---------------------------------------------Mail code-----------------------------------

        function sendmail() {
            Overlay.show('overlay', 'Sending you an email...')
           var id = $("#invo_id").val();
            var to = $("#invoice_email").val();
            var subject = $("#invoice_subject").val();
            var emailbody = $("#invoice_body").val();
            $.ajax({
                type: "POST",
                url: "invoiceAll.php",
                data: {
                    id: id,
                    to: to,
                    subject: subject,
                    emailbody: emailbody,
                    type: "sendmail"
                },
                dataType: 'json',
                success: function(data) {
                    Overlay.hide('overlay');
                    $("#exampleModal").modal('toggle');
                    $.notify("Email Send successful", {
                        globalPosition: 'bottom right',
                        className: 'success'
                    });
                },
            });
        }

        // ---------------------------------------------Pdf code-----------------------------------

        function Getpdf(id, url) {
            $.ajax({
                url: url,
                data: {
                    id: id,
                    type: 'pdfshow'
                },
                type: "POST",
                dataType: 'JSON',
                success: function(data) {
                    if (data.result != undefined) {

                        window.open(data.result, '_blank');
                    }
                }
            })
        }

        // ------------------------------------ Subtotal --------------------------------------------

        $("table").on("change", "input", function Total() {
            var row = $(this).closest("tr");
            var qty = parseFloat(row.find(".itemquantity").val());
            var price = parseFloat(row.find(".itemprice").val());
            var total = qty * price;
            row.find(".itemamount").val(isNaN(total) ? "" : total);
            CalculateGrandTotal();
        });

        // ------------------------------------ Grandtotal --------------------------------------------

        function CalculateGrandTotal() {
            var grandTotal = 0;
            $.each($('table').find('.itemamount'), function() {
                if ($(this).val() != '' && !isNaN($(this).val())) {
                    grandTotal += parseFloat($(this).val());
                }
            });
            $('#tamount').val(grandTotal);
        }

        function empty() {
            var client = $("#aname").val();
            if (client.lenght == 0) {
                $("#aemail").val("");
                $("#aphone").val("");
                $("#aaddress").val("");
            }
        }

        // ---------------------------------- Add More ------------------------------------------------

        $('#addmore').click(function() {

            // Get last id 
            var lastname_id = $('.tr_input input[type=text]:nth-child(1)').last().attr('id');
            var split_id = lastname_id.split('_');

            // New index
            var index = Number(split_id[1]) + 1;

            // Create row with input elements
            var html = "<tr class='tr_input append_item' id='row_" + index +
                "'> <td class='d-none'><input type='hidden' name='itemsno[]' class='itemsno'></td><td><input type='text' class='itemname' name='itemname[]' id='itemname_" +
                index +
                "' placeholder='Enter Item Name' onkeypress='itemsearch()'></td><td><input type='text' class='itemprice' name='itemprice[]' id='itemprice_" +
                index +
                "' dir='rtl' readonly></td><td><input type='number' class='itemquantity' min='1' name='itemquantity[]' id='itemquantity_" +
                index +
                " .'style='text-align: right;''.'></td><td><input type='text' class='itemamount' name='itemamount[]' id='itemamount_" +
                index +
                "' dir='rtl' readonly></td> <td><button type='button' class='bremove' id='delete'><img style='width:24px' src='../assets/images/delete.png' alt='delete'></button></td></tr>";

            // Append data
            $('tbody').append(html);
            CalculateGrandTotal();

        });
        $(document).on('click', '#delete', function(e) {
            e.preventDefault();
            $(this).parents('tr').first().remove();
            CalculateGrandTotal();
            addHide();
        });

        $(document).on('click', '#mail', function() {
            var currentRow = $(this).closest("tr");
            var id = currentRow.find("td:eq(0)").text();
            var name = currentRow.find("td:eq(1)").text();
            var email = currentRow.find("td:eq(2)").text();
            console.log(id, name, email);
            $('#invo_id').val(id);
            $('#invoice_email').val(email);
            $("#invoice_subject").val("Invoice Details").css({
                'font-weight': 'bold'
            });
            $("#invoice_body").val("Hi " + name + ", Please Find your invoice. Thanks for choosing us.");
        });
        </script>

</body>

</html>