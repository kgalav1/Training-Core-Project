
// Function for load table and retrive data
function LoadTable(which_catag) {
    var which = which_catag;
    $('#which').val(which);
    var Serializearray = $('#search').serializeArray();
    var arr = [];
    if (which == "user") {
        $.each(Serializearray, function (i, field) {
            arr.push(field.value)
        })
        var search_name = arr[0];
        var search_email = arr[1];
        var search_number = arr[2];
        var sort_field = $("#sort_field").val() == "" ? "username" : $("#sort_field").val();
    }
    if (which == "client") {
        $.each(Serializearray, function (i, field) {
            arr.push(field.value)
        })
        search_name = arr[0];
        search_email = arr[1];
        search_number = arr[2];
        var search_address = arr[3];
        var search_state = arr[4];
        var search_city = arr[5];
        var sort_field = $("#sort_field").val() == "" ? "Name" : $("#sort_field").val();
    }
    if (which == "item") {
        $.each(Serializearray, function (i, field) {
            arr.push(field.value)
        })
        search_name = arr[0];
        var search_price = arr[1]
        var sort_field = $("#sort_field").val() == "" ? "name" : $("#sort_field").val();
    }
    if (which == "invoice") {
        $.each(Serializearray, function (i, field) {
            arr.push(field.value)
        })
        var search_invoiceno = arr[0];
        var search_client_name = arr[1];
        var search_client_email = arr[2];
        var search_client_number = arr[3]
        var sort_field = $("#sort_field").val() == "" ? "invoice_id" : $("#sort_field").val();
    }
    var type = "Load";
   
    var sort_type = $("#sort_type").val() == "" ? "asc" : $("#sort_type").val();
    var limits = $('#limit').val() == "" ? "5" : $('#limit').val();
    var page = $('#page').val() == "" ? "1" : $('#page').val();
    $.ajax({
        data: {
            type: type,
            sort_field: sort_field,
            sort_type: sort_type,
            setlimit: limits,
            page_NO: page,
            search_name: search_name,
            search_price: search_price,
            search_email: search_email,
            search_number: search_number,
            search_address: search_address,
            search_state: search_state,
            search_city: search_city,
            search_invoiceno: search_invoiceno,
            search_client_name: search_client_name,
            search_client_email: search_client_email,
            search_client_number: search_client_number
        },
        url: "load.php",
        type: 'POST',
        dataType: 'json',
        success: function (data) {
            if (data != 1)
                $("#all_record").html(data.data);
            else
                $("#all_record").html("<h1 class='text-center mt-5' >NO DATA FOUND!</h1>");
        }
    })
    pagination(which)
}

//pagination........
function pagination(which_catag) {
    var sort_field = $("#sort_field").val() == "" ? "id" : $("#sort_field").val();
    var sort_type = $("#sort_type").val() == "" ? "asc" : $("#sort_type").val();
    var limits = $('#limit').val() == "" ? "5" : $('#limit').val();
    var page = $('#page').val() == "" ? "1" : $('#page').val();
    var which = which_catag;
    if (which == "user") {
        var arr = [];
        var Serializearray = $('#search').serializeArray();
        $.each(Serializearray, function (i, field) {
            arr.push(field.value);
        })
        var search_name = arr[0];
        var search_email = arr[1];
        var search_number = arr[2];
    }
    if (which == "client") {
        var arr = [];
        var Serializearray = $('#search').serializeArray();
        $.each(Serializearray, function (i, field) {
            arr.push(field.value)
        })
        var search_name = arr[0];
        var search_email = arr[1];
        var search_number = arr[2];
        var search_address = arr[3];
        var search_state = arr[4];
        var search_city = arr[5];
    }
    if (which == "item") {
        var arr = [];
        var Serializearray = $('#search').serializeArray();
        $.each(Serializearray, function (i, field) {
            arr.push(field.value)
        })
        search_name = arr[0];
        var search_price = arr[1]
    }
    if (which == "invoice") {
        var arr = [];
        var Serializearray = $('#search').serializeArray();
        $.each(Serializearray, function (i, field) {
            arr.push(field.value)
        })
        var search_invoiceno = arr[0];
        var search_client_name = arr[1];
        var search_client_email = arr[2];
        var search_client_number = arr[3];
    }
    var limits = $('#limit').val() == "" ? "5" : $('#limit').val();
    var current_page = $('#current_page').val() == "" ? "1" : $('#current_page').val();
    $.ajax({
        data: {
            current_page: current_page,
            setlimit: limits,
            search_name: search_name,
            search_price: search_price,
            search_email: search_email,
            search_number: search_number,
            search_address: search_address,
            search_state: search_state,
            search_city: search_city,
            sort_field: sort_field,
            sort_type: sort_type,
            search_invoiceno: search_invoiceno,
            search_client_name: search_client_name,
            search_client_email: search_client_email,
            search_client_number: search_client_number,
            setlimit: limits,
            page_NO: page
        },
        url: "pagination.php",
        type: 'POST',
        datatype: "html",
        success: function (data) {
            $("#pagination").html(data);
        }
    })
}

