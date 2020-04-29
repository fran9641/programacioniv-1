var appcliente = new Vue({
            el: '#frm-clientes',
            data: {
                clientes: {
                    idCliente: 0,
                    accion: 'nuevo',
                    nombre: '',
                    direccion: '',
                    telefono: '',
                    dui: '',
                    msg: ''
                }
},
 methods: {
 guardarClientes: function () {
     fetch(`private/modulos/clientes/procesos.php?proceso=recibirDatos&clientes=${JSON.stringify(this.clientes)}`).then(resp => resp.json()).then(resp => {
         this.clientes.msg = resp.msg;
         this.clientes.idCliente = 0;
         this.clientes.nombre = '';
         this.clientes.direccion = '';
         this.clientes.telefono = '';
         this.clientes.dui = '';
         this.clientes.accion = 'nuevo';
         appBuscarClientes.buscarCliente();
     });
 }
 }
 });