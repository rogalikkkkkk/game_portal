<?php
session_start();
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <link rel="canonical" href="https://getbootstrap.com/docs/5.1/examples/sign-in/">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link href="../css/main.css" rel="stylesheet">

    <title>Главная</title>
</head>
<body>

<?php require_once("../templates/header.php") ?>

<main>
    <section>
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <h1 class="text-center text-black">Игровой портал GamePortal имени Дмитрия Жарков</h1>
                    <br><br>
                    <h5 class="text-center text-black"> На данном портале пользователь может поиграть в различные игры с
                        другими пользователями</h5>
                    <h5 class="text-center text-black">Вы можете создавать лобби сами или присоединяться к
                        существующим</h5>
                    <h5 class="text-center text-black">Если вы являетесь создателем лобби, то вы сами определяете, кто
                        играет вместе с вами</h5>
                    <h5 class="text-center text-black">Все действия производятся посредством перехода по вкладкам в
                        хедере</h5>
                </div>
            </div>
        </div>
    </section>
</main>


<?php require_once("../templates/footer.php") ?>

</body>
</html>
