<?php
/*Notas de las secciones, tabla Nacionales*/
include("../../includes/conexion.php");
include('../../funciones.php'); 

$seccion=$_POST["seccion"];

/*slide principal*/
$slide_principal='<div style="float:left;margin-right:-30000px;">
        				<div class="SubContenedorPrincipalSeccion">';
$arr_seccion = array();
$i="0";

$select_app="SELECT * FROM app_articulos WHERE plaza='nacionales' AND estatus='1' and posicion='Slide-Principal' ORDER BY id DESC  ";

	$r_app=mysql_query($select_app,$conexion);
	while($f_app=mysql_fetch_assoc($r_app)):
		$id_nota_app=$f_app['id'];
		$id_articulo_app=$f_app['id_articulo'];
		$plaza_app=$f_app['plaza'];
	
	/*ID de la seccion*/
	$query_sec="select * from secciones WHERE seudonimo='".$seccion."' and estatus='1' ";
	$res_sec=mysql_query($query_sec, $conexion);
	while($reg=mysql_fetch_array($res_sec))
	{
		$id_seccion=$reg['id'];
	}

	$select_ar="SELECT titulo,sumario,id_seccion,autor,fecha_creacion,nota FROM articulos_nacionales WHERE id='".$id_articulo_app."' and id_seccion='".$id_seccion."' ";
	$r_ar=mysql_query($select_ar,$conexion);
	$num_select=mysql_num_rows($select_ar);
	
	if($num_select ==1)//si el artuculo  correspnce a al seccion seleccionada
	{//imprimimos datos
			while($f_ar=mysql_fetch_assoc($r_ar)):
		$TituloPlaza=$f_ar['titulo'];
		$SumarioPlaza=$f_ar['sumario'];
		$Id_SeccionPlaza=$f_ar['id_seccion'];
		$AutorPlaza=$f_ar['autor'];
		$NotaPlaza=$f_ar['nota'];
		$Fecha_CreacionPlaza=$f_ar['fecha_creacion'];
		
		$TituloPlaza=utf8_encode($TituloPlaza);
		$SumarioPlaza=utf8_encode($SumarioPlaza);
		$AutorPlaza=utf8_encode($AutorPlaza);
		$NotaPlaza=utf8_encode($NotaPlaza);
		
		$imagenPlaza=extraer_imagen($NotaPlaza);
		$imagenPlaza=utf8_decode($imagenPlaza);
		
		$select_pza="SELECT plaza FROM plazas WHERE seudonimo='".$plaza_app."'";
	$r_pza=mysql_query($select_pza,$conexion);
	while($f_pza=mysql_fetch_assoc($r_pza)):
		$PlazaNota=$f_pza['plaza'];
		$PlazaNota=utf8_encode($PlazaNota);
	endwhile;
	
	$select_se="SELECT seccion FROM secciones WHERE id='".$Id_Seccion."'";
	$r_se=mysql_query($select_se,$conexion);
	while($f_se=mysql_fetch_assoc($r_se)):
		$SeccionPlaza=$f_se['seccion'];
		$SeccionPlaza=utf8_encode($SeccionPlaza);
	endwhile;
	
		
		$seccion_slidePrincipal.='
		<a href="#nota" onclick="LeerNota('.$id_nota_app.')">
              <div class="ContenidoPrincipalSeccion">
                <div class="ImagenPrincipalSeccion"><img src="'.$url_dominio_.'/images/imagenes-articulos/'.$imagenPlaza.'" ></div>
                <div class="TextoPrincipalSeccion">
                  <div class="TituloPrincipalSeccion">'.$TituloPlaza.'</div>
                  <div class="SeccionPrincipalSeccion">'.$SeccionPlaza.'</div>
                  <div class="AutorPrincipalSeccion"> '.$AutorPlaza.' </div>
                  <div class="FechaPrincipalSeccion">'.$Fecha_CreacionPlaza.'</div>
                </div>
              </div>
              </a>
			  
			  <div class="ContenidoPrincipalSeccion">
                <div class="PublicidadPrincipalSeccion"> <img src="imagenes/publicidad/5.jpg" > </div>
              </div>
		';
		
	endwhile;		
	}
	
endwhile;
$seccion_slidePrincipal.= "</div></div>";

/*SLIDE VERTICAL*/
$slide_vertical='<div  class="ContenedorSlideVertical" >';

$select_app="SELECT * FROM app_articulos WHERE plaza='nacionales' AND estatus='1' and posicion='Slide-Vertical' ORDER BY id DESC	 ";
$r_app=mysql_query($select_app,$conexion);
while($f_app=mysql_fetch_assoc($r_app)):
	$id_nota_app=$f_app['id'];
	$id_articulo_app=$f_app['id_articulo'];
	$plaza_app=$f_app['plaza'];
	

	$select_ar="SELECT titulo,sumario,id_seccion,autor,fecha_creacion,nota FROM articulos_nacionales WHERE id=".$id_articulo_app."";
	$r_ar=mysql_query($select_ar,$conexion);
	/*ID de la seccion*/
			$query_sec="select * from secciones WHERE seudonimo='".$seccion."' and estatus='1' ";
			$res_sec=mysql_query($query_sec, $conexion);
			while($reg=mysql_fetch_array($res_sec))
			{
				$id_seccion=$reg['id'];
			}
			
	while($f_ar=mysql_fetch_assoc($r_ar)):
			
			if($f_ar['id_seccion']==$id_seccion)//articulo coincide con la  busqueda
			{
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
			}
			
		
	endwhile;
	
	$select_se="SELECT seudonimo FROM secciones WHERE id='".$Id_SeccionSlideVertical."'";
	
	$r_se=mysql_query($select_se,$conexion);
	while($f_se=mysql_fetch_assoc($r_se)):
		$SeccionSlideVertical=$f_se['seudonimo'];
		$SeccionSlideVertical=strtolower(utf8_encode($SeccionSlideVertical));
		
	endwhile;
	/*<img src="'.$url_dominio_.'/images/imagenes-articulos/'.$imagenPlaza.'" >*/
	$slide_vertical.=' <div > <a href="#nota" onclick="LeerNota('.$id_nota_app.')">
          <div class="SlideVerticalArticulo">
           
            <div class="SlideVerticalImagen"><img src="'.$url_dominio_.'/images/imagenes-articulos/'.$imagen.'" ></div>
            <div class="SlideVerticalContenido">
              <div class="SlideVerticalTitulo">'.$TituloSlideVertical.'</div>
              <div class="SlideVerticalAutor">'.$AutorSlideVertical.'</div>
              <div class="SlideVerticalFecha">'.$Fecha_CreacionSlideVertical.'</div>
            </div>
          </div>
          </a> </div>
		  
		  <div > 
            <div class="PublicidadSlideVertical">
                <img src="imagenes/publicidad/2.jpg">
            </div>
        </div>
		  ';
endwhile;
$slide_vertical.='</div>';


?>