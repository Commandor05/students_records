<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>Students records</title>

    <!-- Bootstrap -->
    <link href="/application/views/layouts/css/bootstrap.css" rel="stylesheet">
    <link href="/application/views/layouts/css/style.css" rel="stylesheet">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>


<!-- Header -->

<div class="transparent">
    <div class="header">

        <h1> Students Records </h1><span class="glyphicon glyphicon-user"></span>

    </div>
</div>

<!-- Men menu -->


<br/>

<p><a href="/">Home page</a>|
    <a href="/students/list">Students list</a>|
    <a href="/students/add">Add record</a></p>
<hr/>
<!-- Content -->
<?= $this->content ?>


<!-- Footer -->
<div class="stuff"></div>
<div class="transparent">
    <div class="footer">
        <p><?= date('l jS \of F Y') ?></p>

        <p>© OK</p>
    </div>
</div>


<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.2/jquery.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="/application/views/layouts/js/bootstrap.js"></script>
</body>
</html>



