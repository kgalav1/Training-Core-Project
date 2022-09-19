// ------------------------------ User search--------------------------------

function user_search(page) {
    var action = $("#action").val();
    var name = $("#sname").val();
    var email = $("#semail").val();
    var phone = $("#sphone").val();
    var limit = $("#list").val();
    var sort_field = $("#sort_field").val() == "" ? "sno" : $("#sort_field").val();
    var sort_type = $("#sort_type").val() == "" ? "asc" : $("#sort_type").val();
    $.ajax({
        type: "POST",
        url: "../comman/cs.php",
        data: {
            action: action,
            name: name,
            email: email,
            phone: phone,
            limit: limit,
            page: page,
            sort_field: sort_field,
            sort_type: sort_type
        },
        dataType: 'Json',
        success: function (data) {
            $("#data").html(data.table_data);
            $("#pagin").html(data.pagination);
        },
    });
}


function sort(sort_type, field) {
    var action = $("#action").val();
    var sort = sort_type;
    var field_name = field;
    console.log(field_name, sort);
    if (sort == "asc") {
        $('.d-asc').show();
        $('.desc').show();
        $('.asc').hide();
    } else {
        $('.asc').show();
        $('.desc').hide();
    }
    $("#sort_field").val(field_name);
    $("#sort_type").val(sort);

    if (action == "user") {
        user_search();
    }
    if (action == "client") {
        client_search();
    }
    if (action == "item") {
        item_search();
    }
    if (action == "invoice") {
        invoice_search();
    }

}

function userhide() {
    $("#nav-profile").removeClass("active show");
    $("#nav-home").addClass("show active");
    $("#nav-profile-tab").removeClass("active");
    $("#nav-home-tab").addClass("active");
    $("#nav-profile-tab").html("Add User");
    $('#form_action').val("insert");
    $('#submit').val("Save");
    $('input[type=text], input[type=email], input[type=password]').val("");
    // $("#passworddiv").removeClass("d-none");
    document.getElementById("nav-home-tab").setAttribute('aria-selected', 'true');
    document.getElementById("nav-profile-tab").setAttribute('aria-selected', 'false');
}

// ------------------------------ Client search--------------------------------

function client_search(page) {
    var name = $("#sname").val();
    var email = $("#semail").val();
    var phone = $("#sphone").val();
    var action = $("#action").val();
    var limit = $("#list").val();
    var sort_field = $("#sort_field").val() == "" ? "sno" : $("#sort_field").val();
    var sort_type = $("#sort_type").val() == "" ? "asc" : $("#sort_type").val();
    $.ajax({
        type: "POST",
        url: "../comman/cs.php",
        data: {
            name: name,
            email: email,
            phone: phone,
            action: action,
            limit: limit,
            page: page,
            sort_field: sort_field,
            sort_type: sort_type
        },
        dataType: 'Json',
        success: function (data) {
            $("#data").html(data.table_data);
            $("#pagin").html(data.pagination);
        },
    });
}

// ------------------------------ Item search--------------------------------

function item_search(page) {
    var name = $("#sname").val();
    var action = $("#action").val();
    var limit = $("#list").val();
    var sort_field = $("#sort_field").val() == "" ? "sno" : $("#sort_field").val();
    var sort_type = $("#sort_type").val() == "" ? "asc" : $("#sort_type").val();
    $.ajax({
        type: "POST",
        url: "../comman/cs.php",
        data: {
            name: name,
            action: action,
            limit: limit,
            page: page,
            sort_field: sort_field,
            sort_type: sort_type
        },
        dataType: 'Json',
        success: function (data) {
            $("#data").html(data.table_data);
            $("#pagin").html(data.pagination);
        },
    });
}

// ------------------------------ invoice search--------------------------------

