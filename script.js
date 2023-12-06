function ajax() {
  let name = document.getElementById("name").value;
  let email = document.getElementById("email").value;
  let subject = document.getElementById("subject").value;
  let message = document.getElementById("message").value;

  let form = new FormData();
  form.append("name", name);
  form.append("email", email);
  form.append("subject", subject);
  form.append("message", message);

  let request = new XMLHttpRequest();

  request.onreadystatechange = function () {
    if (request.readyState == 4 && request.status == 200) {
      let response = request.responseText;
      // console.log(response);
      // document.getElementById('alertSection').innerHTML = response;
      if (response == "completed") {
        document.getElementById("alertSection").innerHTML =
          "Message successfully sent.";
      } else if (response == "empty") {
        document.getElementById("alertSection").innerHTML =
          "all data must be fill.";
      } else if (response == "error") {
        document.getElementById("alertSection").innerHTML = "somthing wrong";
      } else {
        document.getElementById("alertSection").innerHTML =
          "somthing went wrong please try again later.";
      }
    }
  };
  request.open("POST", "process.php", true);
  request.send(form);
}


