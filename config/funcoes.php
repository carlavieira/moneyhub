<?

$GLOBALS['normalizeChars'] = array(
	'Š'=>'S', 'š'=>'s', 'Ð'=>'Dj','Ž'=>'Z', 'ž'=>'z', 'À'=>'A', 'Á'=>'A', 'Â'=>'A', 'Ã'=>'A', 'Ä'=>'A',
	'Å'=>'A', 'Æ'=>'A', 'Ç'=>'C', 'È'=>'E', 'É'=>'E', 'Ê'=>'E', 'Ë'=>'E', 'Ì'=>'I', 'Í'=>'I', 'Î'=>'I',
	'Ï'=>'I', 'Ñ'=>'N', 'Ò'=>'O', 'Ó'=>'O', 'Ô'=>'O', 'Õ'=>'O', 'Ö'=>'O', 'Ø'=>'O', 'Ù'=>'U', 'Ú'=>'U',
	'Û'=>'U', 'Ü'=>'U', 'Ý'=>'Y', 'Þ'=>'B', 'ß'=>'Ss','à'=>'a', 'á'=>'a', 'â'=>'a', 'ã'=>'a', 'ä'=>'a',
	'å'=>'a', 'æ'=>'a', 'ç'=>'c', 'è'=>'e', 'é'=>'e', 'ê'=>'e', 'ë'=>'e', 'ì'=>'i', 'í'=>'i', 'î'=>'i',
	'ï'=>'i', 'ð'=>'o', 'ñ'=>'n', 'ò'=>'o', 'ó'=>'o', 'ô'=>'o', 'õ'=>'o', 'ö'=>'o', 'ø'=>'o', 'ù'=>'u',
	'ú'=>'u', 'û'=>'u', 'ý'=>'y', 'ý'=>'y', 'þ'=>'b', 'ÿ'=>'y', 'ƒ'=>'f', '´'=>'', '`'=>'', '~'=>'', '^'=>''
);

$dayweek = array("Domingo","Segunda","Terça","Quarta","Quinta","Sexta","Sábado","Domingo");
$monthname = array("Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro");

$isSecure = false;
if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] == 'on') {
	$isSecure = true;
}
elseif (!empty($_SERVER['HTTP_X_FORWARDED_PROTO']) && $_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https' || !empty($_SERVER['HTTP_X_FORWARDED_SSL']) && $_SERVER['HTTP_X_FORWARDED_SSL'] == 'on') {
	$isSecure = true;
}
$REQUEST_PROTOCOL = $isSecure ? 'https' : 'http';

function shorten_string($oldstring, $wordsreturned)
{
	$retval = "";
	$string = preg_replace('/(?<=\S,)(?=\S)/', ' ', $oldstring);
	$string = str_replace("\n", " ", $string);
	$array = explode(" ", $string);
	if (count($array)<=$wordsreturned)
	{
		$retval = $string;
	}
	else
	{
		array_splice($array, $wordsreturned);
		$retval = implode(" ", $array)." ...";
	}
	return $retval;
}

function possui_ordem($table) {

	$sql_colunas = "SHOW COLUMNS FROM $table;";
	$query_colunas = mysqli_query($GLOBALS["db"],$sql_colunas);
	$dados_colunas = mysqli_fetch_array($query_colunas);

	$colunas = array();
	while($dados_colunas = mysqli_fetch_array($query_colunas))
	{
		$colunas[] = $dados_colunas['Field'];
	}

	if(in_array("admin_ordem",$colunas)) {
		return true;
	} else {
		return false;
	}

}

function estiliza_data($d) {
	$d = explode(" ",$d);
	$d = explode("-",$d[0]);

	$dia = str_split($d[2],1);
	$mes = str_split($d[1],1);
	$ano = str_split($d[0],1);

	$dia = implode(" ",$dia);
	$mes = implode(" ",$mes);
	$ano = implode(" ",$ano);

	$data = $dia."  /  ".$mes."  /  ".$ano;
	return $data;
}

function imp($v) { if($v == "") { return "Não respondeu."; } else { return $v; } }

function formatar_data($data) {
	$d = explode("-",$data);
	$dia = explode(" ",$d[2]);
	$dia = $dia[0];
	$mes = $d[1];
	if($mes < 10) {
		$mes = str_replace("0","",$mes);
	}
	$meses = array("JAN","FEV","MAR","ABR","MAI","JUN","JUL","AGO","SET","OUT","NOV","DEZ");
	echo "<span>$dia</span>".$meses[$mes];
}

function cleanForShortURL($toClean) {
	$toClean     =     strtr($toClean, $GLOBALS['normalizeChars']);

	$toClean     =     str_replace('&', '-and-', $toClean);
	$toClean     =     trim(preg_replace('/[^\w\d_ -]/si', '', $toClean));//remove all illegal chars
	$toClean     =     str_replace(' ', '-', $toClean);
	$toClean     =     str_replace('--', '-', $toClean);
	$toClean     =     strtolower($toClean);

	return $toClean;
}

function retira_prefixo($nome_table) {
	if(strpos($nome_table,"_") !== false) { $n = explode("_",$nome_table); return $n[1]; } else { return $nome_table; }
}

