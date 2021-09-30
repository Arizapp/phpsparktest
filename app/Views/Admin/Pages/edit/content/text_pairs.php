<?php

use App\Entities\SysPageVariable;

?>
<template
        v-if="variable.type == '<?= SysPageVariable::TYPE_TEXT_PAIRS ?>' && variable.value.length">
    <table v-for="(item, tpIndex) in variable.value"
           v-show="item.action != 'delete' && !hidden.includes(vIndex)"
           class="text-pairs w-100 mb-3">
        </tr>
        <tr>
            <td class="p-0">
                <input type="hidden" :name="'variables[' + vIndex + '][value][' + tpIndex + '][id]'"
                       v-model="item.id">
                <input type="hidden"
                       :name="'variables[' + vIndex + '][value][' + tpIndex + '][sys_page_variable_id]'"
                       v-model="item.sys_page_variable_id">
                <input type="hidden"
                       :name="'variables[' + vIndex + '][value][' + tpIndex + '][order]'"
                       v-model="item.order">
                <input type="hidden"
                       :name="'variables[' + vIndex + '][value][' + tpIndex + '][action]'"
                       v-model="item.action">
                <div class="input-group input-tp-title">
                    <div class="input-group-prepend">
                        <div class="input-group-text bg-gray-light">{{ tpIndex + 1 }}</div>
                    </div>
                    <input type="text" class="form-control"
                           :name="'variables[' + vIndex + '][value][' + tpIndex + '][title]'"
                           v-model="item.title">
                </div>
                <div class="input-tp-text shadow">
                                        <textarea class="form-control" rows="4"
                                                  :name="'variables[' + vIndex + '][value][' + tpIndex + '][text]'"
                                                  v-model="item.text"></textarea>
                </div>
            </td>
            <td width="1" class="py-0 pr-0">
                <div class="btn-group-vertical">
                    <button type="button"
                            class="btn btn-sm btn-outline-gray-medium text-gray-medium-dark"
                            v-if="tpIndex > 0"
                            @click="tpOnUp(variable.value, tpIndex)">
                        <i class="fas fa-arrow-up"></i>
                    </button>
                    <button type="button"
                            class="btn btn-sm btn-outline-gray-medium text-gray-medium-dark"
                            @click="tpOnDelete(variable.value, vIndex, tpIndex)">
                        <i class="far fa-trash-alt"></i>
                    </button>
                    <button type="button"
                            class="btn btn-sm btn-outline-gray-medium text-gray-medium-dark"
                            v-if="tpIndex < (variable.value.length - 1)"
                            @click="tpOnDown(variable.value, tpIndex)">
                        <i class="fas fa-arrow-down"></i>
                    </button>
                    <button type="button"
                            class="btn btn-sm btn-outline-gray-medium text-gray"
                            v-if="tpIndex == (variable.value.length - 1)"
                            @click="tpOnAdd(variable, vIndex)">
                        <i class="fas fa-plus"></i>
                    </button>
                </div>
            </td>
        </tr>
    </table>
</template>
<template
        v-if="variable.type == '<?= SysPageVariable::TYPE_TEXT_PAIRS ?>' && !variable.value.length">
    <small class="text-muted">Clique no botão [+] para adicionar!</small>
</template>