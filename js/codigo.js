$(document).ready(function () {
  if ($(".entro").val() == 0) {
    $(".estado").css("color", "red");
  } else {
    $(".estado").css("color", "green");
  }
});
