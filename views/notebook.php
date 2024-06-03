<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Form</title>
</head>
<body>
<form id="myForm" action="" method="post">

    <?php foreach ($notebook as $k=>$v):?>
        <div>
            <label for="<?php echo $k;?>"><?php echo $k;?></label>
            <input type="<?php echo $k;?>" id="<?php echo $k;?>" name="<?php echo $k;?>" value="<?php echo $v;?>" >
        </div>

    <?php endforeach;?>

    <br/><button type="submit">Изменить</button>
</form><br>

<div id="delete">Удалить</div>

<script src="/web/js/sendreq.js"></script>
</body>
</html>
