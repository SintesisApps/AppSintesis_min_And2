<?php
$plaza=$_POST['plaza'];

if($plaza=="Nacional"):
	$titulo="Nacional";
	$path="../../portadas/SECCION B/";
	$RutaImagen="../ImpresoPortadas/Nacional/";
	$ImagenesPortadas= CrearImagendeImpresoAPP($path,$RutaImagen);
elseif($plaza=="Puebla"):
	$titulo="Puebla";
	$path="../../portadas/SECCIÓN A/PUEBLA/";
	$RutaImagen="../ImpresoPortadas/Puebla/";
	$ImagenesPortadas= CrearImagendeImpresoAPP($path,$RutaImagen);
elseif($plaza=="Tlaxcala"):
	$titulo="Tlaxcala";
	$path="../../portadas/SECCIÓN A/TLAXCALA/";
	$RutaImagen="../ImpresoPortadas/Tlaxcala/";
	$ImagenesPortadas= CrearImagendeImpresoAPP($path,$RutaImagen);
elseif($plaza=="Hidalgo"):
	$titulo="Hidalgo";
	$path="../../portadas/SECCIÓN A/HIDALGO/";
	$RutaImagen="../ImpresoPortadas/Hidalgo/";
	$ImagenesPortadas= CrearImagendeImpresoAPP($path,$RutaImagen);
elseif($plaza=="Oaxaca"):
	$titulo="Oaxaca";
	$path="../../portadas/SEMANARIOS/OAXACA/";
	$RutaImagen="../ImpresoPortadas/Oaxaca/";
	$ImagenesPortadas= CrearImagendeSemanariosAPP($path,$RutaImagen);
elseif($plaza=="Chiapas"):
	$titulo="Chiapas";
	$path="../../portadas/SEMANARIOS/Tuxtla/";
	$RutaImagen="../ImpresoPortadas/Chiapas/";
	$ImagenesPortadas= CrearImagendeSemanariosAPP($path,$RutaImagen);
elseif($plaza=="Yucatan"):
	$titulo="Yucatán";
	$path="../../portadas/SEMANARIOS/Yucatan/";
	$RutaImagen="../ImpresoPortadas/Yucatan/";
	$ImagenesPortadas= CrearImagendeSemanariosAPP($path,$RutaImagen);
	
	
elseif($plaza=="arte_cultura"):
	$titulo="Catedral, Arte y Cultura";
elseif($plaza=="velocidad"):
	$titulo="Velocidad";
elseif($plaza=="recorridos"):
	$titulo="Recorridos";
elseif($plaza=="NYT"):
	$titulo="New York Times";
endif;

function CrearImagendeImpresoAPP($path,$RutaImagen){

//Eliminar Imagenes pasadas
$directorio=dir($RutaImagen);
while ($archivo = $directorio->read()):
	if($archivo!="." OR $archivo!=".."):
		if (strtolower(substr($archivo, -3) == "jpg") && substr($archivo,0,8)!=date("dmY") && file_exists($RutaImagen.$archivo)):
			unlink($RutaImagen.$archivo);
		endif;
	endif;

endwhile;
$directorio->close();
//Eliminar Imagenes pasadas

$directorio=dir($path);

while ($archivo = $directorio->read()):
 set_time_limit(0);
	if($archivo!="." OR $archivo!=".." ):
	
		if (strtolower(substr($archivo, -3) == "pdf")):
			$archivofecha=substr($archivo,0,8);
			
			if($archivofecha==date("dmY")):
				
					$pdf=$archivo;
					
					  $file_extension = explode(".", $pdf[0]);
					  $file_extension = array_pop($file_extension);
					  $archivo=str_replace(".pdf","",$archivo);
					  
					   if(!file_exists($RutaImagen.$archivo.".jpg")):
							  $img = new imagick($path.$pdf."[0]");
							  $img->setCompression(Imagick::COMPRESSION_JPEG);
							  $img->setCompressionQuality(100);
							  $img->setImageFormat("jpg");
							  $img->thumbnailImage(1024, 0);
							  
							  $img->writeImages($RutaImagen.$archivo.".jpg", true);
						endif;
						
						$html.="&".$archivo;
					
			endif;
		endif;
	endif;
endwhile;
$directorio->close();

return $html;
}

