<template>
    <div>
        <h1 class="text-center">Gestión Estadisticas</h1>
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
                                <label>Partidos Jugados: <input v-model="estadistica.partidos_jug" type="integer" name="partidos_jug"
                                                   placeholder="Introduzca los partidos jugados por el jugador"
                                                    class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.partidos_jug">{{ errores.partidos_jug[0] }}</span></label><br/>
                                <label>Goles: <input v-model="estadistica.goles" type="integer" name="goles"
                                                      placeholder="Introduzca los del jugador"
                                                      class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.goles">{{ errores.goles[0] }}</span></label><br/>
                                <label>Asistencias: <input v-model="estadistica.asistencias" type="integer" name="asistencias"
                                                         placeholder="Introduzca las asistencias del jugador"
                                                         class="my-1">
                                    <span class="text-danger" v-if="errores.asistencias">{{ errores.asistencias[0] }}</span></label><br/>
                                <label>Ciclo Tarjetas: <input v-model="estadistica.ciclo_tarjetas" type="integer" name="ciclo_tarjetas"
                                                      placeholder="Introduzca el puesto del entrenador"
                                                      class="my-1">
                                    <span class="text-danger" v-if="errores.ciclo_tarjetas">{{ errores.ciclo_tarjetas[0] }}</span></label><br/>
                                <label>Jugador: <input v-model="estadistica.jugadors" type="integer" name="jugador"
                                                      placeholder="Introduzca el jugador al que pertenecen las estadisticas"
                                                      class="my-1">
                                    <span class="text-danger" v-if="errores.jugadors">{{ errores.jugadors[0] }}</span></label><br/>
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
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Partidos jugados</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Goles</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Asistencias</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Ciclo Tarjetas</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Jugador</th>
                    <th scope="col" colspan="2" class="p-1 border-r cursor-pointer text-sm font-thin text-gray-500">
                        Acción
                    </th>

                </tr>
                </thead>
                <tbody>
                <tr class="bg-gray-50 text-center" v-for="est in estadisticas" :key="est.id">
                    <th scope="row">{{ est.id }}</th>
                    <td class="p-2 border-r text-center">{{ est.partidos_jug }}</td>
                    <td class="p-2 border-r text-center">{{ est.goles }}</td>
                    <td class="p-2 border-r text-center">{{ est.asistencias }}</td>
                    <td class="p-2 border-r text-center">{{ est.ciclo_tarjetas }}</td>
                    <td class="p-2 border-r text-center">{{ est.jugadors }}</td>
                    <td>
                        <button @click="modificar=true; abrirModal(est);" class="btn btn-warning">Editar</button>
                    </td>
                    <td>
                        <button @click="eliminar(est.id)" class="btn btn-danger">Eliminar</button>

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "Estadistica.vue",
    data() {
        return {
            estadisticas: [],
            estadistica: {
                partidos_jug: '',
                goles: '',
                asistencias: '',
                ciclo_tarjetas: '',
                jugadors: ''
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
            let res = await axios.get('/estadisticas');
            this.estadisticas = res.data;
        },
        async eliminar(id) {
            let res = await axios.delete('/estadisticas/' + id);
            this.listar();
        },
        async guardar() {
            try {
                if (this.modificar) {
                    let res = await axios.put('/estadisticas/' + this.id, this.estadistica);
                } else {
                    let res = await axios.post('/estadisticas', this.estadistica);
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
                this.tituloModal = "Modificar Estadisticas";
                this.estadistica.partidos_jug = data.partidos_jug;
                this.estadistica.goles = data.goles;
                this.estadistica.asistencias = data.asistencias;
                this.estadistica.ciclo_tarjetas = data.ciclo_tarjetas;
                this.estadistica.jugadors = data.jugadors;
            } else {
                this.id = 0;
                this.tituloModal = "Crear Hoja Estadisticas";
                this.estadistica.partidos_jug = '';
                this.estadistica.goles = '';
                this.estadistica.asistencias = '';
                this.estadistica.ciclo_tarjetas = '';
                this.estadistica.jugadors = '';
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

