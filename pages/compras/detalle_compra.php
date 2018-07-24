<?php 
@session_start();
?>
<?php if(count($_SESSION['detalle_compra'])>0){?>
	<table class="table">
	    <thead>
	        <tr>
	            <th>Código Artículo</th>
                      <th>Descripci&oacute;n</th>
                      <th>Cantidad</th>
                      <th>Existencia Minima</th>
                       <th>Porcentaje</th>
                      <th>Precio</th>
	            <th></th>
	        </tr>
	    </thead>
	    <tbody>
	    	<?php 
	    	$total = 0;
	    	foreach($_SESSION['detalle_compra'] as $k => $detalle_compra){ 
			$total += $detalle_compra['Precio_Final'];
	    	?>
	        <tr>
	        	<td><?php echo $detalle_compra['Id_Articulo'];?></td>
	        	<td><?php echo $detalle_compra['Descripcion'];?></td>
	            <td><?php echo $detalle_compra['Existencias'];?></td>
	            <td><?php echo $detalle_compra['Existencias_Minimas'];?></td>
	             <td><?php echo $detalle_compra['Porcentaje_Ganancia'];?></td>
                 <td><?php echo $$detalle_compra['Precio_Final'];?></td>
	
     <td><button type="button" class="btn btn-sm btn-danger eliminar-producto" id="<?php echo $detalle_compra['Id_Articulo'];?>">Eliminar</button></td>
	        </tr>
	        <?php }?>
	        <tr>
	        	<td colspan="3" class="text-right">Total</td>
	        	<td><?php echo $total;?></td>
	        	<td></td>
	        </tr>
	    </tbody>
	</table>
<?php }else{?>
<div class="panel-body"> No hay productos agregados</div>
<?php }?>

<script type="text/javascript" src="libs/ajax_compras.js"></script>