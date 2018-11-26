<?php
include "../../../restrito.php";

if (!empty($_FILES)) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath = $_SERVER['DOCUMENT_ROOT'] . $_GET['folder'] . '/';
	
	
	$nome = $_FILES['Filedata']['name'];
				$nome=(str_replace(' ','_',$nome)); 
				$nome=(str_replace('-','_',$nome)); 
				$nome=(str_replace('ç','c',$nome)); 
				$nome=(str_replace('á','a',$nome));
				$nome=(str_replace('à','a',$nome)); 
				$nome=(str_replace('é','e',$nome)); 
				$nome=(str_replace('í','i',$nome)); 
				$nome=(str_replace('ó','o',$nome)); 
				$nome=(str_replace('ú','u',$nome)); 
				$nome=(str_replace('ã','a',$nome)); 
				$nome=(str_replace('õ','o',$nome)); 
				$nome=(str_replace('â','a',$nome)); 
				$nome=(str_replace('ê','e',$nome)); 
				$nome=(str_replace('ô','o',$nome)); 
				
				$nome=(str_replace('Ç','C',$nome)); 
				$nome=(str_replace('Á','A',$nome));
				$nome=(str_replace('À','A',$nome)); 
				$nome=(str_replace('É','E',$nome)); 
				$nome=(str_replace('Í','I',$nome)); 
				$nome=(str_replace('Ó','O',$nome)); 
				$nome=(str_replace('Ú','U',$nome)); 
				$nome=(str_replace('Ã','A',$nome)); 
				$nome=(str_replace('Õ','O',$nome)); 
				$nome=(str_replace('Â','A',$nome)); 
				$nome=(str_replace('Ê','E',$nome)); 
				$nome=(str_replace('Ô','O',$nome)); 
				
				$nome=(str_replace('?','_',$nome)); 
				$nome=(str_replace('!','_',$nome)); 
				$nome=(str_replace('(','_',$nome)); 
				$nome=(str_replace(')','_',$nome)); 
				$nome=(str_replace('%','_',$nome)); 
				$nome=(str_replace('#','_',$nome)); 
				$nome=(str_replace('@','_',$nome)); 
				$nome=(str_replace('&','_',$nome)); 
				$nome=(str_replace('+','_',$nome));
				$nome=(str_replace('=','_',$nome));
				$nome=(str_replace('§','_',$nome));
				$nome=(str_replace('ª','_',$nome));
				$nome=(str_replace('º','_',$nome));
				$nome=(str_replace('*','_',$nome));
				$nome=(str_replace(':','_',$nome));
				$nome=(str_replace(',','_',$nome));
				$nome=(str_replace(';','_',$nome));
				$nome=(str_replace('|','_',$nome));
				$nome = strtolower($nome);
		
	// Uncomment the following line if you want to make the directory if it doesn't exist
	// mkdir(str_replace('//','/',$targetPath), 0755, true);
	
	$newFileName = date("Hisdmy").'_'.(($_GET['location'] != '')?$_GET['location'].'_':'').$nome;
	$targetFile =  str_replace('//','/',$targetPath).$newFileName;


	$imagemx = $targetFile;
	
	move_uploaded_file($tempFile,$targetFile);

							// DEFINIR O NOME DO ARQUIVO PARA O THUMBNAIL	
										$thumbnail = explode('.', $imagemx);
										$thumbnail = $thumbnail[0]."_thumbnail.jpg";
									
										copy($tempFile,$thumbnail);	
									
									// DEFINIR AS DIMENSÕES PARA O THUMBNAIL
									   $x = 130; // Largura
									   $y = 98; // Altura
				
									// LÊ A imagemx DE ORIGEM
										$img_origem = imagecreatefromjpeg($imagemx);
									
									// PEGA AS DIMENSÕES DA imagemx DE ORIGEM
										$origem_x = imagesx($img_origem); // Largura
										$origem_y = imagesy($img_origem); // Altura
									
									// ESCOLHE A LARGURA MAIOR E, BASEADO NELA, GERA A LARGURA MENOR
										if($origem_x > $origem_y) { // Se a largura for maior que a altura
										   $final_x = $x; // A largura será a do thumbnail
										   $final_y = floor($x * $origem_y / $origem_x); // A altura é calculada
										   $f_x = 0; // Colar no x = 0
										   $f_y = round(($y / 2) - ($final_y / 2)); // Centralizar a imagemx no meio y do thumbnail
										} else { // Se a altura for maior ou igual à largura
										   $final_x = floor($y * $origem_x / $origem_y); // Calcula a largura
										   $final_y = $y; // A altura será a do thumbnail
										   $f_x = round(($x / 2) - ($final_x / 2)); // Centraliza a imagemx no meio x do thumbnail
										   $f_y = 0; // Colar no y = 0
										}
									
									// CRIA A imagemx FINAL PARA O THUMBNAIL
									   $img_final = imagecreatetruecolor($x,$y); 
									   imagefill($img_final, 0, 0, 0xFFFFFF); 
									
									// COPIA A imagemx ORIGINAL PARA DENTRO DO THUMBNAIL
										imagecopyresampled ($img_final, $img_origem, $f_x, $f_y, 0, 0, $final_x, $final_y, $origem_x, $origem_y);
									
									// SALVA O THUMBNAIL
										imagejpeg($img_final, $thumbnail);
									
									
									// LIBERA A MEMÓRIA
										imagedestroy($img_origem);
										imagedestroy($img_final);

		$sql="
		INSERT INTO lancamentos_imagens
		(id_imagens,imagem,legenda,qual)
		VALUES
		(NULL,'$newFileName',' ','$_GET[id]')";

	$sql=mysql_query($sql);
}

if ($newFileName)
	echo $newFileName;
else // Required to trigger onComplete function on Mac OSX
	echo '1';

?>


