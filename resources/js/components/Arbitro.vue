<template>
    <div>
        <h1 class="text-center">Gestión Árbitros</h1>
        <hr>

        <div class="container">

            <button @click="modificar=false, abrirModal();" type="button" class="btn btn-primary my-3">Nuevo</button>


            <div class="modal" :class="{mostrar:modal}">
                <div class="modal-dialog">


                    <div class="modal-content">
                        <div class="modal-header">
                            <button @click="cerrarModal();" type="button" class="close" data-dismiss="modal">&times;
                            </button>
                            <h4 class="modal-title">{{ tituloModal }}</h4>
                        </div>
                        <div class="modal-body">
                            <form>
                                <label>Cod Arbitro: <input v-model="arbitro.cod_arbitro" type="text" name="cod_arbitro"
                                                   placeholder="Introduzca el codigo del arbitro" class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.cod_arbitro">{{ errores.cod_arbitro[0] }}</span></label><br/>
                                <label>Nombre: <input v-model="arbitro.nombre" type="text" name="nombre"
                                                           placeholder="Introduzca el nombre del arbitro" class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.nombre">{{ errores.nombre[0] }}</span></label><br/>
                                <label>Apellidos: <input v-model="arbitro.apellidos" type="text" name="apellidos"
                                                           placeholder="Introduzca los apellidos del arbitro" class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.apellidos">{{ errores.apellidos[0] }}</span></label><br/>
                                <label>Partidos: <input v-model="arbitro.partido" type="text" name="partido"
                                                         placeholder="Introduzca el partido arbitrado" class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.partido">{{ errores.partido[0] }}</span></label><br/>

                                <br/>


                            </form>
                        </div>
                        <div class="modal-footer">
                            <button @click="cerrarModal();" type="button" class="btn btn-secondary"
                                    data-dismiss="modal">Cancelar
                            </button>
                            <button @click="guardar()" type="button" class="btn btn-success" data-dismiss="modal">
                                Guardar
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

        <div class="table w-full p-2">
            <table style="margin: 0 auto;" class="table-fixed table-striped">
                <thead>
                <tr class="bg-gray-50 border-b">
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">#</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Cod Arbitro</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Nombre</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Apellidos</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Partido</th>
                    <th scope="col" colspan="2" class="p-1 border-r cursor-pointer text-sm font-thin text-gray-500">
                        Acción
                    </th>

                </tr>
                </thead>
                <tbody>
                <tr class="bg-gray-50 text-center" v-for="arb in arbitros" :key="arb.id">
                    <th scope="row">{{ arb.id }}</th>
                    <td class="p-2 border-r text-center">{{ arb.cod_arbitro }}</td>
                    <td class="p-2 border-r text-center">{{ arb.nombre }}</td>
                    <td class="p-2 border-r text-center">{{ arb.apellidos }}</td>
                    <td class="p-2 border-r text-center">{{ arb.partido }}</td>
                    <td>
                        <button @click="modificar=true; abrirModal(arb);" class="btn btn-warning">Editar</button>
                    </td>
                    <td>
                        <button @click="eliminar(arb.id)" class="btn btn-danger">Eliminar</button>

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "Arbitro.vue",
    data() {
        return {
            arbitros: [],
            arbitro: {
                cod_arbitro: '',
                nombre: '',
                apellidos: '',
                partido: ''
            },
            id: 0,
            modificar: true,
            modal: 0,
            tituloModal: '',
            errores: [],
        }
    },
    methods: {
        async listar() {
            let res = await axios.get('/arbitros');
            this.arbitros = res.data;
        },
        async eliminar(id) {
            let res = await axios.delete('/arbitros/' + id);
            this.listar();
        },
        async guardar() {
            try {
                if (this.modificar) {
                    let res = await axios.put('/arbitros/' + this.id, this.arbitro);
                } else {
                    let res = await axios.post('/arbitros', this.arbitro);
                }
                this.cerrarModal();
                this.listar();
            } catch (error) {
                if (error.response.data) {
                    this.errores = error.response.data.errors;
                }
            }
        },
        abrirModal(data = {}) {
            this.modal = 1;
            if (this.modificar) {
                this.id = data.id;
                this.tituloModal = "Modificar Arbitro";
                this.arbitro.cod_arbitro = data.cod_arbitro;
                this.arbitro.nombre = data.nombre;
                this.arbitro.apellidos = data.apellidos;
                this.arbitro.partido = data.partido;
            } else {
                this.id = 0;
                this.tituloModal = "Crear Arbitro";
                this.arbitro.cod_arbitro = '';
                this.arbitro.nombre = '';
                this.arbitro.apellidos = '';
                this.arbitro.partido = '';
            }
        },
        cerrarModal() {
            this.modal = 0;
        }
    },
    created() {
        this.listar();
    },
}
</script>

<style>
.mostrar {
    display: list-item;
    opacity: 1;
    background: #2b3145;
}
</style>

