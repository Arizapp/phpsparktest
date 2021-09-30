<?php

use App\Entities\SysPageVariable;

?>
<template
        v-if="variable.type == '<?= SysPageVariable::TYPE_TEXT_LIST ?>' && variable.value.length">
    <table v-for="(item, tlIndex) in variable.value"
           v-show="item.action != 'delete' && !hidden.includes(vIndex)"
           class="text-pairs w-100 mb-3">
        </tr>
        <tr>
            <td class="p-0">
                <input type="hidden" :name="'variables[' + vIndex + '][value][' + tlIndex + '][id]'"
                       v-model="item.id">
                <input type="hidden"
                       :name="'variables[' + vIndex + '][value][' + tlIndex + '][sys_page_variable_id]'"
                       v-model="item.sys_page_variable_id">
                <input type="hidden"
                       :name="'variables[' + vIndex + '][value][' + tlIndex + '][order]'"
                       v-model="item.order">
                <input type="hidden"
                       :name="'variables[' + vIndex + '][value][' + tlIndex + '][action]'"
                       v-model="item.action">
                <div class="input-group input-tl-title shadow">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-gray-light">{{ tlIndex + 1 }}</div>
                    </div>
                    <textarea class="form-control" rows="3"
                              :name="'variables[' + vIndex + '][value][' + tlIndex + '][text]'"
                              v-model="item.text"></textarea>
                </div>
            </td>
            <td width="1" class="py-0 pr-0">
                <div class="btn-group-vertical">
                    <button type="button"
                            class="btn btn-sm btn-outline-gray-medium text-gray-medium-dark"
                            v-if="tlIndex > 0"
                            @click="tlOnUp(variable.value, tlIndex)">
                        <i class="fas fa-arrow-up"></i>
                    </button>
                    <button type="button"
                            class="btn btn-sm btn-outline-gray-medium text-gray-medium-dark"
                            @click="tlOnDelete(variable.value, vIndex, tlIndex)">
                        <i class="far fa-trash-alt"></i>
                    </button>
                    <button type="button"
                            class="btn btn-sm btn-outline-gray-medium text-gray-medium-dark"
                            v-if="tlIndex < (variable.value.length - 1)"
                            @click="tlOnDown(variable.value, tlIndex)">
                        <i class="fas fa-arrow-down"></i>
                    </button>
                    <button type="button"
                            class="btn btn-sm btn-outline-gray-medium text-gray"
                            v-if="tlIndex == (variable.value.length - 1)"
                            @click="tlOnAdd(variable, vIndex)">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </td>
        </tr>
    </table>
</template>
<template
        v-if="variable.type == '<?= SysPageVariable::TYPE_TEXT_LIST ?>' && !variable.value.length">
    <small class="text-muted">Clique no botão [+] para adicionar!</small>
</template>