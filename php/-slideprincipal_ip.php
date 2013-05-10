<?php
/*CRAGAR EL  SLIDE PRINCIPAL*/
include("../../includes/conexion.php");
include('../../funciones.php'); 
//Slide Principal

$html='<div style="float:left;margin-right:-600000px;">
        
        <div class="SubContenedorPrincipal">';
//Consulta de datos
	/*if(isset($_POST['accion'])){
		if($_POST['accion'] == 'leer'){*/
			//$arr = "mensaje";
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
          <div class="SlidePrincipalAutor">'.$AutorSlidePrincipal.'</div>
          <div class="SlidePrincipalFecha">'.$Fecha_CreacionSlidePrincipal.'</div>
          <div class="SlidePrincipalSumario">'.$SumarioSlidePrincipal.'</div>
        </div>
      </div>
      </a>
	';

	

endwhile;
		/*<div class="SubContenedorPrincipal">
			 <a href="#nota">
            <div style="display:inline-block; overflow:hidden">
              <div class="SlidePrincipalImagen"> <img src="imagenes/imagenes-articulos/1.jpg"> </div>
              <div class="SlidePrincipalContenido">
                <div class="SlidePrincipalTitulo"> Signan convenio para obras en pueblos indígenas </div>
                <div class="SlidePrincipalSeccion"> METRÓPOLI </div>
                <div class="SlidePrincipalAutor"> Clauda Aguilar/Síntesis </div>
                <div class="SlidePrincipalFecha"> 2013-03-28 14:27:29 </div>
                <div class="SlidePrincipalSumario"> Sumario </div>
              </div>
            </div>
            </a> 
		</div>*/	
			$html.='</div></div>';
			
			echo $html;
	


?>