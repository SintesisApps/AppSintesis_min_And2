<?php
/*CRAGAR EL  SLIDE PRINCIPAL*/
include("../../includes/conexion.php");
include('../../funciones.php'); 
//Slide Principal

$html='';
			$arr = array();
			$i=0;//contador
			
			$select_app="SELECT * FROM app_articulos WHERE posicion='Slide-Principal' AND estatus='1' ORDER BY id DESC";
	$r_app=mysql_query($select_app,$conexion);
	while($f_app=mysql_fetch_assoc($r_app)):
		$id_nota_app=$f_app['id'];
		$id_articulo_app=$f_app['id_articulo'];
		$plaza_app=$f_app['plaza'];
		
		$select_ar="SELECT titulo,sumario,id_seccion,autor,fecha_creacion,nota FROM articulos_".$plaza_app." WHERE id=".$id_articulo_app."";
		
		$r_ar=mysql_query($select_ar,$conexion);
		while($f_ar=mysql_fetch_assoc($r_ar)):
		$TituloSlidePrincipal=$f_ar['titulo'];
		$SumarioSlidePrincipal=$f_ar['sumario'];
		$Id_SeccionSlidePrincipal=$f_ar['id_seccion'];
		$AutorSlidePrincipal=$f_ar['autor'];
		$NotaSlidePrincipal=$f_ar['nota'];
		$Fecha_CreacionSlidePrincipal=$f_ar['fecha_creacion'];
		
		$TituloSlidePrincipal=utf8_encode($TituloSlidePrincipal);
		$SumarioSlidePrincipal=utf8_encode($SumarioSlidePrincipal);
		$AutorSlidePrincipal=utf8_encode($AutorSlidePrincipal);
		$NotaSlidePrincipal=utf8_encode($NotaSlidePrincipal);
		
		$imagen=extraer_imagen($NotaSlidePrincipal);
		$imagen=utf8_decode($imagen);
	endwhile;
	
			$select_se="SELECT seccion FROM secciones WHERE id='".$Id_SeccionSlidePrincipal."'";
			$r_se=mysql_query($select_se,$conexion);
		while($f_se=mysql_fetch_assoc($r_se)):
		$SeccionSlidePrincipal=$f_se['seccion'];
		$SeccionSlidePrincipal=utf8_encode($SeccionSlidePrincipal);
	endwhile;
		
		$html.='
	<a href="#nota" onclick="LeerNota('.$id_nota_app.')">
      <div class="ContenedorContenidoPrincipal" style="display:inline-block; overflow:hidden">
        <div class="SlidePrincipalImagen" > <img src="'.$url_dominio_.'/images/imagenes-articulos/'.$imagen.'" > </div>
        <div class="SlidePrincipalContenido">
          <div class="SlidePrincipalTitulo">'.$TituloSlidePrincipal.'</div>
          <div class="SlidePrincipalSeccion">'.$SeccionSlidePrincipal.'</div>
          <div class="SlidePrincipalFecha">'.$Fecha_CreacionSlidePrincipal.'</div>
        </div>
      </div>
      </a>
	';

	

endwhile;

$html.='
    
	
	

<div class="wrapper page">
 
  <script>
      jQuery(document).ready(function($) {
		  
 $(document).bind("dragstart", function() { return false; });

	$("#mouseSwipeScroll").swipe({
    TYPE:"mouseSwipe",
    HORIZ: true
  });
  
  $("#mouseSwipe1").swipe({
    TYPE:"mouseSwipe",
    HORIZ: false,
    SNAPDISTANCE:20,
    DURATION:250,
    EASING:"swing",
    ARROWS:false,
    FADEARROWS:true,
    PAGENUM:"#pagenum1"
  });


  $(".SlidePrincipal").royalSlider({
    autoHeight: false,
    arrowsNav: false,
    fadeinLoadedSlide: false,
    controlNavigationSpacing: 0,
    controlNavigation: "tabs",
    imageScaleMode: "none",
    imageAlignCenter:false,
    loop: false,
    loopRewind: true,
    numImagesToPreload: 6,
    keyboardNavEnabled: false,
    usePreloader: true
  });
  
  $(".SlideMiniaturas").royalSlider({
    autoHeight: true,
    arrowsNav: false,
    fadeinLoadedSlide: false,
    controlNavigationSpacing: 0,
    controlNavigation: "tabs",
    imageScaleMode: "none",
    imageAlignCenter:false,
    loop: false,
    loopRewind: true,
    numImagesToPreload: 6,
    keyboardNavEnabled: false,
    usePreloader: true
  });
  
  
  
  $(".SlideMedio").royalSlider({
    autoHeight: true,
    arrowsNav: false,
    fadeinLoadedSlide: false,
    controlNavigationSpacing: 0,
    controlNavigation: "tabs",
    imageScaleMode: "none",
    imageAlignCenter:false,
    loop: false,
    loopRewind: true,
    numImagesToPreload: 6,
    keyboardNavEnabled: false,
    usePreloader: true
  });
  
  $(".simple-vertical").royalSlider({
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

    autoScaleSlider: true, 
    autoScaleSliderWidth: 960,     
    autoScaleSliderHeight: 850
  });
  
  
  
  });
  
  

    </script> 
</div>';

		
			
			echo $html;
	


?>