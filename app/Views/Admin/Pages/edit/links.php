<?php
/**
 * @var \App\Entities\SysPage $page
 */

$links_data = [];
foreach ($page->uris as $pageUri)
{
	$links_data[] = $pageUri->uri;
}
?>
<div id="links-list">
    <template v-for="(link, index) in links">
        <div class="input-group mb-3">
            <input type="text" class="form-control" name="uris[]"
                   v-model="links[index]" @input="onInput(index, $event)">
            <div class="input-group-append">
                <button class="btn btn-danger" type="button" @click="remove(index)">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </template>
    <button class="btn btn-success rounded-sm float-right" type="button" @click="add()"><?= lang('Admin.btn-add') ?> <i
                class="fas fa-plus"></i></button>
    <div class="clearfix"></div>
</div>
<script>
    new Vue({
        el: '#links-list',
        data: {
            links: <?= json_encode($links_data) ?>,
            oldValues: []
        },
        methods: {
            remove: function (index) {
                this.links.splice(index, 1);
                if (this.oldValues.hasOwnProperty(index)) {
                    delete this.oldValues[index];
                }
            },
            add: function () {
                this.links.push('');
            },
            onInput: function (index, event) {
                event.target.classList.remove('is-invalid');

                const uri = document.getElementById('input-uri').value;

                let regex = /^(?!.*([\/])\1{1})[a-z0-9\-\/]*$/;
                if (!regex.test(event.target.value)) {
                    event.target.value = this.oldValues.hasOwnProperty(index) ? this.oldValues[index] : '';
                    this.links[index] = event.target.value;
                }
                for (let key in this.links) {
                    if (key == index) continue;
                    if (this.links[key] === event.target.value) {
                        event.target.classList.add('is-invalid');
                    }
                }
                if (event.target.value === uri) {
                    event.target.classList.add('is-invalid');
                }
                this.oldValues[index] = event.target.value;
            }
        }
    });
</script>