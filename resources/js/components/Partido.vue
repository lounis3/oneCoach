<template>
    <div>
        <h1 class="text-center">Gestión Partidos</h1>
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
                                <label>Fecha: <input v-model="partido.fecha" type="date" name="fecha"
                                                   placeholder="Introduzca la fecha del partido"
                                                    class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.fecha">{{ errores.fecha[0] }}</span></label><br/>
                                <label>Jornada: <input v-model="partido.jornada" type="integer" name="jornada"
                                                     placeholder="Introduzca la jornada celebracion del partido"
                                                      class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.jornada">{{ errores.jornada[0] }}</span></label><br/>
                                <label>Adversario: <input v-model="partido.adversario" type="text" name="adversario"
                                                       placeholder="Introduzca el adversario"
                                                       class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.adversario">{{ errores.adversario[0] }}</span></label><br/>
                                <label>Resultado: <input v-model="partido.resultado" type="text" name="resultado"
                                                       placeholder="Introduzca el resultado del partido"
                                                       class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.resultado">{{ errores.resultado[0] }}</span></label><br/>
                                <label>Estadio: <input v-model="partido.estadio" type="text" name="estadio"
                                                       placeholder="Introduzca el estadio donde se celebro el  partido"
                                                       class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.estadio">{{ errores.estadio[0] }}</span></label><br/>
                                <label>Equipo: <input v-model="partido.equipo" type="integer" name="equipo"
                                                       placeholder="Introduzca su equipo"
                                                       class="my-1">
                                    <span class="text-danger"
                                          v-if="errores.equipo">{{ errores.equipo[0] }}</span></label><br/>
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
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Jornada</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Adversario</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Resultado</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Estadio</th>
                    <th class="p-2 border-r cursor-pointer text-sm font-thin text-gray-500">Equipo</th>
                    <th scope="col" colspan="2" class="p-1 border-r cursor-pointer text-sm font-thin text-gray-500">
                        Acción
                    </th>

                </tr>
                </thead>
                <tbody>
                <tr class="bg-gray-50 text-center" v-for="par in partidos" :key="par.id">
                    <th scope="row">{{ par.id }}</th>
                    <td class="p-2 border-r text-center">{{ par.fecha }}</td>
                    <td class="p-2 border-r text-center">{{ par.jornada }}</td>
                    <td class="p-2 border-r text-center">{{ par.adversario }}</td>
                    <td class="p-2 border-r text-center">{{ par.resultado }}</td>
                    <td class="p-2 border-r text-center">{{ par.estadio }}</td>
                    <td class="p-2 border-r text-center">{{ par.equipo }}</td>
                    <td>
                        <button @click="modificar=true; abrirModal(par);" class="btn btn-warning">Editar</button>
                    </td>
                    <td>
                        <button @click="eliminar(par.id)" class="btn btn-danger">Eliminar</button>

                    </td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
export default {
    name: "Partido.vue",
    data() {
        return {
            partidos: [],
            partido: {
                fecha: '',
                jornada: '',
                adversario: '',
                resultado: '',
                estadio: '',
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
            let res = await axios.get('/partidos');
            this.partidos = res.data;
        },
        async eliminar(id) {
            let res = await axios.delete('/partidos/' + id);
            this.listar();
        },
        async guardar() {
            try {
                if (this.modificar) {
                    let res = await axios.put('/partidos/' + this.id, this.partido);
                } else {
                    let res = await axios.post('/partidos', this.partido);
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
                this.tituloModal = "Modificar Partido";
                this.partido.fecha = data.fecha;
                this.partido.jornada = data.jornada;
                this.partido.adversario = data.adversario;
                this.partido.resultado = data.resultado;
                this.partido.estadio = data.estadio;
                this.partido.equipo = data.equipo;
            } else {
                this.id = 0;
                this.tituloModal = "Crear Partido";
                this.partido.fecha = '';
                this.partido.jornada = '';
                this.partido.adversario = '';
                this.partido.resultado = '';
                this.partido.estadio = '';
                this.partido.equipo = '';}
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

