var appBuscarPeliculas = new Vue({
    el:'#frm-buscar-peliculas',
    data:{
        mispeliculas:[],
        valor:''
    },
    methods:{
        buscarPelicula:function(){
            fetch(`private/modulos/peliculas/procesos.php?proceso=buscarPelicula&pelicula=${this.valor}`).then(resp=>resp.json()).then(resp=>{
                this.misdocentes = resp;
            });
        },
        modificarDocente:function(docente){
            appdocente.docente = docente;
            appdocente.docente.accion = 'modificar';
        },
        eliminarDocente:function(idDocente){
            fetch(`private/modulos/peliculas/procesos.php?proceso=eliminarPelicula&pelicula=${idPelicula}`).then(resp=>resp.json()).then(resp=>{
                this.buscarPelicula();
            });
        }
    },
    created:function(){
        this.buscarPelicula();
    }
});