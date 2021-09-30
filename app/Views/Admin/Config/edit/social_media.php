<?php
/**
 * @var SysConfig                      $config
 * @var \App\Entities\SysSocialMedia[] $social_medias
 */

use App\Entities\SysConfig;

$social_medias_list = [];
foreach ($social_medias as $socialMedia)
{
	$social_medias_list[] = $socialMedia->toArray();
}

$social_media_data = [];
$social_media_seleted = [];
foreach ($config->social_medias as $configSocialMedia)
{
	$social_media_data[] = $configSocialMedia->toArray();
	foreach ($social_medias_list as $key => $value)
	{
		if ($value['id'] == $configSocialMedia->social_media_id)
		{
			$social_media_seleted[] = $value;
			unset($social_medias_list[ $key ]);
			break;
		}
	}
}
$social_medias_list = array_values($social_medias_list);

?>
<div id="social-media-list" xmlns:v-bind="http://www.w3.org/1999/xhtml">

    <div class="bg-gray-light px-3 pt-3 mb-3" v-if="list.length">
        <div v-for="item in list" class="social-button mx-1 mb-3" role="group" @click="onAdd(item)">
            <div class="name btn btn-outline-gray-medium bg-gray-lighter">
                <span class="text-dark" v-html="item.icon"></span> <span class="text-muted" v-text="item.name"></span>
            </div>
            <button type="button" class="action btn btn-outline-gray-medium bg-gray-lighter text-dark">
                <i class="fas fa-plus"></i>
            </button>
        </div>
    </div>

    <template v-for="(variable, index) in variables">
        <input type="hidden" class="form-control" :name="'social_medias[' + index + '][id]'"
               v-model="variable.id">
        <input type="hidden" class="form-control" :name="'social_medias[' + index + '][social_media_id]'"
               v-model="variable.social_media_id">
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <span class="input-group-text" v-html="getIcon(variable.social_media_id)"></span>
            </div>
            <input type="text" class="form-control" :name="'social_medias[' + index + '][value]'"
                   v-model="variable.value">
            <div class="input-group-append" @click="onDelete(index)">
                <span class="input-group-text bg-danger text-white cursor-pointer"><i class="fa fa-trash-o"></i></span>
            </div>
        </div>
    </template>

</div>
<script>
    new Vue({
        el: '#social-media-list',
        data: {
            list: <?= json_encode($social_medias_list, JSON_NUMERIC_CHECK) ?>,
            selected: <?= json_encode($social_media_seleted, JSON_NUMERIC_CHECK) ?>,
            variables: <?= json_encode($social_media_data, JSON_NUMERIC_CHECK) ?>,
            social_media_id: null,
            error: false
        },
        methods: {
            getIcon: function (id) {
                for (let i in this.selected) {
                    if (this.selected[i].id === id) return this.selected[i].icon;
                }
            },
            onDelete: function (index) {
                for (let i in this.variables) {
                    if (this.variables[i].social_media_id === this.selected[index].id) {
                        this.variables.splice(i, 1);
                        break;
                    }
                }
                this.list.push(Object.assign({}, this.selected[index]));
                this.selected.splice(index, 1);
            },
            onAdd: function (item) {
                console.log(item);
                this.variables.push({
                    id: '',
                    social_media_id: item.id,
                    value: ''
                });

                this.selected.push(Object.assign({}, item));
                for (let i in this.list) {
                    if (this.list[i].id === item.id) {
                        this.list.splice(i, 1);
                        break;
                    }
                }
                this.social_media_id = null;
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
            onChange: function (event) {
                if (this.social_media_id && this.social_media_id.id) {
                    this.error = false;
                }
            }
        }
    });
</script>