<html>
<head><title>Send a wish to the Christkind</title>
<link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
</head>
<body>
<div class="container">

            <div class="row">

                <div class="col-xl-8 offset-xl-2 py-5">
<?php
if($_GET['error']) {
print('<div class="alert alert-danger">');
print('<strong>Error: </strong>' . $_GET['error']);
print('</div>');
}
?>

<?php
if($_GET['success']) {
print('<div class="alert alert-success">');
print('<strong>Success: </strong>' . $_GET['success']);
print('</div>');
}
?>



                    <h1>Send your wish to the Christkind</h1>

                    <p class="lead"></p>
			
                      <form action="wish.php" method="post">
  <div class="form-group">
    <label for="wish">My wish is...</label>
    <textarea class="form-control" id="wish" name="wish" aria-describedby="wishHelp" maxlength="65"></textarea>
    <small id="wishHelp" class="form-text text-muted">Max 65. characters</small>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

                </div>

            </div>

</div>

<script src="/js/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
<script src="/js/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="/bootstrap/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</body>
</html>
