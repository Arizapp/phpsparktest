new Vue({
    el: '#ContatoForm',
    data: {
        headers: {'X-CSRF-TOKEN': '<?= csrf_hash() ?>'},
        form: {
            nome: '',
            telefone: '',
            email: '',
            assunto: '',
            mensagem: '',
        },
        errors: {
            nome: false,
            telefone: false,
            email: false,
            assunto: false,
            mensagem: false,
        },
        hasError: false,
        pristine: true
    },
    watch: {
        form: {
            handler(val) {
                if (this.pristine) return;

                this.errors.nome = !val.nome;
                this.errors.telefone = !val.telefone;
                this.errors.email = !val.email;
                this.errors.assunto = !val.assunto;
                this.errors.mensagem = !val.mensagem;
            },
            deep: true
        }
    },
    methods: {
        reset: function () {
            this.errors.nome = false;
            this.errors.telefone = false;
            this.errors.email = false;
            this.errors.assunto = false;
            this.errors.mensagem = false;
            this.hasError = false;
        },
        checkForm: function (e) {
            this.pristine = false;
            this.errors.nome = !this.form.nome;
            this.errors.telefone = !this.form.telefone;
            this.errors.email = !this.form.email;
            this.errors.assunto = !this.form.assunto;
            this.errors.mensagem = !this.form.mensagem;
            this.hasError = this.errors.nome
                || this.errors.telefone
                || this.errors.email
                || this.errors.assunto
                || this.errors.mensagem;

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
                url: '<?= site_url('contato/enviar'); ?>',
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
                console.log(response);
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