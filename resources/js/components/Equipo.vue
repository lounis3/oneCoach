<template>
    <div>
        <h1 class="text-center">Equipos</h1>
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
                                <label>Cod Equipo: <input v-model="equipo.cod_equipo" type="text" name="cod_equipo"
                                                   placeholder="Introduzca el codigo del equipo"
                                                   class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.cod_equipo">{{ errores.cod_equipo[0] }}</span></label><br/>
                                <label>Nombre: <input v-model="equipo.nombre" type="text" name="nombre"
                                                      placeholder="Introduzca el nombre del equipo"
                                                      class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.nombre">{{ errores.nombre[0] }}</span></label><br/>
                                <label>Ciudad: <input v-model="equipo.ciudad" type="text" name="ciudad"
                                                         placeholder="Introduzca la ciudad a la que pertenece"
                                                         class="my-1">
                                    <span class="text-danger" v-if="errores.ciudad">{{ errores.ciudad[0] }}</span></label><br/>
                                <label>Presupuesto: <input v-model="equipo.presupuesto" type="integer" name="presupuesto"
                                                      placeholder="Introduzca el presupuesto del equipo"
                                                      class="my-1">
                                    <span class="text-danger" v-if="errores.presupuesto">{{ errores.presupuesto[0] }}</span></label><br/>
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
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Cod Equipo</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Nombre</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Ciudad</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Presupuesto</th>
                    <th scope="col" colspan="2" class="p-1 border-r cursor-pointer text-sm font-thin text-gray-500">
                        Acción
                    </th>

                </tr>
                </thead>
                <tbody>
                <tr class="bg-gray-50 text-center" v-for="eqp in equipos" :key="eqp.id">
                    <th scope="row">{{ eqp.id }}</th>
                    <td class="p-2 border-r text-center">{{ eqp.cod_equipo }}</td>
                    <td class="p-2 border-r text-center">{{ eqp.nombre }}</td>
                    <td class="p-2 border-r text-center">{{ eqp.ciudad }}</td>
                    <td class="p-2 border-r text-center">{{ eqp.presupuesto }}</td>
                    <td>
                        <button @click="modificar=true; abrirModal(eqp);" class="btn btn-warning">Editar</button>
                    </td>
                    <td>
                        <button @click="eliminar(eqp.id)" class="btn btn-danger">Eliminar</button>

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "Equipo.vue",
    data() {
        return {
            equipos: [],
            equipo: {
                cod_equipo: '',
                nombre: '',
                ciudad: '',
                presupuesto: ''
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
            let res = await axios.get('/equipos');
            this.equipos = res.data;
        },
        async eliminar(id) {
            let res = await axios.delete('/equipos/' + id);
            this.listar();
        },
        async guardar() {
            try {
                if (this.modificar) {
                    let res = await axios.put('/equipos/' + this.id, this.equipo);
                } else {
                    let res = await axios.post('/equipos', this.equipo);
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
                this.tituloModal = "Modificar Equipo";
                this.equipo.cod_equipo = data.cod_equipo;
                this.equipo.nombre = data.nombre;
                this.equipo.ciudad = data.ciudad;
                this.equipo.presupuesto = data.presupuesto;
            } else {
                this.id = 0;
                this.tituloModal = "Crear Equipo";
                this.equipo.cod_equipo = '';
                this.equipo.nombre = '';
                this.equipo.ciudad = '';
                this.equipo.presupuesto = '';
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

