


//**********Full name and Initial name validation**********

//**********End Full name and Initial name validation**********



//function isChecked() {
//    var checkedYes = document.getElementById('male').checked;
//    var checkedNo = document.getElementById('female').checked;
//
//    if (checkedYes == false && checkedNo == false) {
////        alert('You need to select an option!');
//        return false;
//    } else {
//        return true;
//    }
//}





//**********NIC, Date of Birth and Gender validation**********
//$('#nic').focusout(function () {
////$('.nic-validate-btn').click(function () {focusout
//    $('.nic-validate-error').html('');
//    $('#d_o_b').val(''); //nic-birthday   d_o_b
//    $('.nic-gender').html('');
//    var nicNumber = $('.nic-validate').val();
//    if (validation(nicNumber)) {
//        console.log(nicNumber);
//        var extracttedData = extractData(nicNumber);
//        var days = extracttedData.dayList;
//        var findedData = findDayANDGender(days, d_array);
//
//        var month = findedData.month;
//        var year = extracttedData.year;
//        var day = findedData.day;
//        var gender = findedData.gender;
//        var bday = day + '-' + month + '-' + year;
//        var birthday = new Date(bday.replace(/(\d{2})-(\d{2})-(\d{4})/, "$2/$1/$3"));
//        var birthday = getFormattedDate(birthday);
//        $('#d_o_b').val(birthday);
//        $('.nic-gender').html(gender);
//
//        if (findedData.gender == "Male") {
//            $("#male").prop("checked", true);
//        } else {
//            $("#female").prop("checked", true);
//        }
//    } else {
//        $('.nic-validate-error').html('You Entered NIC Number Is wrong');
//    }
//});

//$('.nic-clear-btn').click(function () {
//    $('.nic-validate-error').html('');
//    $('#d_o_b').html('');
//    $('.nic-gender').html('');
//    $('.nic-validate').val('');
//});




//**********End NIC, Date of Birth and Gender validation**********





//////////////////////Backup//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//******** Fullname Validation **********//
//    function initialName() {
//        var name = document.getElementById("fullname").value;
//        var fname = document.getElementById("fullname").value;
//
//        var res = fname.split(' ');
//        var iname = res[(res.length) - 1];
//        var getInitials = function (name) {
//            var parts = name.split(' ');
//            var initials = '';
//
//            for (var i = 0; i < parts.length; i++) {
//                if (i != (parts.length) - 1) {
//                    if (parts[i].length > 0 && parts[i] !== '') {
//                        initials += parts[i][0].trim() + ".";
//                    }
//                }
//            }
//            return initials;
//        };
//        document.getElementById("initials_name").value = getInitials(name) + " " + iname;
//    }




