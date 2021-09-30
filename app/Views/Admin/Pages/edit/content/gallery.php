<?php

use App\Entities\SysPageVariable;

?>
<template v-if="variable.type == '<?= SysPageVariable::TYPE_GALLERY ?>'">
	<div class="row" v-if="variable.value.length" v-show="!hidden.includes(vIndex)">
		<div class="col-md-3 mb-3 gallery" v-for="(item, gIndex) in variable.value"
			 v-show="item.action != 'delete'">
			<input type="hidden" :name="'variables[' + vIndex + '][value][' + gIndex + '][id]'"
				   v-model="item.id">
			<input type="hidden"
				   :name="'variables[' + vIndex + '][value][' + gIndex + '][sys_page_variable_id]'"
				   v-model="item.sys_page_variable_id">
			<input type="hidden" :name="'variables[' + vIndex + '][value][' + gIndex + '][order]'"
				   v-model="item.order">
			<input type="hidden" :name="'variables[' + vIndex + '][value][' + gIndex + '][action]'"
				   v-model="item.action">
			<div class="modal fade" :id="'gallery-modal-' + vIndex + '-' + gIndex" tabindex="-1"
				 role="dialog"
				 aria-hidden="true">
				<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title">Detalhes</h5>
							<button type="button" class="close" data-dismiss="modal"
									aria-label="Close">
								<span aria-hidden="true">&times;</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="form-group">
								<input type="text" class="form-control"
									   :name="'variables[' + vIndex + '][value][' + gIndex + '][title]'"
                                       placeholder="Título"
									   v-model="item.title">
							</div>
							<div class="form-group">
								<textarea type="text" class="form-control"
									   :name="'variables[' + vIndex + '][value][' + gIndex + '][description]'"
                                          placeholder="Descrição"
                                          v-model="item.description"></textarea>
							</div>
							<div class="form-group">
								<input type="text" class="form-control"
									   :name="'variables[' + vIndex + '][value][' + gIndex + '][url]'"
                                       placeholder="URL"
									   v-model="item.url">
							</div>
							<div class="form-group">
								<div class="custom-control custom-switch">
									<input type="checkbox" class="custom-control-input"
										   :id="'gallery-url-external-' +  vIndex + '-' + gIndex"
										   :name="'variables[' + vIndex + '][value][' + gIndex + '][url_external]'"
										   v-model="item.url_external">
									<label class="custom-control-label text-muted"
										   :for="'gallery-url-external-' +  vIndex + '-' + gIndex">
										Externa
									</label>
								</div>
							</div>
							<small class="text-muted">Para Url interna, informar apenas a Uri (ex: sobre-a-empresa).<br>
								Para Url externa informe o endereço completo  (ex: http://google.com).
							</small>
						</div>
					</div>
				</div>
			</div>
			<div class="picture h-100 border rounded-sm shadow d-block"
				 :style="[ item.image ? { backgroundImage: 'url(\'' + item.image + '\')' } : { backgroundColor: 'white'} ]">
				<div class="gallery-menu" v-if="item.image">
					<i class="fas fa-arrow-left fa-fw fa-2x" v-if="gIndex > 0"
					   @click="galleryOnLeft(variable.value, gIndex)"></i>
					<i class="fas fa-arrow-right fa-fw fa-2x"
					   v-if="gIndex < (variable.value.length - 2)"
					   @click="galleryOnRight(variable.value, gIndex)"></i>
					<i class="fas fa-link fa-fw fa-2x"
					   @click="galleryOnLink(vIndex, gIndex)"></i>
					<i class="far fa-trash-alt fa-fw fa-2x"
					   @click="galleryOnDelete(variable.value, vIndex, gIndex)"></i>
					<i class="fas fa-circle fa-fw"></i>
				</div>
				<input type="file"
					   :id="'file_' + vIndex + '_' + gIndex"
					   :name="'variables[' + vIndex + '][value][' + gIndex + '][image]'"
					   @change="galleryOnChange($event, variable, gIndex)"
					   accept="image/*"
					   v-if="!item.id">
				<div class="add"
					 @click="galleryOnClick(vIndex, gIndex)"
					 v-if="!item.image">
					<i class="fas fa-plus fa-fw fa-4x"></i>
				</div>
			</div>
		</div>
	</div>
</template>