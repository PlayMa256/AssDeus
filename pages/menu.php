<div id='cssmenu'>
   <ul>
        <?php
        $cargosAltos = array('1',
            '2',
            '10'
        );
        $meio = array('3',
            '4',
            '5',
            '6',
            '7'
        );
        $cargo = $_SESSION['cargo'];
        $usuario = $_SESSION['usuario'];

        $nao_acessam = array(8,9);
        $procura_permissao = mysql_query("SELECT id FROM permissao WHERE id_membro = '$usuario'");
        $conta = mysql_num_rows($procura_permissao);



        if(in_array($cargo, $nao_acessam)){

        }else if(in_array($cargo, $cargosAltos) || in_array($cargo, $meio)){

        ?>

        <!--colocar class active depois ao que estiver ativado-->
        <li class='has-sub'><a href='#'><span>Congregações</span></a>
            <ul>
                <li ><a href='cadastra_congregacao'><span>Cadastrar</span></a></li>
                <li ><a href='list_congregacao'><span>Gerenciar</span></a></li>
            </ul>
        </li>
        <li class='has-sub'><a href='#'><span>Membros</span></a>
            <ul>
                <li><a href='cadastra_membros'><span>Cadastrar</span></a></li>
                <li><a href='list_membros?mc=<?php echo $_SESSION['cargo'];?>'><span>Gerenciar</span></a></li>
                <li><a href='list_obreiros?mc=<?php echo $_SESSION['cargo'];?>'><span>Listar Obreiros</span></a></li>
                <!--<li><a href='list_reuniao'><span>Presen&ccedil;a</span></a></li>-->
            </ul>
        </li>
        <li class='has-sub'><a href='#'><span>Eventos</span></a>
            <ul>
                <li><a href='cadastra_eventos'><span>Cadastrar</span></a></li>
                <li><a href='list_eventos'><span>Gerenciar</span></a></li>

            </ul>
        </li>
        <li class='has-sub'><a href='#'><span>Alojamentos</span></a>
            <ul>
                <li><a href='cadastra_alojamento'><span>Cadastrar</span></a></li>
                <li><a href='list_alojamentos'><span>Gerenciar</span></a></li>
                <li><a href='relatorio_ocupantes'><span>Relat&oacute;rio de ocupantes</span></a></li>
            </ul>
        </li>
        <li class='has-sub'><a href='#'><span>Reuni&atilde;o</span></a>
            <ul>
                <li><a href='cadastra_reuniao?mc=<?php echo $_SESSION['cargo'];?>'><span>Cadastrar</span></a></li>
                <li><a href='list_reuniao?mc=<?php echo $_SESSION['cargo'];?>&m=<?php echo $_SESSION['usuario'];?>'><span>Gerenciar</span></a></li>
                <?php
                	if($cargo == 10 || $conta == 1){
                		echo '<li>
		                        <a href="list_justificativas"><span>Justificativas</span></a>
		                    </li>';		
                	}
                ?>
            </ul>
        </li>

        <?php
            if($cargo == 10 || $conta == 1){
                echo "<li class='has-sub'><a href='#'><span>Advert&ecirc;ncia</span></a>";
                echo '<ul>
                         <li><a href="gerar_adv"><span>Gerar Advert&ecirc;ncia</span></a></li>
                         <li><a href="suspende_adv"><span>Retirar Advert&ecirc;ncia</span></a></li>
                    </ul>
                ';

                echo '<li class="has-sub"><a href="classificar_membros"><span>Relat&oacute;rios</span></a>
                    <ul>
                        <li><a href="classificar_membros"><span>Imprimir Relat&oacute;rio Espec&iacute;fico</span></a></li>
                        <li><a href="membros_presentes"><span>Imprimir Relat&oacute;rio de Membros presentes</span></a></li>
                        <li><a href="relatorio_advertencias.php"><span>Imprimir Relat&oacute;rio de Advert&ecirc;ncias</span></a></li>
                    </ul>
                </li>';
                echo '<li>
                        <a href="gerar_cartao"><span>Imprimir Carteirinhas</span></a>
                    </li>';
            }
            if($_SESSION['cargo'] == 10){
                echo "<li class=''><a href='permissoes'><span>Permiss&otilde;es</span></a></li>";
            }
        ?>
        <li>
            <a href="gerar_cartao"><span>Imprimir Carteirinhas</span></a>
        </li>
        <?php
        }
        ?>
        <li><a href='../logout'><span>Sair</span></a></li>
    </ul>
</div><!--menu-->