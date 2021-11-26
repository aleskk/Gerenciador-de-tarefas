<?php
include '../ferramentas/validar_login.php';
require_once '../comum/header.php';
include_once '../comum/tipos_acesso.php';

$acessos = $_SESSION['acessos'];




if ($acessos[TipoAcesso::INCLUIR_EMPRESA]) {
    echo "
<div class=\"container\" >
        <div class=\"row g-3\">
            <div class=\"col\">

                <form method='POST' action='/action/incluir_empresa.php'>

                    <h1 class=\"editar\">Cadastrar</h1>
                    <div class=\"mb-3\">
                        <label for=\"name\" class=\"form-label\">Nome</label>
                        <input type=\"text\" name=\"nome\" id=\"name\" placeholder=\"Nome\" required class=\"form-control\" autofocus>
                    </div>
                    <div class=\"mb-3\">
                        <label for=\"area_atuacao\" class=\"form-label\">Área de atuação</label>
                        <input type=\"text\" name=\"area_atuacao\" id=\"area_atuacao\" placeholder=\"Área de atuação\" required class=\"form-control\" >
                    </div>
                    <div class=\"mb-3\">
                        <label for=\"sistema\" class=\"form-label\">Sistema</label>
                        <input type=\"text\" name=\"sistema\" id=\"area_atuacao\" placeholder=\"Sistema\" required class=\"form-control\" >
                    </div>
                    <div class=\"mb-3\">
                        <label for=\"mensalidade\" class=\"form-label\">Valor da mensalidade</label>
                        <input type=\"number\" name=\"mensalidade\" id=\"mensalidade\" placeholder=\"Mensalidade\" class=\"form-control\">
                    </div>
                    <div class=\"mb-3\">
                        <label for=\"dia_pagamento\" class=\"form-label\" >Dia do pagamento</label>
                        <input type=\"text\" name=\"dia_pagamento\" id=\"dia_pagamento\" placeholder=\"Dia de pagamento\" class=\"form-control\" size=2 maxlength=2>
                    </div>
                    <div class=\"mb-3\">
                        <label for=\"mapeamento\" class=\"form-label\" >Mapeamento</label>
                        <input type=\"text\" name=\"mapeamento\" id=\"mapeamento\" placeholder=\"Mapeamento\" required class=\"form-control\" size=1 maxlength=1>
                    </div>
                    <div class=\"mb-3\">
                        <label for=\"servidor\" class=\"form-label\" >Servidor</label>
                        <input type=\"text\" name=\"servidor\" id=\"servidor\" placeholder=\"Servidor\" class=\"form-control\">
                    </div>
                    <div class=\"mb-3\">
                    
                        <label for=\"cnpj\" class=\"form-label\" >CNPJ</label>
                        <input type=\"text\" name=\"cnpj\" id=\"cnpj\" placeholder=\"##.###.###/####-##\" required class=\"form-control\" size=18 maxlength=18>
                </div>
                <div class=\"mb-3\">
                    <label for=\"site\" class=\"form-label\">Site</label>
                    <input type=\"text\" name=\"site\" id=\"site\" placeholder=\"Site\" class=\"form-control\">
            </div>
                    <button type=\"submit\"class=\"btn btn-outline-primary\">Incluir <svg xmlns=\"http://www.w3.org/2000/svg\" width=\"16\" height=\"16\" fill=\"currentColor\" class=\"bi bi-plus-circle-fill\" viewBox=\"0 0 16 16\">
                    <path d=\"M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z\"/>
                  </svg></button>
            </div>
        </div>
    </div>

    </form>
    </div>";
} else {
    echo "<script>
  Swal.fire({
    icon: 'error',
    title: 'Você não tem permissão de acessar essa área',
    showConfirmButton: false,
  
  })</script>";
}
?>
</form>


</body>

</html>