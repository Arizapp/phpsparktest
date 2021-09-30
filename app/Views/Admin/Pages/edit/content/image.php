<?php

use App\Entities\SysPageVariable;

?>
<template v-if="variable.type == '<?= SysPageVariable::TYPE_IMAGE ?>'">
	<div class="row">
		<div class="col-md-3" v-if="variable.value">
			<img class="img-thumbnail img-fluid shadow" v-bind:src="variable.value"
				 style="cursor: pointer" @click="onClick(vIndex)"/>
		</div>
		<div class="col">
			<div class="custom-file">
				<input type="file" :name="'variables[' + vIndex + '][value]'"
					   accept="image/*"
					   class="custom-file-input" :id="'variables-' + vIndex"
					   @change="onChange($event, variable)">
				<label class="custom-file-label" :for="'variables-' + vIndex"
					   data-browse="Escolher Imagem"></label>
			</div>
		</div>
	</div>
</template>