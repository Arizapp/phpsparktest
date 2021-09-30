new Vue({
    el: '#TrabalheForm',
    data: {
        headers: {'X-CSRF-TOKEN': '<?= csrf_hash() ?>'},
        form: {
            seu_nome: '',
            seu_contato: '',
            amigo_nome: '',
            amigo_contato: '',
            mensagem: '',
        },
        errors: {
            seu_nome: false,
            seu_contato: false,
            amigo_nome: false,
            amigo_contato: false,
            mensagem: false,
        },
        hasError: false,
        pristine: true
    },
    watch: {
        form: {
            handler(val) {
                if (this.pristine) return;

                this.errors.seu_nome = !val.nome;
                this.errors.seu_contato = !val.telefone;
                this.errors.amigo_nome = !val.amigo_nome;
                this.errors.amigo_contato = !val.amigo_contato;
                this.errors.mensagem = !val.mensagem;
            },
            deep: true
        }
    },
    methods: {
        reset: function () {
            this.errors.seu_nome = false;
            this.errors.seu_contato = false;
            this.errors.amigo_nome = false;
            this.errors.amigo_contato = false;
            this.errors.mensagem = false;
            this.hasError = false;
        },
        checkForm: function (e) {
            this.pristine = false;
            this.errors.seu_nome = !this.form.seu_nome;
            this.errors.seu_contato = !this.form.seu_contato;
            this.errors.amigo_nome = !this.form.amigo_nome;
            this.errors.amigo_contato = !this.form.amigo_contato;
            this.errors.mensagem = !this.form.mensagem;
            this.hasError = this.errors.seu_nome
                || this.errors.seu_contato
                || this.errors.amigo_nome
                || this.errors.amigo_contato
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
                url: '<?= site_url('indique/enviar'); ?>',
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