const ActivateMasks = function () {
    $('.mask-cep').mask('00000-000');
    $('.mask-cpf').mask('000.000.000-00', {reverse: true});
    $('.mask-cnpj').mask('00.000.000/0000-00', {reverse: true});
    $('.mask-numbers').mask('0#');
    const MaskPhone = {
        behavior: (val) => {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        options: {
            onKeyPress: function (val, e, field, options) {
                field.mask(MaskPhone.behavior.apply({}, arguments), options);
            }
        }
    };
    $('.mask-phone').mask(MaskPhone.behavior, MaskPhone.options);
    $('.mask-money').mask("#.##0,00", {reverse: true});
};

$(() => {
    ActivateMasks();
});