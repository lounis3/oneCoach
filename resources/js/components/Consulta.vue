<template>
    <div>
        <h1 class="text-center">Gestión Consultas</h1>
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
                                <label>Fecha: <input v-model="consulta.fecha" type="date" name="fecha"
                                                   placeholder="Introduzca la fecha de la consulta"
                                                    class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.fecha">{{ errores.fecha[0] }}</span></label><br/>
                                <label>Jugador: <input v-model="consulta.jugador" type="integer" name="jugador"
                                                      placeholder="Introduzca el nombre del jugador que recibira la consulta"
                                                      class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.jugador">{{ errores.jugador[0] }}</span></label><br/>
                                <label>Medico: <input v-model="consulta.medico" type="integer" name="medico"
                                                         placeholder="Introduzca el medico que va a realizar la consulta"
                                                         class="my-1">
                                    <span class="text-danger" v-if="errores.medico">{{ errores.medico[0] }}</span></label><br/>
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
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Fecha</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Jugador</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Medico</th>
                    <th scope="col" colspan="2" class="p-1 border-r cursor-pointer text-sm font-thin text-gray-500">
                        Acción
                    </th>

                </tr>
                </thead>
                <tbody>
                <tr class="bg-gray-50 text-center" v-for="con in consultas" :key="con.id">
                    <th scope="row">{{ con.id }}</th>
                    <td class="p-2 border-r text-center">{{ con.fecha }}</td>
                    <td class="p-2 border-r text-center">{{ con.jugador }}</td>
                    <td class="p-2 border-r text-center">{{ con.medico }}</td>
                    <td>
                        <button @click="modificar=true; abrirModal(con);" class="btn btn-warning">Editar</button>
                    </td>
                    <td>
                        <button @click="eliminar(con.id)" class="btn btn-danger">Eliminar</button>

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "Consulta.vue",
    data() {
        return {
            consultas: [],
            consulta: {
                fecha: '',
                jugador: '',
                medico: ''
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
            let res = await axios.get('/consultas');
            this.consultas = res.data;
        },
        async eliminar(id) {
            let res = await axios.delete('/consultas/' + id);
            this.listar();
        },
        async guardar() {
            try {
                if (this.modificar) {
                    let res = await axios.put('/consultas/' + this.id, this.consulta);
                } else {
                    let res = await axios.post('/consultas', this.consulta);
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
                this.tituloModal = "Modificar Consulta";
                this.consulta.fecha = data.fecha;
                this.consulta.jugador = data.jugador;
                this.consulta.medico = data.medico;
            } else {
                this.id = 0;
                this.tituloModal = "Crear Consulta";
                this.consulta.fecha = '';
                this.consulta.jugador = '';
                this.consulta.medico = '';
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

