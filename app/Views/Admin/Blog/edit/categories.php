<?php
/**
 * @var \App\Models\SysBlogCategories $categories
 */

$items = [];
foreach ($categories as $category)
{
	$items[] = $category->toArray();
}
?>
<div id="categories-list">
    <template v-for="(item, index) in items">
        <div class="input-group mb-3">
            <input type="hidden" :name="'categories[' + index+ '][id]'" v-model="item.id">
            <input type="text" class="form-control" :name="'categories[' + index+ '][name]'"
                   v-model="item.name">
            <div class="input-group-append">
                <button class="btn btn-danger" type="button" @click="remove(index)">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </template>
    <button class="btn btn-success rounded-sm float-right" type="button" @click="add()">Adicionar <i
                class="fas fa-plus"></i></button>
    <div class="clearfix"></div>
</div>
<script>
    new Vue({
        el: '#categories-list',
        data: {
            items: <?= json_encode($items) ?>,
            oldValues: []
        },
        methods: {
            remove: function (index) {
                this.items.splice(index, 1);
                if (this.oldValues.hasOwnProperty(index)) {
                    delete this.oldValues[index];
                }
            },
            add: function () {
                this.items.push({
                    'id': null,
                    'name': ''
                });
            }
        }
    });
</script>

