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
        <div class="container">
            {{content}}
        </div>
        <?php \App\View\TemplateLoader::flush('footer'); ?>
        {{script}}
    </body>
</html>
