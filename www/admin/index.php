<?php
//check where user has admin privileges

?>

<!DOCTYPE HTML>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Admin Portal</title>
<link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.9/css/all.css">
<style>
body {font-family:"Helvetica Neue", Helvetica, Arial;margin:0;padding:0;background:#FFF;padding-top:60px; padding-bottom:0px;}
body,html{height:100%;width:100%}
 </style>
</head>
<body>
<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container">
  <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">Sales Platform Admin Portal</a>
    </div>

  <ul class="nav navbar-nav">
        <li><a href="viewanddelete.php">Product Management</span></a></li>
        <li><a href="product.php">Add Products</a></li>
        <li><a href="deleteusers.php">Delete users</a></li>
        
        
      </ul>
      <ul class="nav navbar-nav navbar-right">
      <li><a href="logout.php">Logout</a></li>
</ul>
</div>
</nav>


</body>
</html>