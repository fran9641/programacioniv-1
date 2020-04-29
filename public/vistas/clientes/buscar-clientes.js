var appBuscarClientes = new Vue({
    el: '#frm-buscar-clientes',
    data: {
        misclientes: [],
        valor: ''
    },
    methods: {
        buscarCliente: function () {
            fetch(`private/modulos/clientes/procesos.php?proceso=buscarCliente&clientes=${this.valor}`).then(resp => resp.json()).then(resp => {
                this.misclientes = resp;
            });
        },
        modificarCliente: function (clientes) {
            appcliente.clientes = clientes;
            appcliente.clientes.accion = 'modificar';
        },
        eliminarCliente: function (idCliente) {
            var confirmacion = confirm("¿estas seguro de eliminar el registro?..");
            if (confirmacion) {
                alert(" El registro se elimino corretamente....");
                fetch(`private/modulos/clientes/procesos.php?proceso=eliminarCliente&clientes=${idCliente}`).then(resp => resp.json()).then(resp => {
                    this.buscarCliente();
                });
            }
        }
    },
    created: function () {
        this.buscarCliente();
    }
});