function CrearImagendeSemanariosAPP($path,$RutaImagen){


$directorio=dir($path);
				
while ($archivo = $directorio->read()):
	if($archivo!="." OR $archivo!=".."):
		if (strtolower(substr($archivo, -3) == "pdf")):
			$archivodia=substr($archivo,0,2);
			$archivomes=substr($archivo,2,2);
			$archivoanio=substr($archivo,4,4);
			$ArchivoDia[]=$archivodia;
			$ArchivoMes[]=$archivomes;
			$ArchivoAnio[]=$archivoanio;
			 
			sort($ArchivoDia);
			sort($ArchivoMes);
			sort($ArchivoAnio);
			
			foreach ($ArchivoAnio as $key => $val) {
			}
			foreach ($ArchivoMes as $keyMes => $valMes) {
			}
			foreach ($ArchivoDia as $keyDia => $valDia) {
				
			}
			$UltimaPortada= "$valDia$valMes$val";
		endif;
	endif;
endwhile;

//Eliminar Imagenes pasadas
$directorio=dir($RutaImagen);
while ($archivo = $directorio->read()):
	if($archivo!="." OR $archivo!=".."):
		if (strtolower(substr($archivo, -3) == "jpg") && substr($archivo,0,8)!=$UltimaPortada && file_exists($RutaImagen.$archivo)):
			unlink($RutaImagen.$archivo);
		endif;
	endif;

endwhile;
$directorio->close();
//Eliminar Imagenes pasadas

$directorio=dir($path);
while ($archivo = $directorio->read()):
set_time_limit(0);
	if($archivo!="." OR $archivo!=".."):
	
		if (strtolower(substr($archivo, -3) == "pdf")):
			$archivofecha=substr($archivo,0,8);
			$NombreImagen=strtolower(substr($archivo, -6,2));
			if($archivofecha==$UltimaPortada):
				
					$pdf=$archivo;
					
					  $file_extension = explode(".", $pdf[0]);
					  $file_extension = array_pop($file_extension);
					  $archivo=str_replace(".pdf","",$archivo);
					   if(!file_exists($RutaImagen.$archivo.".jpg")):
					   
							  
							  $img = new imagick($path.$pdf."[0]");
							  $img->setCompression(Imagick::COMPRESSION_JPEG);
							  $img->setCompressionQuality(100);
							  $img->setImageFormat("jpg");
							  $img->thumbnailImage(1024, 0);
							  $img->writeImages($RutaImagen.$archivo.".jpg", true);
						endif;
						
						$html.="&".$archivo;
				
					
			endif;
		endif;
	endif;
endwhile;


$directorio->close();

return $html;
}


$ImagenesPortadas= explode("&",$ImagenesPortadas);
for($i=0;$i<count($ImagenesPortadas);$i++):
	if($ImagenesPortadas[$i]!=""):
		 $fechaImagen=substr($ImagenesPortadas[$i],0,8);
		 $EstadoImagen=substr($ImagenesPortadas[$i],8,-2);
		 $PosicionImagen=sprintf("%02d", $i);
		 $ArchivoFinal=$fechaImagen.$EstadoImagen.$PosicionImagen;
		 
		 if($PosicionImagen=="01"):
		 	$PortadaImagen=$fechaImagen.$EstadoImagen.$PosicionImagen;
		 endif;
	endif;
endfor;

$html='<div class="PlazaImpreso">
        '.$titulo.'
        </div>
		<div id="ImagenPortadaImp">
			<img src="http://166.78.193.53/APPSintesis/ImpresoPortadas/'.$plaza.'/'.$PortadaImagen.".jpg".'" width="100%"/>
		</div>
       <div class="FlechaArriba">
        <a href="javascript:;" onClick="';
		
$html.="$('.ContenedorImagen').css('bottom','30px');";
$html.='">
            <img src="imagenes/flechaazul.png">
         </a>
        </div>
       <div class="ContenedorImagen">
   		 	<div class="Flecha">
            <a href="javascript:;" onClick="';
$html.="$('.ContenedorImagen').css('bottom','-250%');";
$html.='">
         		<img src="imagenes/flechaazul.png">
             </a>
         	</div>
         
             <div  class="MasImpreso" >
                <div  class="SubContenedorMasImpreso">';
				
				for($i=0;$i<count($ImagenesPortadas);$i++):
	if($ImagenesPortadas[$i]!=""):
		 $fechaImagen=substr($ImagenesPortadas[$i],0,8);
		 $EstadoImagen=substr($ImagenesPortadas[$i],8,-2);
		 $PosicionImagen=sprintf("%02d", $i);
		 $ArchivoFinal=$fechaImagen.$EstadoImagen.$PosicionImagen;
		 
		 $ImgPort='<img src="http://166.78.193.53/APPSintesis/ImpresoPortadas/$plaza/$ArchivoFinal.jpg" width="100%">';
		 $html.='<div class="ImagenMasImpreso">
		 
		 <a href="';
		 $html.="javascript:CambiarPortada('".$plaza."','".$ArchivoFinal."');";
		 $html.='" onClick="">
		 <img src="http://166.78.193.53/APPSintesis/ImpresoPortadas/'.$plaza.'/'.$ArchivoFinal.".jpg".'">
		 </a>
		 </div>';
	endif;


endfor;
$html.='</div>
             </div>
             
   		</div>';

echo $html;
?>