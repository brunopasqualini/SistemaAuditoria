<?php
    $oFormProduto = (new \App\View\ViewFormProduto())->getForm();
    $oFormProduto->setAction(\App\Controller\Controller::ACTION_INSERT);
?>
<nav class="cor-tema">
    <div class="nav-wrapper">
        <div class="container">
            <a href="<?=$oFormProduto->getQueryString();?>" class="right hide-on-med-and-down">Sair</a>
            <ul class="left hide-on-med-and-down">
                <li><a href="index.php">Início</a></li>
                <li><a href="<?=$oFormProduto->getQueryString();?>">Produto</a></li>
                <li><a href="<?=$oFormProduto->getQueryString();?>">Cidade</a></li>
                <li><a href="<?=$oFormProduto->getQueryString();?>">Cliente</a></li>
                <li><a href="<?=$oFormProduto->getQueryString();?>">Venda</a></li>
                <li><a href="<?=$oFormProduto->getQueryString();?>">Consultas de Logs</a></li>
            </ul>
            <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="side-nav" id="mobile-menu">
                <li><a href="index.php">Início</a></li>
                <li><a href="<?=$oFormProduto->getQueryString();?>">Produto</a></li>
                <li><a href="<?=$oFormProduto->getQueryString();?>">Cidade</a></li>
                <li><a href="<?=$oFormProduto->getQueryString();?>">Cliente</a></li>
                <li><a href="<?=$oFormProduto->getQueryString();?>">Consulta de Logs</a></li>
                <li><a href="<?=$oFormProduto->getQueryString();?>">Sair</a></li>
            </ul>
        </div>
    </div>
</nav>
