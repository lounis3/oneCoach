<template>
    <div>
        <h1 class="text-center">Gestión Entrenadores</h1>
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
                                <label>DNI: <input v-model="entrenadore.dni" type="text" name="dni"
                                                            placeholder="Introduzca su DNI"
                                                            pattern="[0-9]{8}[A-Za-z]{1}" class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.dni">{{ errores.dni[0] }}</span></label><br/>
                                <label>Nombre: <input v-model="entrenadore.nombre" type="text" name="nombre"
                                                      placeholder="Introduzca el nombre del entrenador"
                                                      class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.nombre">{{ errores.nombre[0] }}</span></label><br/>
                                <label>Apellidos: <input v-model="entrenadore.apellidos" type="text" name="apellidos"
                                                         placeholder="Introduzca los/el apellido/s del entrenador"
                                                         class="my-1">
                                    <span class="text-danger" v-if="errores.apellidos">{{ errores.apellidos[0] }}</span></label><br/>
                                <label>Puesto: <input v-model="entrenadore.puesto" type="text" name="puesto"
                                                    placeholder="Introduzca el puesto del entrenador"
                                                    class="my-1">
                                    <span class="text-danger" v-if="errores.puesto">{{ errores.puesto[0] }}</span></label><br/>
                                <label>Equipo: <input v-model="entrenadore.equipo" type="integer" name="equipo"
                                                      placeholder="Introduzca el equipo del entrenador"
                                                      class="my-1">
                                    <span class="text-danger" v-if="errores.equipo">{{ errores.equipo[0] }}</span></label><br/>
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
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">DNI</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Nombre</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Apellidos</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Puesto</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Equipo</th>
                    <th scope="col" colspan="2" class="p-1 border-r cursor-pointer text-sm font-thin text-gray-500">
                        Acción
                    </th>

                </tr>
                </thead>
                <tbody>
                <tr class="bg-gray-50 text-center" v-for="ent in entrenadores" :key="ent.id">
                    <th scope="row">{{ ent.id }}</th>
                    <td class="p-2 border-r text-center">{{ ent.dni }}</td>
                    <td class="p-2 border-r text-center">{{ ent.nombre }}</td>
                    <td class="p-2 border-r text-center">{{ ent.apellidos }}</td>
                    <td class="p-2 border-r text-center">{{ ent.puesto }}</td>
                    <td class="p-2 border-r text-center">{{ ent.equipo }}</td>
                    <td>
                        <button @click="modificar=true; abrirModal(ent);" class="btn btn-warning">Editar</button>
                    </td>
                    <td>
                        <button @click="eliminar(ent.id)" class="btn btn-danger">Eliminar</button>

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "Entrenador.vue",
    data() {
        return {
            entrenadores: [],
            entrenadore: {
                dni: '',
                nombre: '',
                apellidos: '',
                puesto: '',
                equipo: ''
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
            let res = await axios.get('/entrenadores');
            this.entrenadores = res.data;
        },
        async eliminar(id) {
            let res = await axios.delete('/entrenadores/' + id);
            this.listar();
        },
        async guardar() {
            try {
                if (this.modificar) {
                    let res = await axios.put('/entrenadores/' + this.id, this.entrenadore);
                } else {
                    let res = await axios.post('/entrenadores', this.entrenadore);
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
                this.tituloModal = "Modificar Entrenador";
                this.entrenadore.dni = data.dni;
                this.entrenadore.nombre = data.nombre;
                this.entrenadore.apellidos = data.apellidos;
                this.entrenadore.puesto = data.puesto;
                this.entrenadore.equipo = data.equipo;
            } else {
                this.id = 0;
                this.tituloModal = "Crear Entrenador";
                this.entrenadore.dni = '';
                this.entrenadore.nombre = '';
                this.entrenadore.apellidos = '';
                this.entrenadore.puesto = '';
                this.entrenadore.equipo = '';
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
