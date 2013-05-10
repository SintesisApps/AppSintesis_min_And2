<?php
/*slide  vertical*/
include("../../includes/conexion.php");
include('../../funciones.php'); 


$html="";
$select_app="SELECT * FROM app_articulos WHERE posicion='Slide-Vertical' AND estatus='1' ORDER BY id DESC LIMIT 0,3 ";
$r_app=mysql_query($select_app,$conexion);
while($f_app=mysql_fetch_assoc($r_app)):
	$id_nota_app=$f_app['id'];
	$id_articulo_app=$f_app['id_articulo'];
	$plaza_app=$f_app['plaza'];


	$select_ar="SELECT titulo,sumario,id_seccion,autor,fecha_creacion,nota FROM articulos_".$plaza_app." WHERE id=".$id_articulo_app."";

	$r_ar=mysql_query($select_ar,$conexion);
	while($f_ar=mysql_fetch_assoc($r_ar)):
		$TituloSlideVertical=$f_ar['titulo'];
		$SumarioSlideVertical=$f_ar['sumario'];
		$Id_SeccionSlideVertical=$f_ar['id_seccion'];
		$AutorSlideVertical=$f_ar['autor'];
		$NotaSlideVertical=$f_ar['nota'];
		$Fecha_CreacionSlideVertical=$f_ar['fecha_creacion'];

		$TituloSlideVertical=utf8_encode($TituloSlideVertical);
		$SumarioSlideVertical=utf8_encode($SumarioSlideVertical);
		$AutorSlideVertical=utf8_encode($AutorSlideVertical);
		$NotaSlideVertical=utf8_encode($NotaSlideVertical);

		$TituloSlideVertical=substr($TituloSlideVertical,0,30)."...";
		$SumarioSlideVertical=substr($SumarioSlideVertical,0,100)."...";
		$imagen=extraer_imagen($NotaSlideVertical);
		$imagen=utf8_decode($imagen);
	endwhile;

	$select_se="SELECT seudonimo FROM secciones WHERE id='".$Id_SeccionSlideVertical."'";

	$r_se=mysql_query($select_se,$conexion);
	while($f_se=mysql_fetch_assoc($r_se)):
		$SeccionSlideVertical=$f_se['seudonimo'];
		$SeccionSlideVertical=strtolower(utf8_encode($SeccionSlideVertical));

	endwhile;
	
				$html.='<div><a href="#nota" onclick="LeerNota('.$id_nota_app.')">
					<div class="SlideVerticalArticulo">
						<div class="SlideVerticalSeccion"><img src="imagenes/iconos/secciones/'.$SeccionSlideVertical.'.png"></div>
						<div class="SlideVerticalImagen"><img src="'.$url_dominio_.'/images/imagenes-articulos/'.$imagen.'" > </div>
						<div class="SlideVerticalContenido">
						  <div class="SlideVerticalTitulo">'.$TituloSlideVertical.'</div>
						  <div class="SlideVerticalAutor">'.$AutorSlideVertical.'</div>
						  <div class="SlideVerticalFecha">'.$Fecha_CreacionSlideVertical.'</div>
						 
						</div>
					</div>
				</a></div>
				<div > 
            <div class="PublicidadSlideVertical">
                <img src="imagenes/publicidad/3.jpg">
            </div>
        </div>';
				// <div class="SlideVerticalSumario">'.$SumarioSlideVertical.'</div>
		endwhile;
		echo $html;

?>