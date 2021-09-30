<?php
/**
 * @var SysConfig $config
 */

use App\Entities\SysConfig;
use App\Entities\SysConfigVariable;

$variables_data = [];
foreach ($config->variables as $configVariable)
{
	$configVariableData = $configVariable->toArray();
	if ($configVariableData['type'] == SysConfigVariable::TYPE_IMAGE) $configVariableData['value'] = img_uploaded_url($configVariableData['value']);
	$variables_data[] = $configVariableData;
}
?>
<div id="variables-list" xmlns:v-bind="http://www.w3.org/1999/xhtml">
    <input v-for="vtr_id in variable_del" type="hidden" name="variable_del[]" v-model="vtr_id">
    <table class="table">
		<?php if ($isSuper): ?>
            <thead>
            <tr class="bg-gray-light">
                <td width="220" class="text-nowrap text-primary">
                    <input type="text" :class="{ 'is-invalid': errors.key }" class="form-control"
                           placeholder="<?= lang('Admin.Config.Variables.placeholder-key') ?>"
                           v-model="variable_add.key">
                </td>
                <td>
                    <div class="form-row">
                        <div class="col-11 pt-1">
							<?php foreach (SysConfigVariable::listTypes() as $k => $v): ?>
                                <div class="custom-control custom-radio custom-control-inline">
                                    <input type="radio" id="types-<?= $k ?>" name="types" class="custom-control-input"
                                           v-model="variable_add.type" value="<?= $k ?>">
                                    <label class="custom-control-label"
                                           for="types-<?= $k ?>"><?= lang('Admin.Config.Variables.option-' . $k) ?></label>
                                </div>
							<?php endforeach; ?>
                        </div>
                        <div class="col-1">
                            <button type="button" class="btn btn-block btn-primary rounded-sm" @click="onAdd()"><i
                                        class="fas fa-plus"></i>
                            </button>
                        </div>
                    </div>
                </td>
            </tr>
            </thead>
		<?php endif; ?>
        <tbody>
        <template v-for="(variable, index) in variables">
            <tr>
                <td width="1" class="text-nowrap text-muted">
					<?php if ($isSuper): ?>
                        <span @click="onDelete(index, variable.id)" style="cursor: pointer"><i
                                    class="fa fa-trash-o text-danger"></i>&nbsp;</span>
					<?php endif; ?>{{ variable.key }}
                </td>
                <td>
                    <input type="hidden" class="form-control" :name="'variables[' + index + '][id]'"
                           v-model="variable.id">
                    <input type="hidden" class="form-control" :name="'variables[' + index + '][key]'"
                           v-model="variable.key">
                    <input type="hidden" class="form-control" :name="'variables[' + index + '][type]'"
                           v-model="variable.type">
                    <input type="hidden" class="form-control" :name="'variables[' + index + '][sys_page_id]'"
                           v-model="variable.sys_page_id">
                    <input type="hidden" class="form-control" :name="'variables[' + index + '][order]'"
                           v-model="variable.order">
                    <input type="text" class="form-control" :name="'variables[' + index + '][value]'"
                           v-model="variable.value" v-if="variable.type == '<?= SysConfigVariable::TYPE_TEXT ?>'">
                    <textarea class="form-control" :name="'variables[' + index + '][value]'" v-model="variable.value"
                              v-if="variable.type == '<?= SysConfigVariable::TYPE_MULTITEXT ?>'" rows="5"></textarea>
                    <textarea class="form-control code" :name="'variables[' + index + '][value]'"
                              v-model="variable.value"
                              v-if="variable.type == '<?= SysConfigVariable::TYPE_CODE ?>'" rows="5"></textarea>
                    <template v-if="variable.type == '<?= SysConfigVariable::TYPE_IMAGE ?>'">
                        <div class="row">
                            <div class="col-md-3" v-if="variable.value">
                                <img class="img-thumbnail img-fluid shadow" v-bind:src="variable.value"
                                     style="cursor: pointer" @click="onClick(index)"/>
                            </div>
                            <div class="col">
                                <div class="custom-file">
                                    <input type="file" :name="'variables[' + index + '][value]'"
                                           class="custom-file-input" :id="'variables-' + index"
                                           @change="onChange($event, variable)">
                                    <label class="custom-file-label" :for="'variables-' + index"
                                           data-browse="<?= lang('Admin.help-selectImage') ?>"></label>
                                </div>
                            </div>
                        </div>
                    </template>
                </td>
            </tr>
        </template>
        </tbody>
    </table>
</div>
<script>
    new Vue({
        el: '#variables-list',
        data: {
            variables: <?= json_encode($variables_data) ?>,
            variable_add: {
                key: null,
                type: 'T',
            },
            variable_del: [],
            errors: {
                key: false
            }
        },
        methods: {
            onDelete: function (index, id) {
                if (id) this.variable_del.push(id);
                this.variables.splice(index, 1);
            },
            onAdd: function () {
                this.errors.key = false;

                if (!this.variable_add.key || !this.variable_add.key.length) {
                    this.errors.key = true;
                    return;
                }

                let regex = /^[a-z0-9_]*$/;
                if (!regex.test(this.variable_add.key)) {
                    this.errors.key = true;
                    return;
                }

                let order = 0;
                let keys = [];

                for (let i in this.variables) {
                    keys.push(this.variables[i].key);

                    let currentOrder = parseInt(this.variables[i].order);
                    if (currentOrder > order) order = currentOrder;
                }

                if (keys.includes(this.variable_add.key)) {
                    this.errors.key = true;
                    return;
                }

                this.variables.push({
                    id: '',
                    type: this.variable_add.type,
                    key: this.variable_add.key,
                    value: '',
                    order: order + 1,
                });
            },
            onClick: function (index) {
                const node = document.getElementById('variables-' + index);

                if (document.createEvent) {
                    const evt = document.createEvent('MouseEvents');
                    evt.initEvent('click', true, false);
                    node.dispatchEvent(evt);
                } else if (document.createEventObject) {
                    node.fireEvent('onclick');
                } else if (typeof node.onclick == 'function') {
                    node.onclick();
                }
            },
            onChange: function (event, variable) {
                if (event.target.files.length) {
                    event.target.nextElementSibling.innerHTML = event.target.files[0].name;

                    const reader = new FileReader();
                    reader.onload = e => {
                        variable.value = e.target.result;
                    };
                    reader.readAsDataURL(event.target.files[0]);
                }
            }
        }
    });
</script>