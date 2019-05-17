function usernameValidator(validation) {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let usernameAble = JSON.parse(this.responseText);
            if(usernameAble.length == 0){
                //libero 
                document.getElementById('username').style.borderBottom = '2px solid green';
            }else{
                //occupato
                document.getElementById('username').style.borderBottom = '2px solid red';
            }

        }
    };
    xhttp.open("GET", "API/usernameAPI.php?u="+validation+'&limit=10', true);
    xhttp.send();
  }

  document.getElementById('username').addEventListener('keyup', function(){
    usernameValidator(this.value);
  });
  