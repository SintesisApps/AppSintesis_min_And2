<?php

include("../../includes/conexion.php");
include('../../funciones.php'); 

$plaza=$_POST["plaza"];



$select_app="SELECT * FROM app_articulos WHERE plaza='".$plaza."' AND estatus='1' ORDER BY id DESC LIMIT 1 ";

	$r_app=mysql_query($select_app,$conexion);
	while($f_app=mysql_fetch_assoc($r_app)):
		$id_nota_app=$f_app['id'];
		$id_articulo_app=$f_app['id_articulo'];
		$plaza_app=$f_app['plaza'];
	

	$select_ar="SELECT titulo,sumario,id_seccion,autor,fecha_creacion,nota FROM articulos_".$plaza_app." WHERE id='".$id_articulo_app."'";
	$r_ar=mysql_query($select_ar,$conexion);
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
	endwhile;
	
	$select_pza="SELECT plaza FROM plazas WHERE seudonimo='".$plaza."'";
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
endwhile;
		
$html='
<div class="HeaderAlternativo"> 
        <div style=" display:inline-block; padding-top:0px; width:10%; padding-left:10px;">
            <a href="#home"><img src="imagenes/iconos/iconosgrises/flecha.png" ></a>
        </div>
        
        <div style=" display:inline-block; padding-top:10px; width:75%; text-align:center;">
            <img src="imagenes/logo.png" height="25">
        </div>
        
</div>
	
  <div data-role="content" > 
   
    
  		<!--Nota Plaza-->
    <div  class="ContenedorPlaza" >
	
	<a href="#nota" onclick="LeerNota('.$id_nota_app.')">
      <div class="ContenedorContenidoPlaza">
        <div class="PlazaImagen" > <img src="'.$url_dominio_.'/images/imagenes-articulos/'.$imagenPlaza.'" > </div>
        <div class="PlazaContenido">
          <div class="PlazaTitulo">'.$TituloPlaza.'</div>
          <div class="PlazaSeccion">'.$SeccionPlaza.'</div>
          <div class="PlazaAutor">'.$AutorPlaza.'</div>
          <div class="PlazaFecha">'.$Fecha_CreacionPlaza.'</div>
          <div class="PlazaSumario">'.$SumarioPlaza.'</div>
        </div>
      </div>
      </a>
    </div>
    <!--Nota Plaza-->
        
        <!--Slide Vertical-->
    <div class="ContenedorSlideVerticalPlaza simple-vertical-plaza">
		<div >';
	
	$select_app="SELECT * FROM app_articulos WHERE plaza='".$plaza."' AND estatus='1' ORDER BY id DESC LIMIT 1,3	 ";
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
	
$html.='
		<a href="#nota" onclick="LeerNota('.$id_nota_app.')">
			<div class="SlideVerticalArticuloPlaza">
				<div class="SlideVerticalSeccionPlaza"><img src="imagenes/iconos/secciones/'.$SeccionSlideVertical.'.png"></div>
				<div class="SlideVerticalImagenPlaza"><img src="'.$url_dominio_.'/images/imagenes-articulos/'.$imagen.'" > </div>
				<div class="SlideVerticalContenidoPlaza">
				  <div class="SlideVerticalTituloPlaza">'.$TituloSlideVertical.'</div>
				  <div class="SlideVerticalAutorPlaza">'.$AutorSlideVertical.'</div>
				  <div class="SlideVerticalFechaPlaza">'.$Fecha_CreacionSlideVertical.'</div>
				  <div class="SlideVerticalSumarioPlaza">'.$SumarioSlideVertical.'</div>
				</div>
			</div>
		</a>
        <div>
          <hr>
        </div>';
endwhile;

      
$html.='</div>';

$select_appMin="SELECT * FROM app_articulos WHERE plaza='".$plaza."' AND estatus='1' ORDER BY id DESC LIMIT 4,3  ";
	$r_appMin=mysql_query($select_appMin,$conexion);
	$TotalMiniaturas=mysql_num_rows($r_appMin);
	
	
if($TotalMiniaturas>0):
$html.='<div >';
	
	$select_app="SELECT * FROM app_articulos WHERE plaza='".$plaza."' AND estatus='1' ORDER BY id  DESC LIMIT 4,3 ";
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
	
$html.='
		<a href="#nota" onclick="LeerNota('.$id_nota_app.')">
			<div class="SlideVerticalArticuloPlaza">
				<div class="SlideVerticalSeccionPlaza"><img src="imagenes/iconos/secciones/'.$SeccionSlideVertical.'.png"></div>
				<div class="SlideVerticalImagenPlaza"><img src="'.$url_dominio_.'/images/imagenes-articulos/'.$imagen.'" > </div>
				<div class="SlideVerticalContenidoPlaza">
				  <div class="SlideVerticalTituloPlaza">'.$TituloSlideVertical.'</div>
				  <div class="SlideVerticalAutorPlaza">'.$AutorSlideVertical.'</div>
				  <div class="SlideVerticalFechaPlaza">'.$Fecha_CreacionSlideVertical.'</div>
				  <div class="SlideVerticalSumarioPlaza">'.$SumarioSlideVertical.'</div>
				</div>
			</div>
		</a>
        <div>
          <hr>
        </div>';
endwhile;

$html.='</div>';
endif;
$html.='</div>
    <!--Slide Vertical--> 
	
<script>

      jQuery(document).ready(function($) {

  $(".simple-vertical-plaza").royalSlider({
    arrowsNav: false,
    arrowsNavAutoHide: false,
    fadeinLoadedSlide: true,
    controlNavigation: "none",
    imageScaleMode: "fill",
    imageAlignCenter:true,
    loop: false,
    loopRewind: false,
    numImagesToPreload: 4,
    slidesOrientation: "vertical",
    keyboardNavEnabled: true,
    video: {
      autoHideArrows:true,
      autoHideControlNav:true
    },  

    autoScaleSlider: false, 
    autoScaleSliderWidth: 960,     
    autoScaleSliderHeight: 450
  });
 
  });
  
  

    </script>';
	
echo $html;
?>