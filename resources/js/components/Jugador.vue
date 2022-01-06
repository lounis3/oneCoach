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
                                <label>Cod Ficha: <input v-model="jugadore.cod_ficha" type="text" name="cod_ficha"
                                                    class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.cod_ficha">{{ errores.cod_ficha[0] }}</span></label><br/>
                                <label>Nombre: <input v-model="jugadore.nombre" type="text" name="nombre"
                                                      placeholder="Introduzca el nombre del jugador"
                                                      class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.nombre">{{ errores.nombre[0] }}</span></label><br/>
                                <label>Apellidos: <input v-model="jugadore.apellidos" type="text" name="apellidos"
                                                         placeholder="Introduzca los/el apellido/s del jugador"
                                                         class="my-1">
                                    <span class="text-danger" v-if="errores.apellidos">{{ errores.apellidos[0] }}</span></label><br/>
                                <label>Edad: <input v-model="jugadore.edad" type="integer" name="edad"
                                                      placeholder="Introduzca la edad del jugador"
                                                      class="my-1">
                                    <span class="text-danger" v-if="errores.edad">{{ errores.edad[0] }}</span></label><br/>
                                <label>Dorsal: <input v-model="jugadore.dorsal" type="integer" name="dorsal"
                                                      placeholder="Introduzca el dorsal del jugador"
                                                      class="my-1">
                                    <span class="text-danger" v-if="errores.dorsal">{{ errores.dorsal[0] }}</span></label><br/>
                                <label>Posición: <input v-model="jugadore.posicion" type="text" name="posicion"
                                                      placeholder="Introduzca la posición del jugador"
                                                      class="my-1">
                                    <span class="text-danger" v-if="errores.posicion">{{ errores.posicion[0] }}</span></label><br/>
                                <label>Pie Dominante: <input v-model="jugadore.pie_dominante" type="text" name="pie_dominante"
                                                        placeholder="Introduzca el pie dominante del jugador"
                                                        class="my-1">
                                    <span class="text-danger" v-if="errores.pie_dominante">{{ errores.pie_dominante[0] }}</span></label><br/>
                                <label>Altura: <input v-model="jugadore.altura" type="integer" name="altura"
                                                        placeholder="Introduzca la altura del jugador"
                                                        class="my-1">
                                    <span class="text-danger" v-if="errores.altura">{{ errores.altura[0] }}</span></label><br/>
                                <label>Peso: <input v-model="jugadore.peso" type="decimal" name="peso"
                                                        placeholder="Introduzca el peso del jugador"
                                                        class="my-1">
                                    <span class="text-danger" v-if="errores.peso">{{ errores.peso[0] }}</span></label><br/>
                                <label>Estado Contrato: <input v-model="jugadore.est_contrato" type="date" name="est_contrato"
                                                        placeholder="Introduzca la fecha de finalizacion del contrato del jugador"
                                                        class="my-1">
                                    <span class="text-danger" v-if="errores.est_contrato">{{ errores.est_contrato[0] }}</span></label><br/>
                                <label>Salario: <input v-model="jugadore.salario" type="integer" name="salario"
                                                        placeholder="Introduzca el salario del jugador"
                                                        class="my-1">
                                    <span class="text-danger" v-if="errores.salario">{{ errores.salario[0] }}</span></label><br/>
                                <label>Equipo: <input v-model="jugadore.equipo" type="integer" name="equipo"
                                                        placeholder="Introduzca el codigo del equipo del jugador"
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
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Cod ficha</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Nombre</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Apellidos</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Edad</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Dorsal</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Posición</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Pie Dominante</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Altura</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Peso</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Estado Contrato</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Salario</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Equipo</th>
                    <th scope="col" colspan="2" class="p-1 border-r cursor-pointer text-sm font-thin text-gray-500">
                        Acción
                    </th>

                </tr>
                </thead>
                <tbody>
                <tr class="bg-gray-50 text-center" v-for="jug in jugadores" :key="jug.id">
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
                    <td class="p-2 border-r text-center">{{ jug.equipo }}</td>
                    <td>
                        <button @click="modificar=true; abrirModal(jug);" class="btn btn-warning">Editar</button>
                    </td>
                    <td>
                        <button @click="eliminar(jug.id)" class="btn btn-danger">Eliminar</button>
                    </td>
                    <td>
                        <button @click="mostrarStats(jug.id)" class="btn btn-info">Estadisticas</button>
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
            jugadores: [],
            jugadore: {
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
                salario: '',
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
            let res = await axios.get('/jugadores');
            this.jugadores = res.data;
        },
        async eliminar(id) {
            let res = await axios.delete('/jugadores/' + id);
            this.listar();
        },
        async guardar() {
            try {
                if (this.modificar) {
                    let res = await axios.put('/jugadores/' + this.id, this.jugadore);
                } else {
                    let res = await axios.post('/jugadores', this.jugadore);
                }
                this.cerrarModal();
                this.listar();
            } catch (error) {
                if (error.response.data) {
                    this.errores = error.response.data.errors;
                }
            }
        },
        async mostrarStats(id) {
            let res = await axios.get('/estadisticas/' + id);
            this.estadistica = res.data;
            },
        abrirModal(data = {}) {
            this.modal = 1;
            if (this.modificar) {
                this.id = data.id;
                this.tituloModal = "Modificar Jugador";
                this.jugadore.cod_ficha = data.cod_ficha;
                this.jugadore.nombre = data.nombre;
                this.jugadore.apellidos = data.apellidos;
                this.jugadore.edad = data.edad;
                this.jugadore.dorsal = data.dorsal;
                this.jugadore.posicion = data.posicion;
                this.jugadore.pie_dominante = data.pie_dominante;
                this.jugadore.altura = data.altura;
                this.jugadore.peso = data.peso;
                this.jugadore.est_contrato = data.est_contrato;
                this.jugadore.salario = data.salario;
                this.jugadore.equipo = data.equipo;
            } else {
                this.id = 0;
                this.tituloModal = "Crear Jugador";
                this.jugadore.cod_ficha = '';
                this.jugadore.nombre = '';
                this.jugadore.apellidos = '';
                this.jugadore.edad = '';
                this.jugadore.dorsal = '';
                this.jugadore.posicion = '';
                this.jugadore.pie_dominante = '';
                this.jugadore.altura = '';
                this.jugadore.peso = '';
                this.jugadore.est_contrato = '';
                this.jugadore.salario = '';
                this.jugadore.equipo = '';
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