//seach user by name email number 
function search() {
    var which = $('#which').val();
    LoadTable(which)
}

//limit.............
function setLimit() {
    var which = $('#which').val();
    var limit = $('#select_list').val();
    $("#limit").val(limit)
    LoadTable(which)
}

//set pages of pagination.................
function setpage(e) {
    var which = $('#which').val();
    var page = $(e).html()
    var page_no = $(e).attr('id');
    $("#page").val(page);
    $(e).parent().addClass('active')
    $("#current_page").val(page).addClass("active");
    LoadTable(which)
}

// sorting..............
function sort(sort_type, field) {
    var which = $('#which').val();
    var field_name = field;
    var sort = sort_type;
    if (sort == "asc") {
        $('.d-asc').show();
        $('.asc').hide();
        $('.desc').show();
    } else {
        $('.asc').show();
        $('.desc').hide();
    }
    $("#sort_field").val(field_name);
    $("#sort_type").val(sort);
    LoadTable(which);
}

//reload usertable ............
function reload() {
    window.location.reload()
}

// edit fields.............
function edit(id, type) {
    var ida = id;
    var type = type;
    $("#id").val(ida)
    $("#userslist").removeClass("active show");
    $("#Profile").addClass("active show");
    $("#profile").addClass("active");
    $("#home-tab").removeClass("active");
    $('#profile-tab').html('Update');
    $('#profile-tab').addClass('active')
    $('#add').hide()
    $('#update').show()
    $('#image_div_hide').hide()
    $('#bd_image').removeClass('d-none')
    $('#addbtn').hide()
    $('#updatebtn').show()
    $.ajax({
        url: "model.php",
        type: 'POST',
        datatype: JSON,
        data: {
            'id': ida,
            'type': type
        },
        success: function (result) {
            var data = JSON.parse(result);
            if (type == "edit_user") {
                $("#username").val(data.username);
                $("#email").val(data.email);
                $("#number").val(data.number);
                $("#password").val(data.password)
                $('#id').val(data.id)
            }
            if (type == "edit_client") {
                $("#clientname").val(data.Name);
                $("#email").val(data.email);
                $("#number").val(data.number);
                $('#id').val(data.id)
                $('#DOB').val(data.DOB)
                $('#address').val(data.address)
                $('#state').val(data.state);
                $('#city').val(data.city);
            }
            if (type == "edit_item") {
                $('#image_add').val(data.image);
                $('#itemname').val(data.name);
                $('#bd_image').html('<img src=' + data.image + ' width="80" id="imgshow" height="60" ><button type ="button" style="width:80; padding:0;;" class="btn btn-danger"  onclick="changeimage(this)">Change</button>').css('text-align', 'center');
                $('#description').val(data.description);
                $('#number').val(data.price);
            }
            if (type == "edit_invoice") {
                $("#client_id").val(data.client_details[0]['id'])
                $("#total_amount").val(data.total_Amount)
                $('#invoice_no').val(data.invoice_no)
                $('#date').val(data.invoice_date).attr('readonly', 'readonly')
                $('#client_name').val(data.client_details[0]['name']).attr('readonly', 'readonly')
                $('#client_email').val(data.client_details[0]['email'])
                $('#client_number').val(data.client_details[0]['number'])
                $('#address').val(data.client_details[0]['address'] + " " + data.client_details[0]['city'] + " " + data.client_details[0]['state'])
                items = data.items_details;
                var prnt = $('.addRow').parents('div.addMoreTable');
                var trFrstChild = prnt.find("table tbody tr:first-child");
               
                $.each(items, function (index, item) {
                    if (index == 0) {
                        trFrstChild.find('.itemid').val(item.id)
                        trFrstChild.find(".itemName").val(item.name)
                        trFrstChild.find(".itemprice").val(item.item_rate)
                        trFrstChild.find(".itemquantity").val(item.item_quantity)
                        trFrstChild.find(".itemtotal").val(item.amount)
                    }
                    else{
                        var cloneChild = trFrstChild.clone();
                        cloneChild.find("input[type='text'],input[type='number'],input[type='hidden'],select,textarea").val('');
                        cloneChild.find('.itemid').val(item.id)
                        cloneChild.find(".itemName").val(item.name)
                        cloneChild.find(".itemprice").val(item.item_rate)
                        cloneChild.find(".itemquantity").val(item.item_quantity)
                        cloneChild.find(".itemtotal").val(item.amount)
                        cloneChild.find('.amount').on('change', function() {
                            calaculateAmt(this);
                        });
                        prnt.find("table tbody").append(cloneChild);
                    }
                })
            }
        }
    })
}

