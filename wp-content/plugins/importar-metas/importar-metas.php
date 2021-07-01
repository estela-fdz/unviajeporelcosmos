<?php
/**
 * @package ImportardorMetas
 * /

/*
Plugin Name: Importador de Metas
Description: Importador de metas y varios.
Version: 1.0.0
Author: Impacto SEOMarketing
Author URI: https://impactoseo.com
License: GPLv2 or later
Text Domain: importador-metas
*/

defined ('ABSPATH') or die ('Acceso denegado');


class ImportadorMetas {
    
    
    function __construct() {
    }
        
    function register () {
        add_action ('admin_enqueue_scripts', array ($this, 'enqueue'));
        
        add_action ('admin_menu', array($this, 'add_admin_pages'));
        
        add_action ('admin_menu', array($this, 'add_admin_pages_data'));
        
        add_action( 'admin_post_importar_excel', array($this, 'get_import_data'));

    }
    
    
    public function add_admin_pages () {
        add_menu_page ('Importación Metas', 'Importación', 'manage_options', 'impacto-import-plugin', array($this, 'import_data'), 'dashicons-admin-generic');
    }
    
    
    function get_import_data () {
        
    if (isset($_POST["enviar"])) {
     require 'Classes/PHPExcel/IOFactory.php';
            
            $archivo = $_FILES["archivo"]["name"];
            $archivo_copiado= $_FILES ["archivo"]["tmp_name"];
            $archivo_guardado = "copia_".$archivo;
            
            if (copy($archivo_copiado, $archivo_guardado)) {
                echo "";
            } else {
                echo "Hubo un error. ";
            }
            
            if (file_exists($archivo_guardado)) {
                
                //Variable con el nombre del archivo
        	$nombreArchivo = $archivo_guardado;
        	// Cargo la hoja de cálculo
        	$objPHPExcel = PHPExcel_IOFactory::load($nombreArchivo);
        	
        	//Asigno la hoja de calculo activa
        	$objPHPExcel->setActiveSheetIndex(0);
        	//Obtengo el numero de filas del archivo
        	$numRows = $objPHPExcel->setActiveSheetIndex(0)->getHighestRow();
        	
        	echo '<table border=1><tr><td>ID</td><td>Keywords</td><td>Metadescripción</td><td>Metatítulo</td><td>Url</td></tr>';
        	
            	for ($i = 2; $i <= $numRows; $i++) {
            		
            		$post_id = $objPHPExcel->getActiveSheet()->getCell('A'.$i)->getCalculatedValue();
            		$keywords = $objPHPExcel->getActiveSheet()->getCell('B'.$i)->getCalculatedValue();
            		$metadescripcion = $objPHPExcel->getActiveSheet()->getCell('C'.$i)->getCalculatedValue();
            		$metatitle = $objPHPExcel->getActiveSheet()->getCell('D'.$i)->getCalculatedValue();	
            		$slug_spaces = $objPHPExcel->getActiveSheet()->getCell('E'.$i)->getCalculatedValue();      
            		$slug = str_replace(" ","",$slug_spaces);

            		
            		echo '<tr>';
            		echo '<td>'. $post_id.'</td>';
            		echo '<td>'. $keywords.'</td>';
            		echo '<td>'. $metadescripcion.'</td>';
            		echo '<td>'. $metatitle.'</td>';
            		echo '<td>'. $slug.'</td>';
            		echo '</tr>';
            		
            		global $wpdb;
            
                    $table = $wpdb->prefix.'postmeta';
                    $table_posts = $wpdb->prefix.'posts';
                    
                    $delete_md = array('post_id' => $post_id, 'meta_key' => '_yoast_wpseo_metadesc');
                    $delete_mt = array('post_id' => $post_id, 'meta_key' => '_yoast_wpseo_title');
                    $delete_kw = array('post_id' => $post_id, 'meta_key' => '_gmk');  
                    
                    $data_md = array('post_id' => $post_id, 'meta_key' => '_yoast_wpseo_metadesc', 'meta_value' => $metadescripcion);
                    $data_mt = array('post_id' => $post_id, 'meta_key' => '_yoast_wpseo_title', 'meta_value' => $metatitle);
                    $data_kw = array('post_id' => $post_id, 'meta_key' => '_gmk', 'meta_value' => $keywords);
                    
                    if(!empty($keywords)) {
                    $wpdb->delete($table, $delete_kw); 
                    $wpdb->insert($table,$data_kw);
                    }
                    
                    if(!empty($metadescripcion)) {
                    $wpdb->delete($table, $delete_md);
                    $wpdb->insert($table,$data_md);
                    }
                    
                    if(!empty($metatitle)) {
                    $wpdb->delete($table, $delete_mt);
                    $wpdb->insert($table,$data_mt);
                    }
                    
                    if(!empty($slug)) {
                    $wpdb->update($table_posts, array('post_name' => $slug,), array('ID' => $post_id));
                    }
                    
                    $wpdb->show_errors();
                    $wpdb->last_query;
            	}
            }
    }
    }
    
    function import_data () { 
    
    $action_path = plugin_dir_path(__FILE__).'get-data.php';
    $example = plugin_dir_url( __FILE__ ).'ejemplo-importacion-impactoseo.xlsx';
    ?>
    
    <html lang="es-ES">
    <head>
        <meta charset="UTF-8">
        <title>Subir metas</title>
    </head>
    
    <body>
    <div class="content">
         <div class="container">
             <div class="cabecera-formulario">
                 <img src="https://media.giphy.com/media/bjE9JbNSckM0w/giphy.gif"/>
                 <h1>¡Vamos a importar las metas!</h1>
                 <p>Sube tu archivo en Excel</p>
             </div>
             <div class="formulario">
                 
                 <form action="<?php echo admin_url( 'admin-post.php' ); ?>" class="formulariocompleto" method="post" enctype="multipart/form-data">
                     <input type="hidden" name="action" value="importar_excel" />
                     <div class="file-container">
                     <input id="file" type="file" name="archivo" class="form-control"/>
                     <a href="<?php echo $example ?>">Descargar ejemplo</a>
                     </div>
                     <input type="submit" value="Subir Archivo" name="enviar"/>
                     <script>
                        window.onload = function(){
                          document.getElementById('file').setAttribute('data-value', 'Selecciona un archivo');
                        };

                       document.getElementById('file').onchange = function() {
                             document.getElementById('file').setAttribute('data-value', 'Archivo subido');
                        };  
                     </script>
                 </form>
             </div>
         </div>
     </div>
    </body>
    
    </html>
   <?php }
   
   
   function enqueue() {
       wp_enqueue_style ('plugin_styles', plugins_url('style.css', __FILE__));
   }
   
   
}

if (class_exists('ImportadorMetas')) {
    $importarMetas = new ImportadorMetas();   
    $importarMetas -> register();
}


