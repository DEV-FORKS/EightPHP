<table class="eight-profiler-table" style="<?=$hidden ? 'display:none' : ''?>" id="<?=$id?>">
<?php
foreach($rows as $row):

$class = empty($row['class']) ? '' : ' class="'.$row['class'].'"';
$style = empty($row['style']) ? '' : ' style="'.$row['style'].'"';
?>
	<tr<?php echo $class; echo $style; ?> onmouseover="this.className= this.className + ' ep-hover'" onmouseout="this.className=this.className.replace(' ep-hover', '')">
		<?php
		foreach($columns as $index => $column) {
			$class = empty($column['class']) ? '' : ' class="'.$column['class'].'"';
			$style = empty($column['style']) ? '' : ' style="'.$column['style'].'"';
			$value = $row['data'][$index];
			if(!str::contains($row['class'], "ep-no-formatting")) {
				$value = (is_array($value) OR is_object($value)) ? '<pre>'.html::specialchars(print_r($value, YES)).'</pre>' : html::specialchars($value);
			}
			echo '<td', $style, $class, '><span>', $value, '</span></td>';
		}
		?>
	</tr>
<?php

endforeach;
?>
</table>