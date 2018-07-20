<?php 
@session_start();
?>
<?php if(count($_SESSION['detalle_compra'])>0){?>
	<table class="table">
	    <thead>
	        <tr>
	            <th>Descripci&oacute;n</th>
	            <th>Cantidad</th>
	            <th>Precio</th>
				<th>Subtotal</th>
	            <th></th>
	        </tr>
	    </thead>
	    <tbody>
	    	<?php 
	    	$total = 0;
	    	foreach($_SESSION['detalle_compra'] as $k => $detalle_compra){ 
			$total += $detalle_compra['subtotal'];
	    	?>
	        <tr>
	        	<td><?php echo $detalle_factura['producto'];?></td>
	            <td><?php echo $detalle_factura['cantidad'];?></td>
	           <td><input type="text" value="<?php echo $detalle_compra['precio'];?>" product_id="<?php echo $detalle_compra['id'];?>" class="precio-producto"></td>
				<td><?php echo $detalle_factura['subtotal'];?></td>
	            <td><button type="button" class="btn btn-sm btn-danger eliminar-producto" id="<?php echo $detalle_compra['id'];?>">Eliminar</button></td>
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