function normalizaString($string) {
	if($string == "Email" || $string == "email") { $string = "e-mail"; }
	$string = str_replace("_"," ",$string);
	$string = ucfirst($string);

	return $string;
}

function my_file_get_contents( $site_url ){
	$ch = curl_init();
	$timeout = 5; // set to zero for no timeout
	curl_setopt ($ch, CURLOPT_URL, $site_url);
	curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	ob_start();
	curl_exec($ch);
	curl_close($ch);
	$file_contents = ob_get_contents();
	ob_end_clean();
	return $file_contents;
}

function is_image($path)
{
	$a = getimagesize($path);
	$image_type = $a[2];

	if(in_array($image_type , array(IMAGETYPE_GIF , IMAGETYPE_JPEG ,IMAGETYPE_PNG , IMAGETYPE_BMP)))
	{
		return true;
	}
	return false;
}

function retornaQS($sep){

	$qs = explode("&", $_SERVER['QUERY_STRING']);
	$arr = array();
	for($i=0; $i<count($qs); $i++){
		$d = explode("=", $qs[$i]);
		if($d[0]!="msg" && $d[0]!="msgErro" && $d[0]!="id"){
			array_push($arr, $qs[$i]);
		}
	}
	return implode($sep, $arr);
}

function formata_data_site($data){
	$data_hora = explode(" ", $data);
	$data = explode("-", $data_hora[0]);

	return $data[2]."/".$data[1]."/".$data[0];
}

function formata_data_hora_site($data){
	$data_hora = explode(" ", $data);
	$data = explode("-", $data_hora[0]);

	return $data[2]."/".$data[1]."/".$data[0]." ".substr($data_hora[1], 0, 5).'h';
}

function formata_data_bd($data){
	if($data==""){
		return "";
	} else {
		$data_hora = explode(" ", $data);
		$data = explode("/", $data_hora[0]);

		if($data_hora[1] != "") {

			return $data[2]."-".$data[1]."-".$data[0]." ".$data_hora[1];
		} else {
			return $data[2]."-".$data[1]."-".$data[0];

		}


	}
}

