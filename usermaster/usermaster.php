<?php
include('../comman/header.php');

session_start();

if (!isset($_SESSION['name'])) {
    header('location:../loginsystem/login.php');
}
?>
<title>Project - User Master</title>
</head>

<body>

    <?php include('../comman/sidebar.php'); ?>

    <!------------------------------ Tabs Code ------------------------------->
    <div class="mybox" style="border-radius: 10px;">
        <div class="container-fluid bg-light p-3 rounded">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true" onclick="userhide()">All
                        Users</button>

                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Add User</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">

                <!------------------------------ All Users Form ------------------------------->

                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                    <div class="form mt-3">
                        <div class="mybox" style="padding: 1%; border-radius: 10px;">
                            <form class="mt-4 fw-bold" id="suser">
                                <div class="mb-3 mx-3 d-inline-block" id="snamediv">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control" id="sname" name="sname"
                                        aria-describedby="emailHelp" maxlength="15"
                                        oninput=" this.value = this.value.replace(/[^A-za-z\s]/g, '');">
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

                                <div class="mb-4 mx-3 d-inline-block">
                                    <input type="hidden" name="action" id="action" value="user" />
                                    <button type="button" name="search" id="search" class="btn btn-primary"
                                        onclick="user_search()"> <i class="fa-solid fa-magnifying-glass me-2"></i>Search
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>


                    <!-----------------------Table to fetch data--------------------------->


                    <div class="mybox mt-2" style="padding: 1%; border-radius: 10px;">
                        <div class="mb-1 ps-1">
                            <label for='number-dd'><b>No. of records :</b></label>
                            <select id='list' name='list' onchange="user_search()">
                                <option value='5'>5</option>
                                <option value='10'>10</option>
                                <option value='15'>15</option>
                            </select>
                        </div>
                        <div>
                            <div class="table-container">
                                <table class="table table-striped">
                                    <thead class="tr">
                                        <tr class="table-primary">
                                            <th><a href="javascript:void(0);" class="asc" onclick="sort(`asc`,`sno`)">S
                                                    No.
                                                    <i class="fa fa-sort-asc d-asc" aria-hidden="true"
                                                        style="display: none"></i></a>
                                                <a href="javascript:void(0);" class="desc" onclick="sort(`desc`, `sno`)"
                                                    style="display: none">S No.
                                                    <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
                                            </th>
                                            <th><a href="javascript:void(0);" class="asc" onclick="sort(`asc`, `name`)">
                                                    Name<i class="fa fa-sort-asc d-asc" aria-hidden="true"
                                                        style="display: none; "></i></a>
                                                <a href="javascript:void(0);" class="desc"
                                                    onclick="sort(`desc`, `name`)" style="display: none;">Name
                                                    <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
                                            </th>
                                            <th><a href="javascript:void(0);" class="asc"
                                                    onclick="sort(`asc`, `email`)">Email
                                                    <i class="fa fa-sort-asc d-asc" aria-hidden="true"
                                                        style="display: none; "></i></a>
                                                <a href="javascript:void(0);" class="desc"
                                                    onclick="sort(`desc`, `email`)" style="display: none;">Email
                                                    <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
                                            </th>
                                            <th><a href="javascript:void(0);" class="asc"
                                                    onclick="sort(`asc`, `phone`)">Phone
                                                    <i class="fa fa-sort-asc d-asc" aria-hidden="true"
                                                        style="display: none; "></i></a>
                                                <a href="javascript:void(0);" class="desc"
                                                    onclick="sort(`desc`, `phone`)" style="display: none;">Phone
                                                    <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
                                            </th>
                                            <th>Action</th>
                                        </tr>

                                    </thead>
                                    <tbody id="data"></tbody>
                                </table>
                            </div>
                            <div id="pagin" class="d-flex justify-content-start"></div>
                        </div>
                        <input type="hidden" id="sort_field" value="">
                        <input type="hidden" id="sort_type" value="">

                    </div>
                </div>

                <!------------------------------ Add Users Form ------------------------------->

                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">

                    <div class="form mt-3" id="addblock">
                        <div class="mybox" style="padding: 1%; border-radius: 10px;">
                            <form id="usermaster" class="mt-4 fw-bold">
                                <input type="hidden" class="snoEdit" name="snoEdit" id="snoEdit">
                                <div class="mb-3 mx-3 d-inline-block" id="namediv">
                                    <label for="name" class="form-label">Name<span style="color: red;">*</span></label>
                                    <span class="formerror"></span>
                                    <input type="text" class="form-control" id="aname" name="name"
                                        aria-describedby="emailHelp" maxlength="30"
                                        oninput=" this.value = this.value.replace(/[^A-za-z\s]/g, '');">
                                </div>

                                <div class="mb-3 mx-3 d-inline-block" id="emaildiv">
                                    <label for="email" class="form-label">Email<span
                                            style="color: red;">*</span></label>
                                    <span class="formerror"></span>
                                    <input type="email" class="form-control" id="aemail" name="email"
                                        aria-describedby="emailHelp" maxlength="50">
                                </div>

                                <div class="mb-3 mx-3 d-inline-block" id="phonediv">
                                    <label for="phone" class="form-label">Phone No.<span
                                            style="color: red;">*</span></label>
                                    <span class="formerror"></span>
                                    <input type="text" class="form-control" id="aphone" name="phone"
                                        aria-describedby="emailHelp" maxlength="10"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                </div>

                                <div class="mb-3 mx-3 d-inline-block" id="passworddiv">
                                    <label for="password" class="form-label">Password<span
                                            style="color: red;">*</span></label>
                                    <span class="formerror"></span>
                                    <input type="hidden" name="hiddenpassword" id="hiddenpassword">
                                    <input type="password" class="form-control pr-password" id="apassword"
                                        name="password" aria-describedby="emailHelp" maxlength="20">
                                </div>
                                <div class="mb-5 mx-3 d-inline-block">
                                    <input type="hidden" name="form_action" id="form_action" value="insert" />
                                    <input type="submit" name="submit" id="submit" class="btn btn-primary"
                                        value="Save" />
                                </div>
                            </form>
                        </div>
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
            user_search(page_id);
        })
        user_search();

        $("#side_user").addClass("active");

    });
    $(function() {
        $(".pr-password").passwordRequirements();

    });

    //--------------------------- User submit and edit -------------------------------

    $('#usermaster').on('submit', function(event) {
        event.preventDefault();
        var data = new FormData(this);
        data.append('type', "addupdate");
        var passdol = pass();
        var valueuser = validateUser();
        if (valueuser == true && passdol == true) {

            $.ajax({
                url: "usermasterinsert.php",
                method: "POST",
                data: data,
                contentType: false,
                cache: false,
                processData: false,
                dataType: "json",
                success: function(data) {
                    if (data == "89") {
                        $.notify("All Feilds Required", {
                            globalPosition: 'bottom right',
                            className: 'error'
                        });
                    }
                    if (data == "600") {
                        $.notify("Invalid Email", {
                            globalPosition: 'bottom right',
                            className: 'error'
                        });
                    }
                    if (data == "700") {
                        $.notify("Incomplete Mobile no.", {
                            globalPosition: 'bottom right',
                            className: 'error'
                        });
                    }
                    if (data == "2") {
                        $.notify("Record Saved Successfully", {
                            globalPosition: 'bottom right',
                            className: 'success'
                        });
                        setTimeout("window.location.reload()", 1500);
                    }
                    if (data == "1") {
                        $.notify("Alredy Exists", {
                            globalPosition: 'bottom right',
                            className: 'error'
                        });
                    }
                    if (data == "3") {
                        $.notify("Record Edit Successfully", {
                            globalPosition: 'bottom right',
                            className: 'success'
                        });
                        setTimeout("window.location.reload()", 1500);
                    }
                }
            });
        } else {
            return false;
        }
    });


    // ------------------------------ User edit--------------------------------

    function userEdit(id) {
        var edit_id = id;
        $.ajax({
            url: "usermasterinsert.php",
            type: 'POST',
            dataType: "json",
            async: "false",
            mode: "abort",
            asyn: false,
            data: {
                type: "editdetailsfill",
                edit_id: edit_id
            },
            success: function(responce) {
                TabShow();
                $("#snoEdit").val(responce[0]["sno"]);
                $('#aname').val(responce[0]["name"])
                $('#aemail').val(responce[0]["email"])
                $('#aphone').val(responce[0]["phone"])
                $('#apassword').val(responce[0]["password"])
                $('#hiddenpassword').val(responce[0]["password"])
                $('#form_action').val("edit");
                $('#submit').val("Update");
                $("#nav-profile-tab").html("Edit User");

            }
        });
    }
    // ------------------------------ User Delete--------------------------------

    $(document).on('click', '.delete', function() {
        var delete_id = $(this).val();
        $.confirm({
            title: '',
            content: 'Are You Sure Want To Delete ?',
            type: 'red',
            typeAnimated: true,
            buttons: {
                tryAgain: {
                    text: 'Confirm',
                    btnClass: 'btn-red',
                    action: function() {
                        $.ajax({
                            url: "usermasterinsert.php",
                            type: 'POST',
                            dataType: "json",
                            async: "false",
                            mode: "abort",
                            asyn: false,
                            data: {
                                type: "deleteuser",
                                delete_id: delete_id
                            },
                            success: function(responce) {
                                if (responce == 4) {
                                    // error("Data deleted successfully", "Delete");
                                    $.notify("Record Deleted Successfully", {
                                        globalPosition: 'bottom right',
                                        className: 'success'
                                    });
                                    setTimeout("window.location.reload()", 1500);
                                }
                            }
                        });
                    }
                },
                close: function() {}
            }
        });
    });
    </script>
</body>

</html>