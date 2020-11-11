<?php include "templates/header.php"; ?>

<script>
function logout () {
  var data = new FormData();
  data.append('req', 'out');
  var xhr = new XMLHttpRequest();
  xhr.open('POST', "../3-ajax.php");
  xhr.onload = function () {
    if (xhr.status==200) {
      let response = JSON.parse(this.response);
      if (response.status) {
        window.location.href = "../login.php";
      } else {
        alert(response.msg);
      }
    }
    else {
      alert("SERVER ERROR");
      console.log(this.response);
    }
  };
  xhr.onerror = function(e){
    alert("SERVER ERROR");
    console.log(e);
  };
  xhr.send(data);
  return false;
}
</script>

  <main id="main_area" class="front-page" role="main">
        <div id="main_content">

      <div class="container" id="content" role="main">

        
          
             <div class="row">
              <div class="col-lg-9 col-md-8">

<ul>
	<li><a href="create.php"><strong>Visitors</strong></a> - add a visitor</li>
	<li><a href="read.php"><strong>Reception</strong></a> - search for visitors</li>
	<li><a href="update.php"><strong>Update</strong></a> - edit a visit</li>
	<li><a href="delete.php"><strong>Delete</strong></a> - delete a visit</li>
</ul>
<h1>YOU HAVE SIGNED IN</h1>
    <?php
    print_r($_SESSION['user']);
    // $_SESSION['user']['name']
    // $_SESSION['user']['email']
    ?>
    <input type="button" value="Logout" onclick="logout()"/>
</div>
<?php include "templates/footer.php"; ?>
