


// ------------------------------ Validation--------------------------------

function clearErrors() {
    errors = document.getElementsByClassName('formerror');
    for (let item of errors) {
        item.innerHTML = "";
    }
}

function seterror(id, error) {
    element = document.getElementById(id);
    element.getElementsByClassName('formerror')[0].innerHTML = error;
}

const myTimeout = setTimeout(clearErrors, 5000);


// ------------------------------ UserMaster Validation--------------------------------

function validateUser() {
    clearErrors();
    var returnval = true;
    var namedat = document.getElementById('aname').value;
    var emaildat = document.getElementById('aemail').value;
    var phonedat = document.getElementById('aphone').value;
    var passworddat = document.getElementById('apassword').value;


    if (namedat.length == 0) {
        seterror("namediv", "required");
        returnval = false;
    }
    if (emaildat.length == 0) {
        seterror("emaildiv", "required");
    }
    else {
        if (/^[a-z0-9][a-z0-9-_\.]+@([a-z]|[a-z0-9]?[a-z0-9-]+[a-z0-9])\.[a-z0-9]{2,10}(?:\.[a-z]{2,10})?$/.test(emaildat)) {

            returnval = true;
        } else {
            $.notify("Invalid Email", {
                globalPosition: 'bottom right',
                className: 'error'
            });
            returnval = false;
        }
    }
    if (phonedat.length == 0) {
        seterror("phonediv", "required");
        returnval = false;
    }
    if (phonedat.length != 0 && phonedat.length < 10) {
        $.notify("Incomplete Mobile No.", {
            globalPosition: 'bottom right',
            className: 'error'
        });
        returnval = false;
    }
    return returnval;

}

// ------------------------------ ClientMaster Validation--------------------------------

function validateClient() {
    clearErrors();
    var returnval = true;
    var namedat = document.getElementById('aname').value;
    var emaildat = document.getElementById('aemail').value;
    var phonedat = document.getElementById('aphone').value;
    var passworddat = document.getElementById('apassword').value;
    var addressdat = document.getElementById('aaddress').value;
    var statedat = document.getElementById('state').value;
    var citydat = document.getElementById('city').value;
    var action = document.getElementById('action').value;

    if (action == "insert") {

        if (namedat.length == 0) {
            seterror("namediv", "required");
            returnval = false;
        }
        if (emaildat.length == 0) {
            seterror("emaildiv", "required");
            returnval = false;
        } else {
            if (/^[a-z0-9][a-z0-9-_\.]+@([a-z]|[a-z0-9]?[a-z0-9-]+[a-z0-9])\.[a-z0-9]{2,10}(?:\.[a-z]{2,10})?$/.test(emaildat)) {

                returnval = true;
            } else {
                $.notify("Invalid Email", {
                    globalPosition: 'bottom right',
                    className: 'error'
                });
                returnval = false;
            }
        }
        if (phonedat.length < 10) {
            seterror("passworddiv", "wrong details");
            returnval = false;
        }
        if (passworddat.length == 0) {
            seterror("passworddiv", "required");
            returnval = false;
        }
        if (addressdat.length == 0) {
            seterror("addressdiv", "required");
            returnval = false;
        }
        if (statedat == 0) {
            seterror("statediv", "required");
            returnval = false;
        }
        if (citydat == 0) {
            seterror("citydiv", "required");
            returnval = false;
        }
    }
    else {
        if (namedat.length == 0) {
            seterror("namediv", "required");
            returnval = false;
        }
        if (emaildat.length == 0) {
            seterror("emaildiv", "required");
            returnval = false;
        } else {
            if (/^[a-z0-9][a-z0-9-_\.]+@([a-z]|[a-z0-9]?[a-z0-9-]+[a-z0-9])\.[a-z0-9]{2,10}(?:\.[a-z]{2,10})?$/.test(emaildat)) {

                returnval = true;
            } else {
                $.notify("Invalid Email", {
                    globalPosition: 'bottom right',
                    className: 'error'
                });
                returnval = false;
            }
        }
        if (phonedat.length == 0) {
            seterror("phonediv", "required");
            returnval = false;
        }
        if (phonedat.length > 0 && phonedat.length < 10) {
            $.notify("Incomplete Mobile No.", {
                globalPosition: 'bottom right',
                className: 'error'
            });
            returnval = false;
        }
        if (passworddat.length == 0) {
            seterror("passworddiv", "required");
            returnval = false;
        }
        if (addressdat.length == 0) {
            seterror("addressdiv", "required");
            returnval = false;
        }
    }
    return returnval;

}

// ------------------------------ ItemMaster Validation--------------------------------

function validateItem() {
    clearErrors();
    var returnval = true;
    var namedat = document.getElementById('aname').value;
    var descdat = document.getElementById('adesc').value;
    var pricedat = document.getElementById('aprice').value;

    if (namedat.length == 0) {
        seterror("namediv", "required");
        returnval = false;
    }
    if (descdat.length == 0) {
        seterror("descdiv", "required");
        returnval = false;
    }
    if (pricedat.length == 0) {
        seterror("pricediv", "required");
        returnval = false;
    }

    return returnval;

}
// ------------------------------ Invoice Validation--------------------------------