function catch_that_image($txt) {
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all('/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $txt, $matches);
	if($output>0)
		$first_img = $matches [1][0];


	if(empty($first_img)){ //Defines a default image
		return "";
	} else {
		return $first_img;
	}
}

function pega_dado_bd($id, $campo, $tbl){
	$sql = "SELECT * FROM $tbl WHERE id='$id'";
	$query = mysqli_query($GLOBALS["db"],$sql);
	$num = mysqli_num_rows($query);

	if($num>0){
		return mysqli_result($query, 0, $campo);
	} else {
		return "";
	}
}

function pegar_extensao($arquivo)
{
	$r = explode(".",$arquivo);
	return end($r);
}

function ajusta_path_img($p){

	$p = str_replace("../", "", $p);

	return $p;
}

function lz_pega_array_por_sql($sql){
	$query = mysqli_query($GLOBALS["db"],$sql);
	return mysqli_fetch_array($query);
}

function lz_pega_array_por_id($id){
	$sql = "SELECT * FROM textos WHERE id='$id'";
	$query = mysqli_query($GLOBALS["db"],$sql);
	return mysqli_fetch_array($query);
}

function lz_pega_query_por_area($area, $ordem="ordem, id"){
	$sql = "SELECT * FROM textos WHERE area='$area' ORDER BY $ordem";
	$query = mysqli_query($GLOBALS["db"],$sql);
	return ($query);
}

function lz_pega_query_foto_por_area($area, $ordem="ordem, id"){
	$sql = "SELECT * FROM fotos WHERE area='$area' ORDER BY $ordem";
	$query = mysqli_query($GLOBALS["db"],$sql);
	return ($query);
}

function lz_pega_query_por_url($url, $ordem="ordem, id"){
	$sql = "SELECT * FROM textos WHERE url='$url' ORDER BY $ordem";
	$query = mysqli_query($GLOBALS["db"],$sql) or die (mysqli_error($GLOBALS["db"]));
	return ($query);
}

function lz_pega_array_por_url($url, $ordem="ordem, id"){
	$sql = "SELECT * FROM textos WHERE url='$url' ORDER BY $ordem";
	$query = mysqli_query($GLOBALS["db"],$sql) or die (mysqli_error($GLOBALS["db"]));
	return mysqli_fetch_array($query);
}

function lz_pega_noticias_por_area($area, $tag_titulo, $classe_texto, $col_resumo="i0", $qtd_pp=9999, $pag_atual=0 , $ordem="ordem DESC, id"){

	$sql = "SELECT * FROM textos WHERE area='$area' ORDER BY $ordem";
	$query = mysqli_query($GLOBALS["db"],$sql);

	while($dados = mysqli_fetch_array($query)){
		echo "<a href='noticia/".$dados['url']."'>";
		echo "<small>".formata_data_site($dados['data_cadastro'])."</small>";
		echo "<$tag_titulo>".$dados['titulo']."</$tag_titulo>";
		echo "<div class=\"$classe_texto\">".ajusta_path_img($dados[$col_resumo])."</div>";
		echo "</a>";
	}
}

function lz_pega_query_por_sql($sql){
	$query = mysqli_query($GLOBALS["db"],$sql);
	return ($query);
}

function lz_pega_texto_por_id($id, $tag_titulo, $classe_texto, $col_texto_bd="t0"){
	$sql = "SELECT * FROM textos WHERE id='$id'";
	$query = mysqli_query($GLOBALS["db"],$sql);
	$num = mysqli_num_rows($query);

	if($num>0){
		echo "<$tag_titulo>".mysqli_result($query, 0, 'titulo')."</$tag_titulo>";
		echo "<div class=\"$classe_texto\">".ajusta_path_img(mysqli_result($query, 0, $col_texto_bd))."</div>";
	} else {
		//return "";
	}
}

function lz_pega_texto_por_url($url, $tag_titulo, $classe_texto, $col_texto_bd="t0"){
	$sql = "SELECT * FROM textos WHERE url='$url'";
	$query = mysqli_query($GLOBALS["db"],$sql);
	$num = mysqli_num_rows($query);

	if($num>0){
		echo "<$tag_titulo>".mysqli_result($query, 0, 'titulo')."</$tag_titulo>";
		echo "<div class=\"$classe_texto\">".ajusta_path_img(mysqli_result($query, 0, $col_texto_bd))."</div>";
	} else {
		//return "";
	}
}

function lz_verifica_foto_por_id($id){
	$sql = "SELECT * FROM fotos WHERE area='$id' ORDER BY ordem, id";
	$query = mysqli_query($GLOBALS["db"],$sql);
	$num = mysqli_num_rows($query);

	if($num>0){
		return true;
	} else {
		return false;
	}
}

function lz_monta_menu_por_area($area, $classe_ul, $id_sel, $titulo=''){
	$sql = "SELECT * FROM textos WHERE area='$area' ORDER BY ordem, id";
	$query = mysqli_query($GLOBALS["db"],$sql);

	echo "<ul id=\"$classe_ul\">";

	while($dados = mysqli_fetch_array($query)){
		$url = "#interna_sub.php?area=$area&id=".$dados['id']."&titulo=".$titulo;
		if($dados['id']==$id_sel){
			echo '<li class="sel"><a href="'.$url.'">'.$dados['titulo'].'</a></li>';
		} else {
			echo '<li><a href="'.$url.'">'.$dados['titulo'].'</a></li>';
		}
	}

	echo "</ul>";
}



function lz_monta_galleria_por_id($id){
	$sql = "SELECT * FROM fotos WHERE area='$id' ORDER BY ordem, id";
	$query = mysqli_query($GLOBALS["db"],$sql);

	echo "<div id=\"galleria\">";

	while($dados = mysqli_fetch_array($query)){
		echo '<a href="fotos/'.$dados['area'].'/g_'.$dados['arquivo'].'"><img src="fotos/'.$dados['area'].'/p_'.$dados['arquivo'].'" data-big="fotos/'.$dados['area'].'/'.$dados['arquivo'].'" data-title="'.$dados['legenda'].'"></a>';
	}

	echo "</div>";
}

function lz_pega_primeiro_id_por_area($area){
	$sql = "SELECT * FROM textos WHERE area='$area'";
	$query = mysqli_query($GLOBALS["db"],$sql);
	return mysqli_result($query, 0, 'id');
}

function mostra_video_por_url($url, $w, $h){
	$id = _youtube_video_id($url);
	if($id!=""){
		echo '<iframe width="'.$w.'" height="'.$h.'" src="//www.youtube.com/embed/'.$id.'?rel=0" frameborder="0" allowfullscreen></iframe>';
	} else {
		$id = _vimeo_video_id($url);
		echo '<iframe src="http://player.vimeo.com/video/'.$id.'?title=0&amp;byline=0&amp;portrait=0" width="'.$w.'" height="'.$h.'" frameborder="0" webkitAllowFullScreen mozallowfullscreen allowFullScreen></iframe>';
	}

}

function _is_vimeo($url){
	return (preg_match('/vimeo\.com/i', $url));
}

function _is_youtube($url){
	return (preg_match('/youtu\.be/i', $url) || preg_match('/youtube\.com\/watch/i', $url));
}

function _youtube_video_id($url) {
	if(_is_youtube($url))
	{
		$pattern = '/^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/';
		preg_match($pattern, $url, $matches);
		if (count($matches) && strlen($matches[7]) == 11)
		{
			return $matches[7];
		}
	}

	return '';
}

function _vimeo_video_id($url){
	if(_is_vimeo($url))
	{
		$pattern = '/\/\/(www\.)?vimeo.com\/(\d+)($|\/)/';
		preg_match($pattern, $url, $matches);
		if (count($matches))
		{
			return $matches[2];
		}
	}

	return '';
}

function pega_campos($table) {
	$sql = "show full columns from $table";
	$result = mysqli_query($GLOBALS["db"],$sql) or die(mysqli_error($GLOBALS["db"]));
	return $result;
}

function crud_tabela($table,$id=null,$editavel_externo=null,$sem_btn_adicionar=null) {

	$nome_table = normalizaString($table);

	$config_table = mysqli_query($GLOBALS["db"], "SELECT * FROM admin_configuracoes WHERE tabela = '$table' and campo = ''");
	if(mysqli_num_rows($config_table) != 0) {
		$tb_config = mysqli_fetch_array($config_table);
		if($tb_config["label"] != "") { $nome_table = $tb_config["label"]; }
	}
	?>

	<div class="tab-pane fade in <? if(!$editavel_externo) { echo "active"; } else { echo "multiplo"; } ?>" id="<?=$table?>">

		<div class="campos" id="campos_<?=$table?>" >
			<?

			//***** Recuperar informações *****

			if($id != null) {
				$count = 0;
				$sql_dados = mysqli_query($GLOBALS["db"], "SELECT * FROM $table WHERE id = '$id'");

				if(mysqli_num_rows($sql_dados) != 0) {
					$dados_arr = array();
					while($dados_edita = mysqli_fetch_array($sql_dados)) {

						$dados_arr[$count] = $dados_edita;
						$count++;

					}
				} else {
					$count = 1;
				}
			} else {
				$count = 1;
			}

			for($i = 0; $i < $count; $i++) {

				if(isset($dados_arr[$i])) {
					$dados = $dados_arr[$i];
				}

				if($editavel_externo) {
					$tabela_externa = $table;
					echo "<div class='col-md-12'>";
					include("tabela.php");
					echo "</div>";
				} else {
					?>
					<div class="col-md-<? if($id != null) { ?>9<? } else { ?>12<? } ?> column end">
						<h2>
							<? if($tb_config["icone"]) { ?><i class="<?=$tb_config["icone"]?>"></i><? } ?>
							<?=retira_prefixo($nome_table)?>
						</h2>
					</div>
					<? if($id != null) { ?>
						<div class="col-md-3 column end">
							<div class="alteracoes">
					<span class="icone">
						<i class="glyphicon glyphicon-floppy-saved"></i>
						Salvo
					</span>
					<span class="icone" style="display: none;">
						<i class="glyphicon glyphicon-floppy-remove"></i>
						Não salvo
					</span>
							</div>
						</div>
					<? } ?>

					<div class="clearfix"></div>
					<form class="formulario crud" action="tabela_acoes.php" method="POST" enctype="multipart/form-data">
						<div class="col-md-12">
							<div class="lista-campos">
								<?
								$sql = "show full columns from $table";
								$result = mysqli_query($GLOBALS["db"],$sql) or die(mysqli_error($GLOBALS["db"]));
								while($col = mysqli_fetch_array($result)) {

									$field = $col["Field"];
									$field_name = $col["Field"];
									$nome = normalizaString($field);

									$editavel = 0;
									$obrigatorio = 0;
									$tamanho = 12;
									$tipo = "text";
									$configuracao = "";
									$sql_config = mysqli_query($GLOBALS["db"], "SELECT * FROM admin_configuracoes WHERE tabela = '".$table."' and campo = '".$col["Field"]."'");
									if(mysqli_num_rows($sql_config) != 0) {
										$config = mysqli_fetch_array($sql_config);

										if($config["editavel"] != "") { $editavel = $config["editavel"]; }
										if($config["obrigatorio"] != "") { $obrigatorio = $config["obrigatorio"]; }
										if($config["tamanho"] != 0) { $tamanho = $config["tamanho"]; }
										if($config["tipo"] != "") { $tipo = $config["tipo"]; }
										if($config["configuracao"] != "") { $configuracao = explode("|",$config["configuracao"]); }
										if($config["label"] != "") { $nome = $config["label"]; }
									}

									if($editavel) {

										if(!$obrigatorio) { $opcional = "opcional"; } else { $opcional = ""; }

										//***** text, telefone, cep, cpf, cnpj, email, dinheiro *****
										if($tipo == "text" || $tipo == "telefone" || $tipo == "cep" || $tipo == "cpf" || $tipo == "cnpj" || $tipo == "email") {
											if($tipo != "text") { $mask = "mask-".$tipo; } else { $mask = ""; }
											?>
											<div class="col-md-<?=$tamanho?> column end">
												<label><span><?=$nome?>:</span>
													<input type="text" class="form-control <?=$mask?>" name="<?=$field_name?>" value="<? if(isset($dados[$field]) and $dados[$field] != "") { echo $dados[$field]; } ?>" <?=$opcional?> />
												</label>
											</div>
											<?
										}

										//***** textarea *****
										if($tipo == "textarea") {
											?>
											<div class="col-md-<?=$tamanho?> column end">
												<label><span><?=$nome?>:</span>
													<textarea class="form-control" name="<?=$field_name?>" <?=$opcional?>><? if(isset($dados[$field]) and $dados[$field] != "") { echo $dados[$field]; } ?></textarea>
												</label>
											</div>
											<?
										}

										//***** tinymce *****
										if($tipo == "tinymce") {
											?>
											<div class="col-md-<?=$tamanho?> column end">
												<label><span><?=$nome?>:</span>
													<textarea class="tinymce" name="<?=$field_name?>" <?=$opcional?>><? if(isset($dados[$field]) and $dados[$field] != "") { echo $dados[$field]; } ?></textarea>
												</label>
											</div>
											<?
										}

										//***** senha *****
										if($tipo == "senha") {
											?>
											<div class="col-md-<?=$tamanho?> column end">
												<label><span><?=$nome?>:</span>
													<input class="form-control" type="password" name="<?=$field_name?>" value="" <? if(isset($dados[$field]) and $dados[$field] != "") { echo "opcional"; } ?> />
												</label>
											</div>

											<div class="col-md-<?=$tamanho?> column end">
												<label><span>Repetir <?=$nome?>:</span>
													<input class="form-control" type="password" name="repetir_<?=$field_name?>" value="" <? if(isset($dados[$field]) and $dados[$field] != "") { echo "opcional"; } ?> />
												</label>
											</div>
											<?
										}

										//***** estado *****
										if($tipo == "estado") {
											?>
											<div class="col-md-<?=$tamanho?> column end">
												<label><span><?=$nome?>:</span>
													<select class="form-control" id="lista-estados" name="<?=$field_name?>" value="<? if(isset($dados[$field]) and $dados[$field] != "") { echo $dados[$field]; } ?>" <?=$opcional?>></select>
												</label>
											</div>
											<?
										}

										//***** cidade *****
										if($tipo == "cidade") {
											?>
											<div class="col-md-<?=$tamanho?> column end">
												<label><span><?=$nome?>:</span>
													<select class="form-control" id="lista-cidades" name="<?=$field_name?>" value="<? if(isset($dados[$field]) and $dados[$field] != "") { echo $dados[$field]; } ?>" <?=$opcional?>></select>
												</label>
											</div>
											<?
										}

										//***** dinheiro *****
										if($tipo == "dinheiro") {
											if($tipo != "text") { $mask = "mask-".$tipo; } else { $mask = ""; }
											?>
											<div class="col-md-<?=$tamanho?> column end">
												<label><span><?=$nome?>:</span>
													<input type="text" class="form-control <?=$mask?>" name="<?=$field_name?>" value="<? if(isset($dados[$field]) and $dados[$field] != "") { echo number_format($dados[$field],2,",","."); } ?>" <?=$opcional?> />
												</label>
											</div>
											<?
										}

										//***** radio *****
										if($tipo == "radio") {
											$opcoes = "";

											if(sizeof($configuracao) == 2) {
												//Busca da tabela
												$tab = $configuracao[0];
												$campo = $configuracao[1];
												$sql = mysqli_query($GLOBALS["db"], "SELECT id,$campo FROM $tab");
												while($o = mysqli_fetch_array($sql)) {
													$chk = "";
													if(isset($dados[$field]) and $o["id"] == $dados[$field]) { $chk = "checked"; }
													$opcoes .= '<label><input type="radio" '.$chk.' value="'.$o["id"].'" name="'.$field.'" '.$opcional.' />'.$o[$campo].'</label>';
												}
											} else {
												//Pega as opções
												$opt = explode("&",$configuracao[0]);
												foreach($opt as $o) {
													$chk = "";
													if(isset($dados[$field]) and $o == $dados[$field]) { $chk = "checked"; }
													$opcoes .= '<label><input type="radio" '.$chk.' value="'.$o.'" name="'.$field.'" '.$opcional.' />'.$o.'</label>';
												}
											}
											?>
											<div class="col-md-<?=$tamanho?> column end">
												<span><strong><?=$nome?>:</strong></span>
												<div class="grupo">
													<?=$opcoes?>
												</div>
											</div>
											<?
										}

										//***** checkbox *****
										if($tipo == "checkbox") {
											$opcoes = "";

											if(sizeof($configuracao) == 2) {
												//Busca da tabela
												$tab = $configuracao[0];
												$campo = $configuracao[1];
												$sql = mysqli_query($GLOBALS["db"], "SELECT id,$campo FROM $tab");
												while($o = mysqli_fetch_array($sql)) {
													$chk = "";
													$field_ex = explode("|",@$dados[$field]);
													if(isset($dados[$field]) and in_array($o["id"],$field_ex)) { $chk = "checked"; }
													$opcoes .= '<label><input type="hidden" value="" name="'.$field.'[]"  /><input type="checkbox" '.$chk.' value="'.$o["id"].'" name="'.$field.'[]" '.$opcional.' />'.$o[$campo].'</label>';
												}
											} else {
												//Pega as opções
												if(isset($configuracao[0])) {
													$opt = explode("&",$configuracao[0]);
													foreach($opt as $o) {
														$chk = "";
														$field_ex = explode("|",$dados[$field]);
														if(isset($dados[$field]) and in_array($o,$field_ex)) { $chk = "checked"; }
														$opcoes .= '<label><input type="hidden" value="" name="'.$field.'[]"  /><input type="checkbox" '.$chk.' value="'.$o.'" name="'.$field.'[]" '.$opcional.' />'.$o.'</label>';
													}
												}
											}
											?>
											<div class="col-md-<?=$tamanho?> column end">
												<span></strong><?=$nome?>:</strong></span>
												<div class="grupo">
													<?=$opcoes?>
												</div>
											</div>
											<?
										}

										//***** select *****
										if($tipo == "select") {
											$opcoes = "<option value=''>(Escolha)</option>";
											if(sizeof($configuracao) == 2) {
												//Busca da tabela
												$tab = $configuracao[0];
												$campo = $configuracao[1];
												$sql = mysqli_query($GLOBALS["db"], "SELECT id,$campo FROM $tab");
												while($o = mysqli_fetch_array($sql)) {
													$chk = "";
													if(isset($dados[$field]) and $o["id"] == $dados[$field]) { $chk = "selected"; }
													$opcoes .= '<option '.$chk.' value="'.$o["id"].'" />'.$o[$campo].'</option>';
												}
											} else {
												//Pega as opções
												$opt = explode("&",$configuracao[0]);
												foreach($opt as $o) {
													$chk = "";
													if(isset($dados[$field]) and $o == $dados[$field]) { $chk = "selected"; }
													$opcoes .= '<option '.$chk.' value="'.$o.'" />'.$o.'</option>';
												}
											}
											?>
											<div class="col-md-<?=$tamanho?> column end">
												<label>
													<span><?=$nome?>:</span>
													<select class="form-control" name="<?=$field_name?>" <?=$opcional?>>
														<?=$opcoes?>
													</select>
												</label>
											</div>
											<?
										}

										//***** tabelas_banco *****
										if($tipo == "tabelas_banco") {
											$opcoes = "<option value=''>(Escolha)</option>";
											global $dbname;
											$sql = mysqli_query($GLOBALS["db"], "select table_name from information_schema.tables where table_schema = '$dbname'") or die(mysqli_error($GLOBALS["db"]));
											while($o = mysqli_fetch_array($sql)) {
												$chk = "";
												if(isset($dados[$field]) and $o["table_name"] == $dados[$field]) { $chk = "selected"; }
												$opcoes .= '<option '.$chk.' value="'.$o["table_name"].'" />'.$o["table_name"].'</option>';
											}
											?>
											<div class="col-md-<?=$tamanho?> column end">
												<label>
													<span><?=$nome?>:</span>
													<select class="form-control" name="<?=$field_name?>" <?=$opcional?>>
														<?=$opcoes?>
													</select>
												</label>
											</div>
											<?
										}

										//***** imagem *****
										if($tipo == "imagem") {
											?>
											<div class="col-md-<?=$tamanho?> column end">
												<label>
													<span><?=$nome?>:</span>
													<input type="file" ext="<?=$configuracao[2]?>" name="<?=$field_name?>" <?=$opcional?> />

												</label>
												<? if(isset($dados[$field]) and $dados[$field] != "" and file_exists("uploads/".$dados[$field])) { ?>
													<?
													if(isset($configuracao[0])) { $largura = $configuracao[0]; } else { $largura = 0; }
													if(isset($configuracao[1])) { $altura = $configuracao[1]; } else { $altura = 0; }
													?>
													<div class="col-md-12 column">
														<div class="dados_imagem">
															<h5>Arquivo atual:</h5>
															<?
															if(is_image("uploads/".$dados[$field])) {
															?>
															<a href="uploads/<?=$dados[$field]?>" class="fancybox">
																<div id="img_<?=$table?>_<?=$field?>_<?=$dados["id"]?>" class="imagem_cadastrada" style="background-image: url('uploads/<?=$dados[$field]?><?="?".time();?>')"></div>

																<a href="uploads/<?=$dados[$field]?>" class="fancybox"><?= $dados[$field] ?></a><br />
																<a onclick="informa_modal_crop('<?=$dados[$field]?>','img_<?=$table?>_<?=$field?>_<?=$dados["id"]?>','<?=$largura?>','<?=$altura?>')" data-toggle="modal" data-target="#crop-imagem" data-backdrop="static" class="btn btn-success icone"><i class="glyphicon glyphicon-scissors"></i> Recortar imagem</a>
																&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
																<? } else { ?>
																	<a target="_blank" href="uploads/<?=$dados[$field]?>">
																		<i class="zmdi zmdi-file big-icon"></i>
																		<div class="clearfix"></div>
																	</a>
																<? } ?>

																<a onclick="removeImagem($(this),'<?=$table?>',<?= $dados["id"] ?>, '<?= $field ?>')" class="btn btn-danger icone"><i class="glyphicon glyphicon-remove"></i> Remover arquivo</a>

														</div>
													</div>
												<? } ?>

											</div>
											<?
										}

										//***** arquivo *****
										if($tipo == "arquivo") {
											?>
											<div class="col-md-<?=$tamanho?> column end">
												<label>
													<span><?=$nome?>:</span>
													<input type="file" name="<?=$field_name?>" <?=$opcional?> />
												</label>
											</div>
											<?
										}

										//***** data *****
										if($tipo == "data") {
											?>
											<div class="col-md-<?=$tamanho?> column end">
												<label>
													<span><?=$nome?>:</span>
													<input class="form-control mask-data" type="text" value="<? if(isset($dados[$field]) and $dados[$field] != "") { echo formata_data_site($dados[$field]); } ?>" name="<?=$field_name?>" <?=$opcional?> />
												</label>
											</div>
											<?
										}

										//***** datahora *****
										if($tipo == "datahora") {
											?>
											<div class="col-md-<?=$tamanho?> column end">
												<label>
													<span><?=$nome?>:</span>
													<input class="form-control mask-datahora" type="text" value="<? if(isset($dados[$field]) and $dados[$field] != "") { echo formata_data_hora_site($dados[$field]); } ?>" name="<?=$field_name?>" <?=$opcional?> />
												</label>
											</div>
											<?
										}

										//***** numero *****
										if($tipo == "numero") {
											?>
											<div class="col-md-<?=$tamanho?> column end">
												<label>
													<span><?=$nome?>:</span>
													<input class="form-control" type="number" value="<? if(isset($dados[$field]) and $dados[$field] != "") { echo $dados[$field]; } ?>" name="<?=$field_name?>" <?=$opcional?> />
												</label>
											</div>
											<?
										}

										//***** cor *****
										if($tipo == "cor") {
											?>
											<div class="col-md-<?=$tamanho?> column end">
												<label>
													<span><?=$nome?>:</span>
													<input type="text" class="colorpicker" value="<? if(isset($dados[$field]) and $dados[$field] != "") { echo $dados[$field]; } ?>" name="<?=$field_name?>" <?=$opcional?> />
												</label>
											</div>
											<?
										}

										//***** localizacao *****
										if($tipo == "localizacao") {
											?>
											<div class="col-md-<?=$tamanho?> column end">
												<label>
													<span><?=$nome?>:</span>
													<input type="text" placeholder="Digite um local e clique em Encontrar no mapa" class="form-control" id="geocomplete" value="<? if(isset($dados[$field]) and $dados[$field] != "") { echo $dados[$field]; } ?>" name="<?=$field_name?>" <?=$opcional?> />
													<input id="find" type="button" class="btn-primary" value="Encontrar no mapa">
													<input type="text" val="<?=$dados["coordenadas"]?>" data-geo="location" name="coordenadas" style="display: none;" />
													<div class="map_canvas"></div>
												</label>
											</div>
											<style>

												.map_canvas {
													width: 100%;
													height: 250px;
													margin: 0px 20px 10px 0;
												}

												#multiple li {
													cursor: pointer;
													text-decoration: underline;
												}
											</style>
											<?
										}

										//***** galeria *****
										if($tipo == "galeria") {
											?>
											<div class="col-md-<?=$tamanho?> column end">
												<label>
													<span><?=$nome?>:</span>
													<input type="file" ext="<?=$configuracao[2]?>" name="<?=$field_name?>[]" <?=$opcional?> multiple />
												</label>

												<?
												//Seleciona da galeria
												if(isset($_GET["id"]) and $_GET["id"] != "") {
													$sql_gal = mysqli_query($GLOBALS["db"],"SELECT * FROM admin_galerias WHERE tabela='$table' and campo = '$field_name' and id_externo = '$id' ORDER BY ordem,id ASC");

													if(isset($configuracao[0])) { $largura = $configuracao[0]; } else { $largura = 0; }
													if(isset($configuracao[1])) { $altura = $configuracao[1]; } else { $altura = 0; }

													if(mysqli_num_rows($sql_gal) != "") { ?>
														<ul class="galeria" tabela="<?=$table?>" campo="<?=$field_name?>">
															<?
															while($dados_gal = mysqli_fetch_array($sql_gal)) {
																?>
																<? if(isset($dados_gal["caminho"]) and $dados_gal["caminho"] != "" and file_exists("uploads/".$dados_gal["caminho"])) { ?>

																	<li class="item" foto-id="<?=$dados_gal["id"]?>">
																		<?
																		if(is_image("uploads/".$dados_gal["caminho"])) {
																			?>
																			<a href="uploads/g_<?=$dados_gal["caminho"]?>" class="fancybox" rel="group_<?=$field_name?>">
																				<div id="img_<?=$table?>_<?=$field_name?>_<?=$dados_gal["id"]?>" class="imagem_cadastrada" style="background-image: url('uploads/<?=$dados_gal["caminho"]?><?="?".time();?>')"></div>
																			</a>

																			<a onclick="informa_modal_crop('<?=$dados_gal["caminho"]?>','img_<?=$table?>_<?=$field_name?>_<?=$dados_gal["id"]?>','<?=$largura?>','<?=$altura?>')" data-toggle="modal" data-target="#crop-imagem" data-backdrop="static" class="btn btn-xs btn-success"><i class="glyphicon glyphicon-scissors"></i></a>

																		<? } else { ?>
																			<a target="_blank" href="uploads/<?=$dados_gal["caminho"]?>">
																				<i class="zmdi zmdi-file big-icon"></i>
																				<div class="clearfix"></div>
																			</a>
																		<? } ?>

																		<a onclick="editaDadosImg('<?=$dados_gal["id"]?>',$(this))" data-toggle="modal" data-target="#galeria-edit" data-backdrop="static" class="btn btn-xs btn-warning"><i class="glyphicon glyphicon-pencil"></i></a>

																		<a onclick="removeImagemGaleria($(this),'<?=$table?>',<?= $dados_gal["id"] ?>, '<?=$dados_gal["caminho"]?>')" class="btn btn-xs btn-danger"><i class="glyphicon glyphicon-remove"></i></a>

																		<div class="galeria-descricao sumir"><?=$dados_gal["legenda"]?></div>
																		<div class="galeria-link sumir"><?=$dados_gal["link"]?></div>
																		<div class="clearfix"></div>
																	</li>
																<? } ?>
															<? } ?>
															<div class="clearfix"></div>
														</ul>
													<? } ?>
												<? } ?>
											</div>
											<?
										}
									}

								}


								?>
								<div class="clearfix"></div>
							</div>
						</div>

						<div class="col-md-12 column">
							<button class="btn btn-success icone" type="submit"><i class="glyphicon glyphicon-floppy-disk"></i> SALVAR</button>
							<br /><br />
							<div class="clearfix"></div>
						</div>

						<? if(isset($_GET["id_externo"]) and $_GET["id_externo"] != "") { ?><input type="hidden" name="id_externo" value="<?=$_GET["id_externo"]?>" /><? } ?>
						<? if(isset($_GET["table_externo"]) and $_GET["table_externo"] != "") { ?><input type="hidden" name="table_externo" value="<?=$_GET["table_externo"]?>" /><? } ?>
						<input type="hidden" name="table" value="<?=$table?>" />
						<input type="hidden" name="acao" value="registrar" />
						<input type="hidden" name="url_retorno" value="<?=$_SERVER["HTTP_REFERER"]?>" />

						<? if(isset($id)) { ?>
							<input type="hidden" name="id" value="<?=$id?>" />
						<? } ?>
						<div class="clearfix"></div>
					</form>
					<?
				}
			}

			?>

			<div class="clearfix"></div>
		</div><!-- FIM CAMPOS -->


	</div><!-- FIM ABA -->
	<?

	//Verifica se tabelas externas referenciam
	if(!$editavel_externo) {
		global $dbname;
		$externo_sql = mysqli_query($GLOBALS["db"], "select table_name from information_schema.columns where table_schema = '$dbname' and column_name = 'id_".$table."'") or die(mysqli_error($GLOBALS["db"]));
		if(mysqli_num_rows($externo_sql) != 0) {
			while($externo = mysqli_fetch_array($externo_sql)) {
				crud_tabela($externo["table_name"],$id,$table);
			}
		}
	}


}

