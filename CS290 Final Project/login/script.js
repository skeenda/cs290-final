// Adapted from The New Boston's AJAX Tutorial: https://www.thenewboston.com/videos.php?cat=61&video=19315

var xmlHttp = createXmlHttpRequestObject();

function createXmlHttpRequestObject() {

  var xmlHttp;

  if (window.ActiveXObject) {
    try {
      xmlHttp = new ActiveXObject('Microsoft.XMLHTTP');
    }
    catch (e) {
      xmlHttp = false;
    }
  }
  else {
    try {
      xmlHttp = new XMLHttpRequest();
    }
    catch (e) {
      xmlHttp = false;
    }
  }

  if (!xmlHttp) {
    alert('Could not create XML Object');
  }
  else {
    return xmlHttp;
  }
}

function processName() {
    username = encodeURIComponent(document.getElementById('username').value);
    xmlHttp.open('GET', 'validName.php?username=' + username, true);
    xmlHttp.onreadystatechange = handleServerResponseName;
    xmlHttp.send();
}

function handleServerResponseName() {
  if (xmlHttp.readyState == 4)
    if (xmlHttp.status == 200) {
    xmlResponse = xmlHttp.responseXML;
    xmlDocumentElement = xmlResponse.documentElement;
    message = xmlDocumentElement.firstChild.textContent;
    document.getElementById('nameValid').innerHTML = message;
  }
}

