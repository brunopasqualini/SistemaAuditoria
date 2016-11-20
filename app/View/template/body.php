    <body>
        <header class="cor-tema">
            <div class="container">
                <div class="titulo nav-wrapper valing-wrapper center-align cor-tema">
                    <h3 class="white-text">Auditoria</h3>
                    <h5 class="white-text">"Auditorando as auditorias auditadas"</h5>
                    <br>
                </div>
            </div>
        </header>
        <?php 
            if(!\App\Controller\ControllerUserSession::isAuth()){
                \App\View\TemplateLoader::flush('menu'); 
            }
            else{
                $oUser = \App\Controller\ControllerUserSession::getUser();
                if($oUser->getTipo() == App\Model\ModelUsuario::TIPO_NORMAL){
                    \App\View\TemplateLoader::flush('menu_comum'); 
                }else{
                    \App\View\TemplateLoader::flush('menu_admin'); 
                }
            }
        ?>
        <div class="container">
            {{content}}
        </div>
        <?php \App\View\TemplateLoader::flush('footer'); ?>
        {{script}}
    </body>
</html>