function changeimage(e) {
    $('#bd_image').addClass('d-none')
    $(e).hide()
    $('#image_div_hide').show()
    $('#imgshow').hide();
    $('#image').show();
}

// for delete user
function Delete(id, type) {
    var id = id;
    var type = type;
    $.ajax({
        type: "POST",
        url: 'model.php',
        data: {
            'id': id,
            'type': type
        },
        success: function (data) {
            if (data == 1) {
                $.notify("Data delete", { globalPosition: 'bottom right', className: 'success' })
                var which = $('#which').val();
                LoadTable(which)


            } else {
                $.notify("This Client has invoice So can't be delete", { globalPosition: 'bottom right', className: 'error' })
            }
        },
        error: function (e) {
            console.log("ERROR : ", e);
            $("#btnSubmit").prop("disabled", false);

        }
    })

}

// make pdf
function Getpdf(id, url) {
    $.ajax({
        url: url,
        data: { id: id },
        type: "POST",
        dataType: 'JSON',
        success: function(data) {
            console.log(data);
            // $(".load").hide();
            if (data.result != undefined) {
                
                window.open(data.result, '_blank');
            }
        }
    })
}
// mail
function modalemail(id, email) {
    document.getElementById('invoiceemailid').value = id
    document.getElementById('invoiceemail').value = email

}
// Validations.......

// ...................Email validation.............
function email_validation(e) {

    var email = e.value;
    var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (regex.test(email)) {
        return true
    } else {
        $('#error_email').show()
        $('#error_email').fadeOut(3000)
        return false
    }
}

function Query_validation(event) {
  
    var jKeyCode = (event.which) ? event.which : event.keyCode;
    if ((jKeyCode == 34 || jKeyCode == 39)) {
        return false;
    }
}
//......................Name validation..................
function name_validation(event) {
    var jKeyCode = (event.which) ? event.which : event.keyCode;
    if ((jKeyCode > 64 && jKeyCode < 91) || (jKeyCode > 96 && jKeyCode < 123) || jKeyCode == 32) {
        return true;
    } else {
        $('#error_name').show()
        $('#error_name').fadeOut(3000)
        return false;
    }
}

function mobile_validation(event) {
    var jKeyCode = (event.which) ? event.which : event.keyCode;
    if (jKeyCode > 47 && jKeyCode < 58) {
        return true;
    } else {
        $('#error_mobile').show()
        $('#error_mobile').fadeOut(3000)
        return false;
    }
}
function number_validation(evt, item) {
    evt = (evt) ? evt : window.event;
    var charCode = (evt.which) ? evt.which : evt.keyCode;
    if (charCode == 46) {
        var regex = new RegExp(/\./g)
        var count = $(item).val().match(regex).length;
        if (count > 1) {
            return false;
        }
    }
    if (charCode > 31 && (charCode < 48 || charCode > 57)) {
        return false;
    }
    return true;
}
function isNumber(event) {
    var clipboardData = event.clipboardData || window.clipboardData;
    var pastedData = clipboardData.getData('Text');
    if (isNaN(pastedData)) {
        return false;
    } else {
        return true;
    }
}

function validatePassword(e) {

    var password = e.value;
    if (password.length === 0) {
        $('#error_password').show().html("please enter password").css("color", "#fe8c3f");
        $('#error_password').fadeOut(4000)
        return;
    }
    // var matchedCase = new Array();
    var matchedCase1_1 = /^[0-9]+$/;
    var matchedCase1_2 = /^[a-z]+$/;
    var matchedCase2 = /^[a-zA-Z0-9]+$/;
    var matchedCase3 = /^[a-zA-Z0-9@$.!%*#?&]/;
    if ((matchedCase1_1).test(password) || (matchedCase1_2).test(password)) {
        $('#error_password').show().html("weak password").css("color", "red");
        $('#error_password').fadeOut(4000)
    }
    else if ((matchedCase2).test(password)) {
        $('#error_password').show().html("Medium password").css("color", "orange");
        $('#error_password').fadeOut(4000)
    }
    else if ((matchedCase3).test(password)) {
        $('#error_password').show().html("Strong password").css("color", "green");
        $('#error_password').fadeOut(4000)
    }
}
