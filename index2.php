<?php
session_start();
?>
<!DOCTYPE html>
<html>

<head>
    <title>Carrinho de compras</title>
    <link rel="stylesheet" href="styles.css">
</head>

<body>
    <div class="menu">
        <img src="imgs/logo.png" />
        <ul id="nav">
            <li><img href="./index.php" src="imgs/frutas.png" /><a href="./index.php">Frutas</a1>
                    </l>

            <li><img src="imgs/talheres.png" /><a href="#">Diversos</a></li>
            <div class="selecionado">
                <li><img src="imgs/bebidas.png" />
                    <a1 href="#">Bebidas</a1>
                </li>
            </div>
            <li><img src="imgs/produtos-higiene.png" /><a href="#">Limpeza</a></li>
        </ul>
    </div>
    <h3 class="title-frutas">Bebidas</h3>
    <div class="itens-container">
        <?php
        //ARRAY MULTIDIMENCIONAL
        $itens = array(
            ['image' => 'imgs/tangmorango.webp', 'nome' => 'Tang', 'preco' => '1.10'],
            ['image' => 'imgs/taquery.webp', 'nome' => 'Tanqueray ', 'preco' => '130.90'],
            ['image' => 'imgs/vodka.webp', 'nome' => 'Beefeater', 'preco' => '140.00'],
            ['image' => 'imgs/ice.webp', 'nome' => 'ice', 'preco' => '4.47'],
            ['image' => 'imgs/chivas.webp', 'nome' => 'Chivas Regal', 'preco' => '120.49'],
            ['image' => 'imgs/black.webp', 'nome' => 'Black White', 'preco' => '62.90']
        );

        foreach ($itens as $key => $value) {
        ?>

            <div class="produto">
                <img src="<?php echo $value['image'] ?>" />
                <a href="?adicionar=<?php echo $key ?>">Add ao carrinho</a>
                <p><?php echo $value['nome'] ?></p>
                <p2>R$ <?php echo $value['preco'] ?></p2>
            </div>

        <?php
        }
        ?>


        <?php
        //ADD CARRINHO
        if (isset($_GET['adicionar'])) {
            $idProduto = (int) $_GET['adicionar'];
            if (isset($itens[$idProduto])) {
                if (isset($_SESSION['carrinho'][$idProduto])) {
                    $_SESSION['carrinho'][$idProduto]['quantidade']++;
                } else {
                    $_SESSION['carrinho'][$idProduto] = array('quantidade' => 1, 'nome' => $itens[$idProduto]['nome'], 'preco' => $itens[$idProduto]['preco']);
                }
                echo '<script>alert("o item foi adicionado ao carrinho.");</script>';
            }
        }
        ?>

        <div class="carrinho">
            <div class="ti-carrinho">
                <h2>Nova compra</h2>
                <p>
                    <?php
                    //QUANTIDADE DE ITENS NO CARRINHO
                    $qt_itens = 0;
                    foreach ($_SESSION['carrinho'] as $key => $value) {
                        $qt_itens += $value['quantidade'];
                    }
                    echo $qt_itens;
                    ?>
                    itens no carrinho
                <p>
            </div>
            <div class="produtos">

                <?php

                //LISTANDO OS ITENS ADICIONADOS

                foreach ($_SESSION['carrinho'] as $key => $value) {
                ?>

                    <div class="itens">
                        <a href="?remover=<?php echo $key ?>"><img src="imgs/lixo.png" /></a>
                        <div class="nome_preco">
                            <h2><?php echo $value['nome'] ?></h2>

                            <?php $preco = $value['preco'] * $value['quantidade']; ?>
                            <p>R$ <?php echo number_format($preco, 2, ',', '.'); ?></p>

                        </div>
                        <p2><?php echo $value['quantidade'] ?></p2>
                        <hr>
                    </div>
                <?php
                }
                ?>

                <!-- <?php
                        $idProduto = 0;
                        //REMOVER DO CARRINHO
                        if (isset($_GET['remover'][$idProduto])) {
                            $idProduto = (int) $_GET['remover'];
                            if (isset($_SESSION['carrinho'][$idProduto])) {
                                unset($_SESSION['carrinho'][$idProduto]);
                            }
                        }

                        //esvaziar carrinho 
                        if ($_GET['finalizar']) {
                            unset($_SESSION['carrinho']);
                        }

                        ?> -->


            </div>
            <div class="total">
                <h2>Subtotal<p>R$

                        <?php

                        //SUBTOTAL DA COMPRA
                        $sub = '0';
                        $total = '0';
                        foreach ($_SESSION['carrinho'] as $key => $value) {
                            $sub += $value['preco'] * $value['quantidade'];
                        }
                        echo number_format($sub, 2, ',', '.');
                        ?></p>
                </h2>

                <h2>Total<p1>R$

                        <?php

                        //TOTAL DA COMPRA
                        foreach ($_SESSION['carrinho'] as $key => $value) {
                            $total += $value['preco'] * $value['quantidade'];
                        }
                        echo number_format($total, 2, ',', '.');
                        ?></p1>
                </h2>

                <a href="?finalizar=<?php echo $key ?>"><button>Finalizar</button></a>
            </div>
        </div>
    </div>
</body>

</html>