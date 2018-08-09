<?php 
@session_start();
?>
<?php if(count($_SESSION['detalle'])>0){?>
	<table class="table">
	    <thead>
	        <tr>
	          <th>Regístro Compra</th>
				<th>Código de Artículo</th>
				<th>Cantidad</th>
				<th>Existencia Minima</th>	
				<th>Utilidad</th>
				<th>Porcentaje</th>	
				<th>Precio Final</th>	           
	            <th></th>
	        </tr>
	    </thead>
	    <tbody>
	    	<?php 
	    	foreach($_SESSION['detalle'] as $k => $detalle){ 
	    	?>
	        <tr>

	       <td><?php echo $detalle['proveedor'];?></td>
	         <td><?php echo $detalle['descripcion'];?></td>
	         <td><?php echo $detalle['cantidad'];?></td>
	         <td><?php echo $detalle['existencia'];?></td>
	         <td><?php echo $detalle['costo'];?></td>
	          <td><?php echo $detalle['porcentaje'];?></td>
	          <td><?php echo $detalle['precio'];?></td>

	        	
	            <td><button type="button" class="btn btn-sm btn-danger eliminar-producto" id="<?php echo $detalle['id'];?>">Eliminar</button></td>
	        </tr>
	        <?php }?>
	    </tbody>
	</table>
<?php }else{?>
<div class="panel-body"> No hay productos agregados</div>
<?php }?>

<script type="text/javascript" src="libs/ajax_compras.js"></script>