//É o primeiro campo que não tem nada de id
function pega_campo_principal($table,$id) {
	$campo_principal = "";
	$sql = "show full columns from $table";
	$result = mysqli_query($GLOBALS["db"],$sql) or die(mysqli_error($GLOBALS["db"]));
	while($col = mysqli_fetch_array($result)) {
		if(strpos($col["Field"],"id") === false and $col["Field"] != "admin_ordem") {
			$tipo = "";
			$getconfig = mysqli_query($GLOBALS["db"],"SELECT tipo FROM admin_configuracoes WHERE tabela = '$table' and campo = '".$col["Field"]."'");
			if(mysqli_num_rows($getconfig) > 0) {
				$tipo = mysqli_result($getconfig,0,"tipo");
			}

			if($tipo != "imagem") {
				$campo_principal = $col["Field"];
				break;
			}
		}
	}

	//echo $campo_principal; die();

	if($campo_principal  != "") {
		$sql = mysqli_query($GLOBALS["db"], "SELECT $campo_principal FROM $table WHERE id = '$id'");
		if(mysqli_num_rows($sql) != 0) {
			return mysqli_result($sql,0,$campo_principal);
		} else {
			return false;
		}
	} else {
		return false;
	}
}

function campo_principal($table) {
	$campo_principal = "";
	$sql = "show full columns from $table";
	$result = mysqli_query($GLOBALS["db"],$sql) or die(mysqli_error($GLOBALS["db"]));
	while($col = mysqli_fetch_array($result)) {
		if(strpos($col["Field"],"id") === false and $col["Field"] != "admin_ordem" and $col["Field"] != "url") {
			$tipo = "";
			$getconfig = mysqli_query($GLOBALS["db"],"SELECT tipo FROM admin_configuracoes WHERE tabela = '$table' and campo = '".$col["Field"]."'") or die(mysqli_error($_GLOBALS['db']));
			if(mysqli_num_rows($getconfig) > 0) {
				$tipo = mysqli_result($getconfig,0,"tipo");
			}
			if($tipo != "imagem") {
				$campo_principal = $col["Field"]; break;
			}
		}
	}
	//echo $campo_principal; die();
	return $campo_principal;
}

function verifica_se_coluna_existe($table,$coluna) {
	$sql = "show full columns from $table";
	$result = mysqli_query($GLOBALS["db"],$sql) or die(mysqli_error($GLOBALS["db"]));
	while($col = mysqli_fetch_array($result)) {
		if($col["Field"] == $coluna) {
			return true;
		}
	}
	return false;
}

function tem_permissao($table,$permissao) {
	$tipo = $_SESSION["tipo_usuario"];
	$sql = mysqli_query($GLOBALS["db"], "SELECT * FROM admin_usuarios_permissoes WHERE id_admin_usuarios_tipos = '$tipo' and tabela = '$table' and $permissao != ''");
	if(mysqli_num_rows($sql) == 0) {
		return true;
	} else {
		return false;
	}
}

?>