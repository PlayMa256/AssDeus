<?php
echo '<div id="paginacao">';
echo '<a href="?pagina=1" class="long" style="border-top-left-radius:4px;border-bottom-left-radius:4px">Primeira Página</a>';

/**
 * O loop para exibir os valores à esquerda
 */
for($i = $pagina-$exibir; $i <= $pagina-1; $i++){
    if($i > 0)
        echo '<a href="?pagina='.$i.'"> '.$i.' </a>';
}
/**
 * Depois o link da página atual
 */
echo '<a href="?pagina='.$pagina.'"><strong><strong>'.$pagina.'</strong></strong></a>';
/**
 * O loop para exibir os valores à direta
 */

for($i = $pagina+1; $i < $pagina+$exibir; $i++){
    if($i <= $totalPagina)
        echo '<a href="?pagina='.$i.'"> '.$i.' </a>';
}
/**
 * Agora monta o Link para Próxima Página
 * Depois O link para Última Página
 */
echo "<a href=\"?pagina=$totalPagina\" class=\"long\" style=\"border-top-right-radius:4px;border-bottom-right-radius:4px\">Última Página</a>";
echo '</div>';