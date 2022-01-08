<template>
    <div>
        <h1 class="text-center">Hoja de Incidencias</h1>
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
                                <label>Tarjetas Amarillas: <input v-model="incidencia.tarjeta_amarilla" type="integer" name="tarjeta_amarilla"
                                                   placeholder="Introduzca el número de tarjetas amarillas mostradas"
                                                    class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.tarjeta_amarilla">{{ errores.tarjeta_amarilla[0] }}</span></label><br/>
                                <label>Tarjetas Rojas: <input v-model="incidencia.tarjeta_roja" type="integer" name="tarjeta_roja"
                                                      placeholder="Introduzca el número de tarjetas rojas mostradas"
                                                      class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.tarjeta_roja">{{ errores.tarjeta_roja[0] }}</span></label><br/>
                                <label>Gol: <input v-model="incidencia.gol" type="integer" name="goles"
                                                         placeholder="Introduzca el número de goles marcados"
                                                         class="my-1">
                                    <span class="text-danger" v-if="errores.gol">{{ errores.gol[0] }}</span></label><br/>
                                <label>Partido: <input v-model="incidencia.partido" type="integer" name="partido"
                                                      placeholder="Introduzca el partido"
                                                      class="my-1">
                                    <span class="text-danger" v-if="errores.partido">{{ errores.partido[0] }}</span></label><br/>



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
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Tarjetas Amarillas</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Tarjetas Rojas</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Goles</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Partido</th>
                    <th scope="col" colspan="2" class="p-1 border-r cursor-pointer text-sm font-thin text-gray-500">
                        Acción
                    </th>

                </tr>
                </thead>
                <tbody>
                <tr class="bg-gray-50 text-center" v-for="inc in incidencias" :key="inc.id">
                    <th scope="row">{{ inc.id }}</th>
                    <td class="p-2 border-r text-center">{{ inc.tarjeta_amarilla }}</td>
                    <td class="p-2 border-r text-center">{{ inc.tarjeta_roja}}</td>
                    <td class="p-2 border-r text-center">{{ inc.gol }}</td>
                    <td class="p-2 border-r text-center">{{ inc.partido }}</td>
                    <td>
                        <button @click="modificar=true; abrirModal(inc);" class="btn btn-warning">Editar</button>
                    </td>
                    <td>
                        <button @click="eliminar(inc.id)" class="btn btn-danger">Eliminar</button>

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "Incidencia.vue",
    data() {
        return {
            incidencias: [],
            incidencia: {
                tarjeta_amarilla: '',
                tarjeta_roja: '',
                gol: '',
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
            let res = await axios.get('/incidencias');
            this.incidencias = res.data;
        },
        async eliminar(id) {
            let res = await axios.delete('/incidencias/' + id);
            this.listar();
        },
        async guardar() {
            try {
                if (this.modificar) {
                    let res = await axios.put('/incidencias/' + this.id, this.incidencia);
                } else {
                    let res = await axios.post('/incidencias', this.incidencia);
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
                this.tituloModal = "Modificar Hoja de Incidencias";
                this.estadistica.tarjeta_amarilla = data.tarjeta_amarilla;
                this.estadistica.tarjeta_roja = data.tarjeta_roja;
                this.estadistica.gol = data.gol;
                this.estadistica.partido = data.partido;
            } else {
                this.id = 0;
                this.tituloModal = "Crear Hoja de Incidencias";
                this.estadistica.tarjeta_amarilla = '';
                this.estadistica.tarjeta_roja = '';
                this.estadistica.gol = '';
                this.estadistica.partido = '';
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

