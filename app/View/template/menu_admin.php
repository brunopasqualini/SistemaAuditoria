<ul id="menu-admin-dropdown" class="dropdown-content">
  <li><a href="?path=gridLogsAcesso">Acesso</a></li>
  <li><a href="?path=gridLogs">Banco de Dados</a></li>
</ul>

<nav class="cor-tema">
    <div class="nav-wrapper">
        <div class="container">
            <a href="?path=logout" class="right hide-on-med-and-down">{{usuario}} - Sair</a>
            <ul class="left hide-on-med-and-down">
                <li><a href="index.php">Início</a></li>
                <li><a href="?path=gridProduto">Produto</a></li>
                <li><a href="?path=gridCidade">Cidade</a></li>
                <li><a href="?path=gridCliente">Cliente</a></li>
                <li><a href="?path=gridUsuario">Usuário</a></li>
                <li>
                    <a class="dropdown-button" href="#!" data-activates="menu-admin-dropdown">
                        Logs
                        <i class="material-icons right">arrow_drop_down</i>
                    </a>
                </li>
            </ul>
            <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>
            <ul class="side-nav" id="mobile-menu">
                <li><a href="index.php">Início</a></li>
                <li><a href="?path=gridProduto">Produto</a></li>
                <li><a href="?path=gridCidade">Cidade</a></li>
                <li><a href="?path=gridCliente">Cliente</a></li>
                <li><a href="?path=gridUsuario">Usuário</a></li>
                <li><a href="?path=gridLogsAcesso">Log - Acesso</a></li>
                <li><a href="?path=gridLogs">Log - Banco de Dados</a></li>
            </ul>
        </div>
    </div>
</nav>
