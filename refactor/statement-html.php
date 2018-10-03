<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css"
          integrity="sha384-9gVQ4dYFwwWSjIDZnLEWnxCjeSWFphJiwGPXr1jddIhOegiu1FwO5qRGvFXOdJZ4" crossorigin="anonymous">
    <title><?= $data['name'] ?></title>
</head>
<body>
<div class="container">
    <table class="table table-striped table-bordered">
        <thead class="thead-dark">
        <th colspan="2">
            <h1 class="text-center">
                <?= $data['name'] ?>
            </h1>
        </th>
        </thead>
        <tbody>
        <?php foreach ($data['body'] as $body): ?>
            <tr>
                <td>
                    <?= $body['title'] ?>
                </td>
                <td>
                    <?= $body['amount'] ?>
                </td>
            </tr>
        <?php endforeach; ?>
        <tr class="table-info">
            <td>
                Amount owed is
            </td>
            <td>
                <?= $data['total_amount'] ?>
            </td>
        </tr>
        <tr class="table-warning">
            <td>
                You earned frequent renter points
            </td>
            <td>
                <?= $data['total_frequent'] ?>
            </td>
        </tr>
        </tbody>
    </table>
</div>
</body>
</html>