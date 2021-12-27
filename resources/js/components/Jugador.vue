<template>
    <div>
        <h1 class="text-center">Gestión Jugadores</h1>
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
                                <label>Código Ficha: <input v-model="jugador.cod_ficha" type="text" name="dni"
                                                            placeholder="Introduzca su DNI"
                                                            pattern="[0-9]{8}[A-Za-z]{1}" class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.cod_ficha">{{ errores.cod_ficha[0] }}</span></label><br/>
                                <label>Nombre: <input v-model="jugador.nombre" type="text" name="nombre"
                                                      placeholder="Introduzca el nombre del jugador"
                                                      class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.nombre">{{ errores.nombre[0] }}</span></label><br/>
                                <label>Apellidos: <input v-model="jugador.apellidos" type="text" name="apellidos"
                                                         placeholder="Introduzca los/el apellido/s del jugador"
                                                         class="my-1">
                                    <span class="text-danger" v-if="errores.apellidos">{{ errores.apellidos[0] }}</span></label><br/>
                                <label>Edad: <input v-model="jugador.edad" type="integer" name="edad"
                                                    placeholder="Introduzca la edad del jugador"
                                                    class="my-1">
                                    <span class="text-danger" v-if="errores.edad">{{ errores.edad[0] }}</span></label><br/>
                                <label>Dorsal: <input v-model="jugador.dorsal" type="integer" name="dorsal"
                                                      placeholder="Introduzca el dorsal del jugador" class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.dorsal">{{ errores.dorsal[0] }}</span></label><br/>
                                <label>Posicion: <input v-model="jugador.posicion" type="text" name="posicion"
                                                        placeholder="Introduzca la posición del jugador" class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.posicion">{{ errores.posicion[0] }}</span></label><br/>
                                <label>pie_dominante: <input v-model="jugador.pie_dominante" type="text" name="pie_dominante"
                                                             placeholder="Introduzca el pie dominante del jugador" class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.pie_dominante">{{ errores.pie_dominante[0] }}</span></label><br/>
                                <label>Altura: <input v-model="jugador.altura" type="integer" name="altura"
                                                      placeholder="Introduzca la altura del jugador" class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.altura">{{ errores.altura[0] }}</span></label><br/>
                                <label>Peso: <input v-model="jugador.peso" type="decimal" name="peso"
                                                    placeholder="Introduzca el peso del jugador" class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.peso">{{ errores.peso[0] }}</span></label><br/>
                                <label>Estado Contractual: <input v-model="jugador.est_contrato" type="date" name="est_contrato"
                                                                  placeholder="Introduzca el eatado del contrato del jugador" class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.est_contrato">{{ errores.est_contrato[0] }}</span></label><br/>
                                <label>Salario: <input v-model="jugador.salario" type="integer" name="salario"
                                                       placeholder="Introduzca el salario del jugador" class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.salario">{{ errores.salario[0] }}</span></label><br/>


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
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Cod Ficha</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Nombre</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Apellidos</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Edad</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Dorsal</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Posición</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Pie Dominante</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Altura</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Peso</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Estado Contractual</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Salario</th>
                    <th scope="col" colspan="2" class="p-1 border-r cursor-pointer text-sm font-thin text-gray-500">
                        Acción
                    </th>

                </tr>
                </thead>
                <tbody>
                <tr class="bg-gray-50 text-center" v-for="jug in jugadors" :key="jug.id">
                    <th scope="row">{{ jug.id }}</th>
                    <td class="p-2 border-r text-center">{{ jug.cod_ficha }}</td>
                    <td class="p-2 border-r text-center">{{ jug.nombre }}</td>
                    <td class="p-2 border-r text-center">{{ jug.apellidos }}</td>
                    <td class="p-2 border-r text-center">{{ jug.edad }}</td>
                    <td class="p-2 border-r text-center">{{ jug.dorsal }}</td>
                    <td class="p-2 border-r text-center">{{ jug.posicion }}</td>
                    <td class="p-2 border-r text-center">{{ jug.pie_dominante }}</td>
                    <td class="p-2 border-r text-center">{{ jug.altura }}</td>
                    <td class="p-2 border-r text-center">{{ jug.peso }}</td>
                    <td class="p-2 border-r text-center">{{ jug.est_contrato }}</td>
                    <td class="p-2 border-r text-center">{{ jug.salario }}</td>
                    <td>
                        <button @click="modificar=true; abrirModal(jug);" class="btn btn-warning">Editar</button>
                    </td>
                    <td>
                        <button @click="eliminar(jug.id)" class="btn btn-danger">Eliminar</button>

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "Jugador.vue",
    data() {
        return {
            jugadors: [],
            jugador: {
                cod_ficha: '',
                nombre: '',
                apellidos: '',
                edad: '',
                dorsal: '',
                posicion: '',
                pie_dominante: '',
                altura: '',
                peso: '',
                est_contrato: '',
                salario: ''
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
            let res = await axios.get('/jugadors');
            this.jugadors = res.data;
        },
        async eliminar(id) {
            let res = await axios.delete('/jugadors/' + id);
            this.listar();
        },
        async guardar() {
            try {
                if (this.modificar) {
                    let res = await axios.put('/jugadors/' + this.id, this.jugador);
                } else {
                    let res = await axios.post('/jugadors', this.jugador);
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
                this.tituloModal = "Modificar Jugador";
                this.jugador.cod_ficha = data.cod_ficha;
                this.jugador.nombre = data.nombre;
                this.jugador.apellidos = data.apellidos;
                this.jugador.edad = data.edad;
                this.jugador.dorsal = data.dorsal;
                this.jugador.posicion = data.posicion;
                this.jugador.pie_dominante = data.pie_dominante;
                this.jugador.altura = data.altura;
                this.jugador.peso = data.peso;
                this.jugador.est_contrato = data.est_contrato;
                this.jugador.salario = data.salario;
            } else {
                this.id = 0;
                this.tituloModal = "Crear Jugador";
                this.jugador.cod_ficha = '';
                this.jugador.nombre = '';
                this.jugador.apellidos = '';
                this.jugador.edad = '';
                this.jugador.dorsal = '';
                this.jugador.posicion = '';
                this.jugador.pie_dominante = '';
                this.jugador.altura = '';
                this.jugador.peso = '';
                this.jugador.est_contrato = '';
                this.jugador.salario = '';
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
