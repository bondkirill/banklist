$(document).ready(function () {
        $("#chkall").click(function () {
               if($("#chkall").prop('checked')){
                   select_all('area', '1');
               }else {
                   select_all('area', '0');
               }
           });
        $('#submit').click(function () {
            var klient = [];

            $('.get_value').each(function () {
                if($(this).is(":checked")){
                    klient.push($(this).val());
                }
            });
            klient = klient.toString();
            $.ajax({
                url:"insert.php",
                method:"POST",
                data:{klient:klient},
                success:function (data) {
                    $('#result').html(data);
                }
            });
        });
        });
var tabinp;

function prepare() {
		tabinp = document.getElementsByTagName('input');
}

function select_all(name, value) {
  for (i = 0; i < tabinp.length; i++) {
    // regex here to check name attribute
    var regex = new RegExp(name, "i");
    if (regex.test(tabinp[i].getAttribute('name'))) {
      if (value == '1') {
        tabinp[i].checked = true;
      } else {
        tabinp[i].checked = false;
  }
    }
  }
}
 
if (window.addEventListener) {
  window.addEventListener("load", prepare, false);
} else if (window.attachEvent) {
  window.attachEvent("onload", prepare)
} else if (document.getElementById) {
  window.onload = prepare;
}