function invoice_search(page) {
    var invoice_id = $("#sinvoicenumber").val();
    var name = $("#sname").val();
    var email = $("#semail").val();
    var phone = $("#sphone").val();
    var action = $("#action").val();
    var limit = $("#list").val();
    var sort_field = $("#sort_field").val() == "" ? "invoice_id" : $("#sort_field").val();
    var sort_type = $("#sort_type").val() == "" ? "asc" : $("#sort_type").val();
    $.ajax({
        type: "POST",
        url: "../comman/cs.php",
        data: {
            invoice_id: invoice_id,
            name: name,
            email: email,
            phone: phone,
            action: action,
            limit: limit,
            page: page,
            sort_field: sort_field,
            sort_type: sort_type
        },
        dataType: 'Json',
        success: function (data) {
            $("#data").html(data.table_data);
            $("#pagin").html(data.pagination);
        },
    });
}


// ------------------------------ Tab Hide Function--------------------------------

function TabShow() {
    $("#nav-home").removeClass("show active");
    $("#nav-profile").addClass("active show");
    $("#nav-home-tab").removeClass("active");
    $("#nav-profile-tab").addClass("active");
    $("#nav-home-tab").attr('aria-selected', 'false');
    $("#nav-profile-tab").attr('aria-selected', 'true');
}

// ------------------------------ Eye Function--------------------------------

function change() {
    if (document.getElementById("loginpassword").type == 'password') {
        $("#eye").removeClass("fa-solid fa-eye-slash");
        $("#eye").addClass("fa-solid fa-eye");
        document.getElementById("loginpassword").type = "text";
    } else {
        $("#eye").removeClass("fa-solid fa-eye");
        $("#eye").addClass("fa-solid fa-eye-slash");
        document.getElementById("loginpassword").type = "password";
    }
}





//------------------------------ Image Preview-----------------------------------------

function ImageShowInImageTag(e, imgpre) {
    const file = e.files[0];
    if (file) {
        if (imgpre.style.display == "none")
            imgpre.style.display = "block";

        let reader = new FileReader();
        reader.onload = function (event) {
            $(imgpre).attr('src', event.target.result);
        };
        reader.readAsDataURL(file);
    }
}

// ---------------------------------------------Invoice Tab code-----------------------------------

function invoiceTabShow() {
    $("#nav-home").removeClass("show active");
    $("#nav-profile").addClass("active show");
    $("#nav-home-tab").removeClass("active");
    $("#nav-profile-tab").addClass("active");
    $("#client").addClass("d-none");

    $("#nav-profile-tab").html("Edit Invoice");

    $("#nav-home-tab").attr('aria-selected', 'false');
    $("#nav-profile-tab").attr('aria-selected', 'true');

}

function invoicehide() {
    // $("#nav-profile").removeClass("active show");
    // $("#nav-home").addClass("show active");
    // $("#nav-profile-tab").removeClass("active");
    // $("#nav-home-tab").addClass("active");
    // document.getElementById("nav-profile-tab").innerHTML = "Add Invoice"
    // document.getElementById("nav-home-tab").setAttribute('aria-selected', 'true');
    // document.getElementById("nav-profile-tab").setAttribute('aria-selected', 'false');
    // $('input[type=text], input[type=email], input[type=password], input[type=number], input[type=date]').val("");
    window.location.reload();
}

function addHide() {

    var trLength = $("#itemTable").find("tbody tr").length;
    if (trLength > 1) {
        $("#itemTable").find("tbody tr:first td:nth-child(6)").removeClass("d-none");
    }
}

function logout() {
    $.confirm({
        title: '',
        content: 'Are You Sure Want To Logout ?',
        type: 'red',
        typeAnimated: true,
        buttons: {
            confirm: function () {
                window.location.href = '../loginsystem/logout.php';
            },
            cancel: function () {
                //close
            },
        }
    });
}

const searchside = () => {
    let filter = document.getElementById('myinput').value.toUpperCase();
    let ul = document.getElementById('sideul');
    let li = ul.getElementsByTagName('li');
    let search = document.getElementById('side_search');

    for (let index = 0; index < li.length; index++) {
        let a = li[index].getElementsByTagName('a')[0];
        let textValue = a.textContent || a.innerHTML;

        if (textValue.toUpperCase().indexOf(filter) > -1) {
            li[index].style.display = '';
            search.style.display = '';

        } else {
            li[index].style.display = 'none';
            search.style.display = '';
        }
    }
}

