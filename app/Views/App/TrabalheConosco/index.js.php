new Vue({
    el: '#TrabalheForm',
    data: {
        headers: {'X-CSRF-TOKEN': '<?= csrf_hash() ?>'},
        form: {
            nome: '',
            cpf: '',
            telefone: '',
            whatsapp: '',
            creci: '',
            cidade: '',
            email: '',
            senha: '',
            senha2: '',
        },
        errors: {
            nome: false,
            cpf: false,
            telefone: false,
            whatsapp: false,
            creci: false,
            cidade: false,
            email: false,
            senha: false,
            senha2: false,
        },
        hasError: false,
        pristine: true
    },
    watch: {
        form: {
            handler(val) {
                if (this.pristine) return;

                this.errors.nome = !val.nome;
                this.errors.cpf = !val.cpf;
                this.errors.telefone = !val.telefone;
                this.errors.whatsapp = !val.whatsapp;
                this.errors.creci = !val.creci;
                this.errors.cidade = !val.cidade;
                this.errors.email = !val.email;
                this.errors.senha = !val.senha;
                this.errors.senha2 = !val.senha2;
            },
            deep: true
        }
    },
    methods: {
        reset: function () {
            this.errors.nome = false;
            this.errors.cpf = false;
            this.errors.telefone = false;
            this.errors.whatsapp = false;
            this.errors.creci = false;
            this.errors.cidade = false;
            this.errors.email = false;
            this.errors.senha = false;
            this.errors.senha2 = false;
            this.hasError = false;
        },
        checkForm: function (e) {
            this.pristine = false;
            this.errors.nome = !this.form.nome;
            this.errors.cpf = !this.form.cpf;
            this.errors.telefone = !this.form.telefone;
            this.errors.whatsapp = !this.form.whatsapp;
            this.errors.creci = !this.form.creci;
            this.errors.cidade = !this.form.cidade;
            this.errors.email = !this.form.email;
            this.errors.senha = !this.form.senha;
            this.errors.senha2 = !this.form.senha2;
            this.hasError = this.errors.nome
                || this.errors.cpf
                || this.errors.telefone
                || this.errors.whatsapp
                || this.errors.creci
                || this.errors.cidade
                || this.errors.email
                || this.errors.senha
                || this.errors.senha2;

            if (!this.hasError) {
                this.send();
            }

            e.preventDefault();
        },
        send: function () {
            Swal.fire({
                title: 'Aguarde!',
                text: 'Enviando mensagem...',
                icon: 'info',
                confirmButtonText: 'Cool'
            });
            $.ajax({
                url: '<?= site_url('trabalhe-conosco/enviar'); ?>',
                type: 'POST',
                data: this.form,
                headers: this.headers,
                dataType: 'json'
            }).done((response) => {
                Swal.fire({
                    title: 'Sucesso!',
                    text: 'Sua mensagem foi enviada. Em breve entraremos em contato com você!',
                    icon: 'success'
                });
            }).fail((response) => {
                Swal.fire({
                    title: 'Erro!',
                    text: response.responseText,
                    icon: 'error'
                });
            }).always(() => {
                this.reset();
            });
        }
    }
});