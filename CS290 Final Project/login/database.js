// Adapted from: http://www.w3schools.com/php/php_ajax_database.asp
function showTable(source) {
  if (source == "") {
    document.getElementById("tableOutput").innerHTML = "";
    return;
  } else {
      if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
      }
      else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.getElementById("tableOutput").innerHTML = xmlhttp.responseText;
        }
      };
      xmlhttp.open("GET", "table.php?q=" + source, true);
      xmlhttp.send();
  }
}