<!DOCTYPE html>
<html>
<head>
    <meta charset='utf-8'>
    <meta http-equiv='X-UA-Compatible' content='IE=edge'>
    <title><?php echo $title ; ?></title>
    <meta name='viewport' content='width=device-width, initial-scale=1'>
    <link rel='stylesheet' type='text/css' media='screen' href='main.css'>
    <script src='main.js'></script>
</head>
<body>
    <label><h1>This is Header from partials</h1></label>

    As-salamu Alaiqum <?php echo $name ; ?>

    <div>Test include</div>

    
        <h1>Hello, Arif!</h1>
    

    <div>
        For Loop Test:

        <?php for ($i = 0; $i < 10; $i++): ?>
            The current value is <?php echo $i ; ?>
        <?php endfor; ?>

        For Each Test:
        <ul>
            <?php foreach ($items as $item): ?>
                <li><?php echo $item ; ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <label><h1>This is Footer from partials</h1></label>

</body>
</html>

