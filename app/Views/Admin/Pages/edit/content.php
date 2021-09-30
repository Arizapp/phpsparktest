<?php
/**
 * @var SysPage $page
 */

use App\Entities\SysPage;
use App\Entities\SysPageVariable;

$variables_data = [];
foreach ($page->variables as $pageVariable)
{
	$pageVariableData = $pageVariable->toArray();
	switch ($pageVariableData['type'])
	{
		case SysPageVariable::TYPE_IMAGE;
			$pageVariableData['value'] = site_url("assets/img/uploads/{$pageVariableData['value']}");
			break;
		case SysPageVariable::TYPE_GALLERY:
			$gallery = [];
			foreach ($pageVariable->gallery as $image)
			{
				$img = $image->toArray();
				$img['action'] = 'update';
				$gallery[] = $img;
			}
			$pageVariableData['value'] = $gallery;
			break;
		case SysPageVariable::TYPE_TEXT_PAIRS:
			$pairs = [];
			foreach ($pageVariable->text_pairs as $textPair)
			{
				$pair = $textPair->toArray();
				$pair['action'] = 'update';
				$pairs[] = $pair;
			}
			$pageVariableData['value'] = $pairs;
			break;
		case SysPageVariable::TYPE_TEXT_LIST:
			$items = [];
			foreach ($pageVariable->text_list as $textItem)
			{
				$item = $textItem->toArray();
				$item['action'] = 'update';
				$items[] = $item;
			}
			$pageVariableData['value'] = $items;
			break;
	}
	$variables_data[] = $pageVariableData;
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
                               placeholder="<?= lang('Admin.Pages.Content.placeholder-key') ?>"
                               v-model="variable_add.key">
                    </td>
                    <td>
                        <div class="form-row">
                            <div class="col-11 pt-1">
								<?php foreach (SysPageVariable::listTypes() as $k => $v): ?>
                                    <div class="custom-control custom-radio custom-control-inline">
                                        <input type="radio" id="types-<?= $k ?>" name="types"
                                               class="custom-control-input"
                                               v-model="variable_add.type" value="<?= $k ?>">
                                        <label class="custom-control-label"
                                               for="types-<?= $k ?>"><?= lang('Admin.Pages.Content.option-' . $k) ?></label>
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
            <template v-for="(variable, vIndex) in variables">
                <tr :id="'variable_' + vIndex">
                    <td width="220" class="text-nowrap text-muted">
                        <i class="far cursor-pointer"
                           :class="{ 'fa-caret-square-down': !hidden.includes(vIndex), 'fa-caret-square-right': hidden.includes(vIndex) }"
                           @click="toggleDisplay(vIndex)"
                           v-if="variable.type == '<?= SysPageVariable::TYPE_GALLERY ?>'
                       || variable.type == '<?= SysPageVariable::TYPE_TEXT_PAIRS ?>'
                       || variable.type == '<?= SysPageVariable::TYPE_TEXT_LIST ?>'">
                        </i>
                        <button type="button" class="btn btn-primary btn-sm ml-1 float-right"
                                @click="tpOnAdd(variable, vIndex)"
                                v-if="variable.type == '<?= SysPageVariable::TYPE_TEXT_PAIRS ?>'">
                            <i class="fas fa-plus"></i>
                        </button>
                        <button type="button" class="btn btn-primary btn-sm ml-1 float-right"
                                @click="tlOnAdd(variable, vIndex)"
                                v-if="variable.type == '<?= SysPageVariable::TYPE_TEXT_LIST ?>'">
                            <i class="fas fa-plus"></i>
                        </button>
						<?php if ($isSuper): ?>
                            <button type="button" class="btn btn-danger btn-sm float-right"
                                    @click="onDelete(vIndex, variable.id)">
                                <i class="far fa-trash-alt"></i>
                            </button>
						<?php endif; ?>
                        {{ variable.key }}
                    </td>
                    <td>
                        <input type="hidden" class="form-control" :name="'variables[' + vIndex + '][id]'"
                               v-model="variable.id">
                        <input type="hidden" class="form-control" :name="'variables[' + vIndex + '][key]'"
                               v-model="variable.key">
                        <input type="hidden" class="form-control" :name="'variables[' + vIndex + '][type]'"
                               v-model="variable.type">
                        <input type="hidden" class="form-control" :name="'variables[' + vIndex + '][sys_page_id]'"
                               v-model="variable.sys_page_id">
                        <input type="hidden" class="form-control" :name="'variables[' + vIndex + '][order]'"
                               v-model="variable.order">
                        <input type="text" class="form-control" :name="'variables[' + vIndex + '][value]'"
                               v-model="variable.value" v-if="variable.type == '<?= SysPageVariable::TYPE_TEXT ?>'">
                        <textarea class="form-control" :name="'variables[' + vIndex + '][value]'"
                                  v-model="variable.value"
                                  v-if="variable.type == '<?= SysPageVariable::TYPE_MULTITEXT ?>'" rows="5"></textarea>
						<?= view('Admin/Pages/edit/content/image') ?>
						<?= view('Admin/Pages/edit/content/gallery') ?>
						<?= view('Admin/Pages/edit/content/text_pairs') ?>
						<?= view('Admin/Pages/edit/content/text_list') ?>
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
            variables: <?= json_encode($variables_data, JSON_NUMERIC_CHECK) ?>,
            variable_add: {
                key: null,
                type: 'T',
            },
            variable_del: [],
            errors: {
                key: false
            },
            hidden: []
        },
        created: function () {
            for (let vIndex in this.variables) {
                let variable = this.variables[vIndex];
                if (variable.type === '<?= SysPageVariable::TYPE_GALLERY ?>') {
                    this.galleryOnAdd(variable);
                }
            }
        },
        methods: {
            tlOnAdd: function (variable, vIndex) {
                variable.value.push({
                    id: null,
                    sys_page_variable_id: variable.id,
                    text: null,
                    order: 0,
                    action: 'insert'
                });
                vIndex = vIndex || null;
                if (vIndex) {
                    if (this.hidden.includes(vIndex)) {
                        this.hidden.splice(this.hidden.indexOf(vIndex), 1);
                    }
                    this.$forceUpdate();
                    window.setTimeout(() => {
                        $('#variable_' + vIndex).find('input[type="text"]').last().trigger('focus');
                    }, 100);
                }
            },
            tlOnDelete: function (values, vIndex, tlIndex) {
                if (values[tlIndex].id) {
                    values[tlIndex].action = 'delete';
                } else {
                    values.splice(tlIndex, 1);
                }
            },
            tlOnUp: function (values, tlIndex) {
                for (let i in values) {
                    i = parseInt(i);
                    if (values[i].action === 'delete') continue;
                    if (i === (tlIndex - 1)) {
                        [values[i], values[tlIndex]] = [values[tlIndex], values[i]];
                        this.$forceUpdate();
                        break;
                    }
                }
            },
            tlOnDown: function (values, tlIndex) {
                for (let i in values) {
                    i = parseInt(i);
                    if (values[i].action === 'delete') continue;
                    if (i === (tlIndex + 1)) {
                        [values[i], values[tlIndex]] = [values[tlIndex], values[i]];
                        this.$forceUpdate();
                        break;
                    }
                }
            },
            tpOnAdd: function (variable, vIndex) {
                variable.value.push({
                    id: null,
                    sys_page_variable_id: variable.id,
                    title: null,
                    text: null,
                    order: 0,
                    action: 'insert'
                });
                vIndex = vIndex || null;
                if (vIndex) {
                    if (this.hidden.includes(vIndex)) {
                        this.hidden.splice(this.hidden.indexOf(vIndex), 1);
                    }
                    this.$forceUpdate();
                    window.setTimeout(() => {
                        $('#variable_' + vIndex).find('input[type="text"]').last().trigger('focus');
                    }, 100);
                }
            },
            tpOnDelete: function (values, vIndex, tpIndex) {
                if (values[tpIndex].id) {
                    values[tpIndex].action = 'delete';
                } else {
                    values.splice(tpIndex, 1);
                }
            },
            tpOnUp: function (values, tpIndex) {
                for (let i in values) {
                    i = parseInt(i);
                    if (values[i].action === 'delete') continue;
                    if (i === (tpIndex - 1)) {
                        [values[i], values[tpIndex]] = [values[tpIndex], values[i]];
                        this.$forceUpdate();
                        break;
                    }
                }
            },
            tpOnDown: function (values, tpIndex) {
                for (let i in values) {
                    i = parseInt(i);
                    if (values[i].action === 'delete') continue;
                    if (i === (tpIndex + 1)) {
                        [values[i], values[tpIndex]] = [values[tpIndex], values[i]];
                        this.$forceUpdate();
                        break;
                    }
                }
            },
            galleryOnAdd: function (variable) {
                variable.value.push({
                    id: null,
                    sys_page_variable_id: variable.id,
                    image: null,
                    title: null,
                    description: null,
                    url: null,
                    url_external: false,
                    order: 0,
                    action: 'none'
                });
            },
            galleryOnDelete: function (values, vIndex, gIndex) {
                if (values[gIndex].id) {
                    values[gIndex].action = 'delete';
                } else {
                    values.splice(gIndex, 1);
                    this.$forceUpdate();
                    document.getElementById('file_' + vIndex + '_' + gIndex).value = '';
                }
                // this.galleryReorder(values);
            },
            galleryOnLeft: function (values, gIndex) {
                for (let i in values) {
                    i = parseInt(i);
                    if (values[i].action === 'delete') continue;
                    if (i === (gIndex - 1)) {
                        [values[i], values[gIndex]] = [values[gIndex], values[i]];
                        this.$forceUpdate();
                        break;
                    }
                }
            },
            galleryOnRight: function (values, gIndex) {
                for (let i in values) {
                    i = parseInt(i);
                    if (values[i].action === 'delete') continue;
                    if (i === (gIndex + 1)) {
                        [values[i], values[gIndex]] = [values[gIndex], values[i]];
                        this.$forceUpdate();
                        break;
                    }
                }
            },
            galleryOnLink: function (vIndex, gIndex) {
                $('#gallery-modal-' + vIndex + '-' + gIndex).modal('show');
            },
            galleryOnClick: function (vIndex, gIndex) {
                const elementName = 'file_' + vIndex + '_' + gIndex;
                const node = document.getElementById(elementName);
                if (node) {
                    if (document.createEvent) {
                        const evt = document.createEvent('MouseEvents');
                        evt.initEvent('click', true, false);
                        node.dispatchEvent(evt);
                    } else if (document.createEventObject) {
                        node.fireEvent('onclick');
                    } else if (typeof node.onclick == 'function') {
                        node.onclick();
                    }
                }
            },
            galleryOnChange: function (event, gallery, gIndex) {
                console.log(event.target);
                if (event.target.files.length) {
                    const reader = new FileReader();
                    reader.onload = e => {
                        gallery.value[gIndex].image = e.target.result;
                        gallery.value[gIndex].action = 'insert';
                        window.setTimeout(() => {
                            this.galleryOnAdd(gallery);
                        }, 500);
                    };
                    reader.readAsDataURL(event.target.files[0]);
                }
            },
            onDelete: function (vIndex, id) {
                if (id) this.variable_del.push(id);
                this.variables.splice(vIndex, 1);
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

                const variable = {
                    id: '',
                    sys_page_id: <?= $page->id ?>,
                    type: this.variable_add.type,
                    key: this.variable_add.key,
                    value: '',
                    order: order + 1,
                    action: 'insert'
                };
                this.variables.push(variable);

                if (variable.type === '<?= SysPageVariable::TYPE_GALLERY ?>') {
                    variable.value = [];
                    this.galleryOnAdd(variable);
                }

                if (variable.type === '<?= SysPageVariable::TYPE_TEXT_PAIRS ?>') {
                    variable.value = [];
                    this.tpOnAdd(variable);
                }

                if (variable.type === '<?= SysPageVariable::TYPE_TEXT_LIST ?>') {
                    variable.value = [];
                    this.tlOnAdd(variable);
                }

                this.$forceUpdate();
                window.setTimeout(() => {
                    const lastIndex = $('#variable_' + (this.variables.length - 1));
                    $('html,body').animate({scrollTop: lastIndex.offset().top}, 'slow');
                    switch (variable.type) {
                        case '<?= SysPageVariable::TYPE_GALLERY ?>':
                        case '<?= SysPageVariable::TYPE_IMAGE ?>':
                            lastIndex.find('input[type="file"]').last().trigger('click');
                            break;
                        case '<?= SysPageVariable::TYPE_MULTITEXT ?>':
                            lastIndex.find('textarea').last().trigger('focus');
                            break;
                        default:
                            lastIndex.find('input[type="text"]').last().trigger('focus');
                    }
                }, 100);
            },
            onClick: function (vIndex) {
                const node = document.getElementById('variables-' + vIndex);

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
            },
            toggleDisplay: function (vIndex) {
                if (this.hidden.includes(vIndex)) {
                    this.hidden.splice(this.hidden.indexOf(vIndex), 1);
                } else {
                    this.hidden.push(vIndex);
                }
            }
        }
    });
</script>