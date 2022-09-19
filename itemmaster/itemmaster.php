<?php
include('../comman/header.php');

session_start();

if (!isset($_SESSION['name'])) {
    header('location:../loginsystem/login.php');
}
?>

<title>Project - Item Master</title>

</head>

<body>

    <?php include('../comman/sidebar.php'); ?>
    <!------------------------------ Tabs Code ------------------------------->
    <div class="mybox" style="border-radius: 10px;">
        <div class="container-fluid bg-light p-3 rounded">
            <nav>
                <div class="nav nav-tabs" id="nav-tab" role="tablist">
                    <button class="nav-link active" id="nav-home-tab" data-bs-toggle="tab" data-bs-target="#nav-home"
                        type="button" role="tab" aria-controls="nav-home" aria-selected="true" onclick="hide()">All
                        Items</button>

                    <button class="nav-link" id="nav-profile-tab" data-bs-toggle="tab" data-bs-target="#nav-profile"
                        type="button" role="tab" aria-controls="nav-profile" aria-selected="false">Add Item</button>
                </div>
            </nav>
            <div class="tab-content" id="nav-tabContent">

                <!------------------------------ All Users Form ------------------------------->

                <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">

                    <div class="form mt-3">
                        <div class="mybox" style="padding: 1%; border-radius: 10px;">
                            <form class="mt-4 fw-bold">
                                <div class="mx-3 d-inline-block" id="snamediv">
                                    <label for="name" class="form-label">Item Name</label>
                                    <input type="text" class="form-control" id="sname" name="sname"
                                        aria-describedby="emailHelp" maxlength="15"
                                        oninput=" this.value = this.value.replace(/[^A-za-z\s]/g, '');">
                                </div>

                                <div class="mb-4 mx-3 d-inline-block">
                                    <input type="hidden" name="action" id="action" value="item" />

                                    <button type="button" name="searchbtn" id="searchbtn" class="btn btn-primary"
                                        onclick="item_search()"><i
                                            class="fa-solid fa-magnifying-glass me-2"></i>Search</button>
                                </div>
                            </form>
                        </div>
                    </div>
                    <!-- <div class="seprate"></div> -->

                    <!-- --------------Table to fetch data--------------- -->
                    <div class="mybox mt-2" style="padding: 1%; border-radius: 10px;">
                        <div class="mb-2 ps-1">
                            <label for='number-dd'><b>No. of records :</b></label>
                            <select id='list' name='list' onchange="item_search()">
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
                                                    Item Name<i class="fa fa-sort-asc d-asc" aria-hidden="true"
                                                        style="display: none; "></i></a>
                                                <a href="javascript:void(0);" class="desc"
                                                    onclick="sort(`desc`, `name`)" style="display: none;">Item Name
                                                    <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
                                            </th>
                                            <th><a href="javascript:void(0);" class="asc"
                                                    onclick="sort(`asc`, `desc`)">Description
                                                    <i class="fa fa-sort-asc d-asc" aria-hidden="true"
                                                        style="display: none; "></i></a>
                                                <a href="javascript:void(0);" class="desc"
                                                    onclick="sort(`desc`, `desc`)" style="display: none;">Description
                                                    <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
                                            </th>
                                            <th><a href="javascript:void(0);" class="asc"
                                                    onclick="sort(`asc`, `price`)">Price
                                                    <i class="fa fa-sort-asc d-asc" aria-hidden="true"
                                                        style="display: none; "></i></a>
                                                <a href="javascript:void(0);" class="desc"
                                                    onclick="sort(`desc`, `price`)" style="display: none;">Price
                                                    <i class="fa fa-sort-desc" aria-hidden="true"></i></a>
                                            </th>
                                            <th>Image</th>
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

                <!------------------------------ Add Item Form ------------------------------->

                <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab"
                    style="height: 12rem;">

                    <div class="form mt-3 position-relative" id="addblock">
                        <div class="mybox" style="padding: 1%; border-radius: 10px;">
                            <form enctype="multipart/form-data" onsubmit="return validateItem()" class="mt-4 fw-bold"
                                id="itemmaster">
                                <input type="hidden" class="snoEdit" name="snoEdit" id="snoEdit">
                                <div class="mx-3 d-inline-block" id="namediv">
                                    <label for="name" class="form-label">Item Name<span
                                            style="color: red;">*</span></label>
                                    <span class="formerror"></span>
                                    <input type="text" class="form-control" id="aname" name="name"
                                        aria-describedby="emailHelp" maxlength="15"
                                        oninput=" this.value = this.value.replace(/[^A-za-z\s]/g, '');">
                                </div>

                                <div class="mx-3 d-inline-block" id="descdiv">
                                    <label for="desc" class="form-label">Item Description<span
                                            style="color: red;">*</span></label> <span class="formerror"></span>
                                    <input type="text" class="form-control" id="adesc" name="desc"
                                        aria-describedby="emailHelp" maxlength="70">
                                </div>

                                <div class="mx-3 d-inline-block" id="pricediv">
                                    <label for="price" class="form-label">Item Price<span
                                            style="color: red;">*</span></label>
                                    <span class="formerror"></span>
                                    <input type="text" class="form-control" id="aprice" name="price"
                                        aria-describedby="emailHelp" maxlength="10"
                                        oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" />
                                </div>

                                <div class="mx-3 d-inline-block" id="filediv">
                                    <label for="file" class="form-label">Choose File<span
                                            style="color: red;">*</span></label>
                                    <span class="formerror"></span>
                                    <input type="file" class="form-control" style="width:270px;" id="afile" name="file"
                                        aria-describedby="emailHelp" onchange="ImageShowInImageTag(this,preview);">
                                    <input type="hidden" name="path" id="path" value="">
                                </div>
                                <div class="mt-3 mx-3 d-inline-block">
                                    <input type="hidden" name="form_action" id="form_action" value="insert" />
                                    <input type="submit" name="submit" id="submit" class="btn btn-primary"
                                        value="Save" />
                                </div>
                                <div class="preview" id="imagediv"><img id="preview" style="display: none;"
                                        class="imageitem" src="" alt="preview"></div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php include('../comman/footer.php'); ?>

    <script>
    $(document).ready(function() { // datatable code       
        $(document).on("click", "#pagi a", function(e) {
            e.preventDefault();
            var page_id = $(this).attr("id");
            item_search(page_id);
        })

        item_search();
        $("#side_item").addClass("active");
    });
    </script>

    <script>
    function hide() {
        $("#nav-profile").removeClass("active show");
        $("#nav-home").addClass("show active");
        $("#nav-profile-tab").removeClass("active");
        $("#nav-home-tab").addClass("active");
        $("#nav-profile-tab").html("Add Item");
        $('#form_action').val("insert");
        $('#submit').val("Save");
        $("#preview").css({
            "display": "none"
        });
        $("#preview").attr("src", "");
        $('input[type=text], input[type=email], input[type=file]').val("");
        document.getElementById("nav-home-tab").setAttribute('aria-selected', 'true');
        document.getElementById("nav-profile-tab").setAttribute('aria-selected', 'false');
    }

    //--------------------------- Item submit and edit -------------------------------

    $('#itemmaster').on('submit', function(event) {
        event.preventDefault();
        var data = new FormData(this);
        data.append('type', "addupdate");
        var valueitem = validateItem();
        if (valueitem == true) {

            $.ajax({
                url: "itemmasterinsert.php",
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
                    if (data == "800") {
                        $.notify("Please choose file", {
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
                    if (data == "6") {
                        $.notify("Unsupported File Format", {
                            globalPosition: 'bottom right',
                            className: 'error'
                        });
                    }
                }
            });
        } else {
            return false;
        }
    });


    function itemEdit(id) {
        var edit_id = id;
        $.ajax({
            url: "itemmasterinsert.php",
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
                $('#aname').val(responce[0]["name"]);
                $('#adesc').val(responce[0]["desc"]);
                $('#aprice').val(responce[0]["price"]);
                $('#path').val(responce[0]["image"]);
                $("#preview").css({
                    "display": "block"
                });
                // $('#imagediv').html('');
                $("#preview").attr("src", responce[0]["image"]);
                $('#form_action').val("edit");
                $('#submit').val("Update");
                $("#passworddiv").addClass("d-none");
                $("#nav-profile-tab").html("Edit Item");

            }
        });
    }

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
                            url: "itemmasterinsert.php",
                            type: 'POST',
                            dataType: "json",
                            async: "false",
                            mode: "abort",
                            asyn: false,
                            data: {
                                type: "deleteitem",
                                delete_id: delete_id,
                            },
                            success: function(responce) {
                                if (responce == 4) {
                                    $.notify("Record Deleted Successfully", {
                                        globalPosition: 'bottom right',
                                        className: 'success'
                                    });
                                    setTimeout("window.location.reload()", 2000);
                                }
                                if (responce == 5) {
                                    $.notify("You Can't delete", {
                                        globalPosition: 'bottom right',
                                        className: 'error'
                                    });
                                    // setTimeout("window.location.reload()", 2000);
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