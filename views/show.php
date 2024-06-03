<?php require_once $_SERVER['DOCUMENT_ROOT'].'/widgetForm.php';?>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
</head>
<body>

<div>asfsafasf</div>

<form id="myForm" action="" method="post">

    <?= widgetForm::input($notebooks_model, 'name');?>
    <?= widgetForm::input($notebooks_model, 'company');?>
    <?= widgetForm::input($notebooks_model, 'telefon');?>
    <?= widgetForm::input($notebooks_model, 'email');?>
    <?= widgetForm::input($notebooks_model, 'date');?>
    <?= widgetForm::file($notebooks_model, 'foto');?>

    <br/><button type="submit">Добавить</button>
</form>

<br>

</body>

</html>
