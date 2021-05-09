<?php
    include("db.php");
    include("includes/head.php");
?>

<body>

<?php
    include("includes/searchBar.php");
?>

<body class="container main">

<?php 

if(isset($_POST['search'])) {
    $text = $_POST['text'];
    $arrText = explode(" ", $text);

    function negrita($revisar, $word) {
        $newText = preg_replace('#'. preg_quote($word) .'#', '<span class="negrita">\0</span>', $revisar);
        return $newText;
    }


    if(count($arrText) > 1) {
        foreach($arrText as $item) {
            $query = "SELECT * FROM products WHERE titulo LIKE '%$item%' ORDER BY titulo";
            $result = mysqli_query($conn, $query);

            while($row = mysqli_fetch_array($result)) {
                $titulo = !empty($text)?negrita($row['titulo'], $item):$row['titulo'];
                $descripcion = !empty($text)?negrita($row['descripcion'], $item):$row['descripcion'];
                
                ?>
                <div class="card col-12 product">
                    <div class="card-body product__item">
                        <h3 class="card-title">
                            <?php echo $titulo;?>
                        </h3>
                        <p class="card-text">
                            <?php echo $descripcion;?>
                        </p>
                        <p class="card-text added">Precio: $<?php echo $row['precio'];?></p>
                        <p class="card-text added">Fecha de inicio: <?php echo $row['fecha_inicio'];?></p>
                        <p class="card-text added">Fecha de termino: <?php echo $row['fecha_termino'];?></p>
                    </div>
                </div>
            <?php }
        }
    }


    $query = "SELECT * FROM products WHERE titulo LIKE '%$text%' ORDER BY titulo";
    $result = mysqli_query($conn, $query);

    while($row = mysqli_fetch_array($result)) {
            $titulo = !empty($text)?negrita($row['titulo'], $text):$row['titulo'];
            $descripcion = !empty($text)?negrita($row['descripcion'], $text):$row['descripcion'];
         ?>
                <div class="card col-12 product">
                    <div class="card-body product__item">
                        <h3 class="card-title">
                            <?php echo $titulo;?>
                        </h3>
                        <p class="card-text">
                            <?php echo $descripcion;?>
                        </p>
                        <p class="card-text added">Precio: $<?php echo $row['precio'];?></p>
                        <p class="card-text added">Fecha de inicio: <?php echo $row['fecha_inicio'];?></p>
                        <p class="card-text added">Fecha de termino: <?php echo $row['fecha_termino'];?></p>
                    </div>
                </div>
    <?php }


}

include('includes/scripts.php');

?>

</body>

