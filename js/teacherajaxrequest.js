$(document).ready(function() {
    // Ajax Call for Already Exists Email Verification
    $("#teaemail").on("keypress blur", function() {
      var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
      var teaemail = $("#teaemail").val();
      $.ajax({
        url: "Teacher/addteacher.php",
        type: "post",
        data: {
          checkemail: "checkmail",
          teaemail: teaemail
        },
        success: function(data) {
          console.log(data);
          if (data != 0) {
            $("#teastatusMsg2").html(
              '<small style="color:red;"> Email ID Already Registered ! </small>'
            );
            $("#signup").attr("disabled", true);
          } else if (data == 0 && reg.test(teaemail)) {
            $("#teastatusMsg2").html(
              '<small style="color:green;"> There you go ! </small>'
            );
            $("#signup").attr("disabled", false);
          } else if (!reg.test(teaemail)) {
            $("#teastatusMsg2").html(
              '<small style="color:red;"> Please Enter Valid Email e.g. example@mail.com </small>'
            );
            $("#signup").attr("disabled", false);
          }
          if (teaemail == "") {
            $("#teastatusMsg2").html(
              '<small style="color:red;"> Please Enter Email ! </small>'
            );
          }
        }
      });
    });
    // Checking name on keypress
    $("#teaname").keypress(function() {
      var teaname = $("#teaname").val();
      if (teaname !== "") {
        $("#teastatusMsg1").html(" ");
      }
    });
    // Checking Password on keypress
    $("#teapass").keypress(function() {
      var teapass = $("#teapass").val();
      if (teapass !== "") {
        $("#teastatusMsg3").html(" ");
      }
    });
  });
  
  // Ajax Call for Adding New teacher
  function addtea() {
    var reg = /^[A-Z0-9._%+-]+@([A-Z0-9-]+\.)+[A-Z]{2,4}$/i;
    var teaname = $("#teaname").val();
    var teaemail = $("#teaemail").val();
    var teapass = $("#teapass").val();
    // checking fields on form submission
    if (teaname.trim() == "") {
      $("#teastatusMsg1").html(
        '<small style="color:red;"> Please Enter Name ! </small>'
      );
      $("#teaname").focus();
      return false;
    } else if (teaemail.trim() == "") {
      $("#teastatusMsg2").html(
        '<small style="color:red;"> Please Enter Email ! </small>'
      );
      $("#teaemail").focus();
      return false;
    } else if (teaemail.trim() != "" && !reg.test(teaemail)) {
      $("#teastatusMsg2").html(
        '<small style="color:red;"> Please Enter Valid Email e.g. example@mail.com </small>'
      );
      $("#teaemail").focus();
      return false;
    } else if (teapass.trim() == "") {
      $("#teastatusMsg3").html(
        '<small style="color:red;"> Please Enter Password ! </small>'
      );
      $("#teapass").focus();
      return false;
    } else {
      $.ajax({
        url: "teacher/addteacher.php",
        type: "post",
        data: {
          // assigned teasignup value just to check all iz well
          teasignup: "teasignup",
          teaname: teaname,
          teaemail: teaemail,
          teapass: teapass
        },
        success: function(data) {
          console.log(data);
          if (data == "OK") {
            $("#successMsg").html(
              '<span class="alert alert-success"> Registration Successful ! </span>'
            );
            // making field empty after signup
            clearteaRegField();
          } else if (data == "Failed") {
            $("#successMsg").html(
              '<span class="alert alert-danger"> Unable to Register ! </span>'
            );
          }
        }
      });
    }
  }
  
  // Empty All Fields and Status Msg
  function clearteaRegField() {
    $("#teaRegForm").trigger("reset");
    $("#teastatusMsg1").html(" ");
    $("#teastatusMsg2").html(" ");
    $("#teastatusMsg3").html(" ");
  }
  
  function clearAllteaReg() {
    $("#successMsg").html(" ");
    clearteaRegField();
  }
  
  // Ajax Call for teadent Login Verification
  function checkteaLogin() {
    var teaLogEmail = $("#teaLogEmail").val();
    var teaLogPass = $("#teaLogPass").val();
    $.ajax({
      url: "teacher/addteacher.php",
      type: "post",
      data: {
        checkLogemail: "checklogmail",
        teaLogEmail: teaLogEmail,
        teaLogPass: teaLogPass
      },
      success: function(data) {
        console.log(data);
        if (data == 0) {
          $("#teastatusLogMsg").html(
            '<small class="alert alert-danger"> Invalid Email ID or Password ! </small>'
          );
        } else if (data == 1) {
          $("#teastatusLogMsg").html(
            '<div class="spinner-border text-success" role="status"></div>'
          );
          // Empty Login Fields
          clearteaLoginField();
          setTimeout(() => {
            window.location.href = "teacher.php";
          }, 1000);
        }
      }
    });
  }
  
  // Empty Login Fields
  function clearteaLoginField() {
    $("#teaLoginForm").trigger("reset");
  }
  
  // Empty Login Fields and Status Msg
  function clearteaLoginWithStatus() {
    $("#teastatusLogMsg").html(" ");
    clearteaLoginField();
  }
  