function validateInvoice() {
    clearErrors();
    var returnval = true;
    var clientnamedat = $("#aname").val();
    var itemnamedat = $("#itemname_1").val();
    if (clientnamedat.length == 0) {
        $.notify("Please Fill Details", {
            globalPosition: 'bottom right',
            className: 'error'
        });
        returnval = false;
    }
    if (clientnamedat.length != 0 && itemnamedat.length == 0) {
        $.notify("Atleast one item required", {
            globalPosition: 'bottom right',
            className: 'error'
        });
        returnval = false;
    }

    return returnval;

}


// ------------------------------ Signup Validation--------------------------------

function validateSignup() {
    clearErrors();
    var returnval = true;
    var namedat = document.getElementById('name').value;
    var emaildat = document.getElementById('email').value;
    var passworddat = document.getElementById('loginpassword').value;
    // console.log(passworddat);
    var phonedat = document.getElementById('phone').value;
    // var passwordval = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{8,15}$/;

    if (namedat.length == 0) {
        seterror("namediv", "*Required");
        returnval = false;
    }
    if (emaildat.length == 0) {
        seterror("emaildiv", "*Required");
        returnval = false;
    }
    if (passworddat.length == 0) {
        seterror("passworddiv", "*Required");
        returnval = false;
    }
    if (passworddat.length != 0 && passworddat.length < 8) {
        seterror("passworddiv", "*Password length must be atleast 8 characters");
        returnval = false;
    }
    if (passworddat.length > 15) {
        seterror("passworddiv", "*Password length must not exceed 15 characters");
        returnval = false;
    }
    if (phonedat.length == 0) {
        seterror("phonediv", "*Required");
        returnval = false;
    }
    if (phonedat.length != 0 && phonedat.length < 10) {
        $.notify("Incomplete Mobile No.", {
            globalPosition: 'bottom right',
            className: 'error'
        });
        returnval = false;
    }
    if (passworddat.length < 15 && passworddat.length > 8 && namedat == passworddat) {
        seterror("passworddiv", "*You can't choose username and password same");
        returnval = false;
    }
    return returnval;
}

// ------------------------------ Forgot Validation--------------------------------

function validateConfirm() {
    clearErrors();
    var returnval = true;
    var passworddat = document.getElementById('password').value;
    var cpassworddat = document.getElementById('cpassword').value;

    if (passworddat.length == 0) {
        seterror("box", "required");
        returnval = false;
    }

    if (passworddat.length != 0 && passworddat.length < 8) {
        seterror("box", "Password length must be atleast 8 characters");
        returnval = false;
    }
    if (passworddat.length > 15) {
        seterror("box", "Password length must not exceed 15 characters");
        returnval = false;
    }

    if (cpassworddat.length == 0) {
        seterror("box1", "required");
        returnval = false;
    }

    if (passworddat.length > 8 && passworddat.length < 15 && cpassworddat != passworddat) {
        seterror("box1", "Password and Confirm Password not match");
        returnval = false;
    }
    return returnval;
}

// ------------------------------ Forgot Validation--------------------------------

function validateLogin() {
    clearErrors();
    var returnval = true;
    var nameemaildat = document.getElementById('nameemail').value;
    var passworddat = document.getElementById('loginpassword').value;

    if (passworddat.length == 0) {
        $.notify("Password Required", {
            globalPosition: 'bottom right',
            className: 'error'
        });
        returnval = false;
    }

    if (nameemaildat.length == 0) {
        $.notify("Email Required", {
            globalPosition: 'bottom right',
            className: 'error'
        });
        returnval = false;
    }

    return returnval;
}

// function validateotp() {
//     clearErrors();
//     // debugger
//     var returnval = true;
//     var first = document.getElementById('first').value;
//     var second = document.getElementById('second').value;
//     var third = document.getElementById('third').value;
//     var fourth = document.getElementById('fourth').value;
//     var fifth = document.getElementById('fifth').value;
//     var sixth = document.getElementById('sixth').value;

//     var feilds = [first, second, third, fourth, fifth, sixth];

//     console.log(feilds);
    
//     for (i = 0; i <= 5; i++) {
//         if (feilds[i].lenght < 1) {
//             console.log(); 
//             $.notify("Password Required", {
//                 globalPosition: 'bottom right',
//                 className: 'error'
//             });
//         }
//         returnval = false;
//     }

//     // if (nameemaildat.length == 0) {
//     //     $.notify("Email Required", {
//     //         globalPosition: 'bottom right',
//     //         className: 'error'
//     //     });
//     //     returnval = false;
//     // }

//     return returnval;
// }


function pass() {
    var returnval = true;
    var lowerCase = new RegExp('[a-z]'),
        upperCase = new RegExp('[A-Z]'),
        numbers = new RegExp('[0-9]'),
        specialCharacter = new RegExp('[!,%,&,@,#,$,^,*,?,_,~]');
    var password = document.getElementById('apassword').value;
    if (password.length < 8) {
        returnval = false;
    }
    if (!password.match(lowerCase)) {
        returnval = false;
    }
    if (!password.match(upperCase)) {
        returnval = false;
    }
    if (!password.match(numbers)) {
        returnval = false;
    }
    if (!password.match(specialCharacter)) {
        returnval = false;
    }

    if (returnval == false) {
        $.notify("Password not fullfill conditions", {
            globalPosition: 'bottom right',
            className: 'error'
        });
    }
    return returnval;
}


