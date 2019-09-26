<template>
    <div class="container">
    
    
    
        <div class="row justify-content-center">
    
    
    
            <div class="col-md-12">
    
    
    
                <div class="card">
    
    

    
    
    
                    <div class="card-body table-responsive p-0">
    
    
    
                        <div>
    
    
    
                            <vue-good-table :columns="columns" :rows="rows" :pagination-options="{
    
                                    enabled: true,
    
                                    mode: 'records',
    
                                    perPage: 10,
    
                                    position: 'top',
    
                                    perPageDropdown: [3, 7, 9, 15],
    
                                    dropdownAllowAll: false,
    
                                    setCurrentPage: 2,
    
                                    nextLabel: 'Siguiente',
    
                                    prevLabel: 'Antes',
    
                                    rowsPerPageLabel: 'Datos por pagina',
    
                                    ofLabel: 'de',
    
                                    pageLabel: 'page', // for 'pages' mode
    
                                    allLabel: 'All',                           
    
                                    }" :search-options="{
    
                                    enabled: true,
    
                                    skipDiacritics: true,
    
                                    placeholder: 'Buscar en la tabla',
                                    
                                    searchFn:filterPeoples
    
                                    }">
    
                                <template slot="table-row" slot-scope="props">
    
                                    <div v-if="props.column.field=='actions'">
    
                                      <a @click="editPeoples(props.row)" href="#"><i class="fas fa-edit"></i></a>     
    
                                      <a href="#" @click="deletePeoples(props.row.id)"><i class="fas fa-trash-alt"></i></a>
    
                                    </div>
                                </template>
                                </vue-good-table>
                                
                        </div>
    
    
    
    
    
                    </div>
    
                    <div class="card-footer">
    
                    </div>
    
                </div>
    
            </div>
    
        </div>
    
       
    
    
        
    
    </div>
</template>

<script>
import 'vue-good-table/dist/vue-good-table.css'
import { VueGoodTable } from 'vue-good-table';


export default {
    mounted() {
        this.getPeoples();

    },
    data() {
        return {
            form: new Form({
                id: '',
                rut: '',
                ncliente: '',
                sector: '',
                nombre: '',
                comuna: ''
            }),
            columns: [{
                    label: 'Rut',
                    field: 'rut',
                },
                {
                    label: 'N° Cliente',
                    field: 'ncliente',
                },
                {
                    label: 'Sector',
                    field: 'sector',
                },
                {
                    label: 'Nombre',
                    field: 'nombre',
                }, {
                    label: 'Comuna',
                    field: 'comuna',
                }
            ],
            rows: [

            ],
        }
    },
    computed:{
        
    },
    components: {
        VueGoodTable,
    },
    methods: {
        filterPeople(row, col, cellValue, searchTerm){
            return row.name.startsWith(searchTerm);
        },
        editPeople(people) {
            $('#editmodal').modal('show')
            this.form.fill(people);
        },

        deletePeople(id) {
            swal.fire({
                title: 'Estas seguro?',
                text: "No podrás revertirlo!",
                type: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Si, eliminar'
            }).then((result) => {
                if (result.value) {
                    this.form.delete('servers/' + id).then(() => {
                        swal.fire("Eliminado!", "", "success");
                        this.getServers();
                    }).catch(() => {
                        swal("WOW!", "Algo ha ocurrido.", "warning");
                    })
                }
            })
        },
        getPeoples() {
            let urlPeoples = "peoples";
            axios.get(urlPeoples).then(response => {
                this.rows = response.data;
            });
        },
        addPeoples() {
            this.form.post('peoples')
                .then(() => {
                    $('#modal').modal('hide');
                    this.getPeoples();

                    Toast.fire({
                        type: 'success',
                        title: 'Creado con exito!'
                    })

                }).catch(() => {
                    swal("WOW!", "Algo ha ocurrido.", "warning");
                })
        },
        reload() {
            this.getPeoples();
            Toast.fire({
                type: 'success',
                title: 'Registros actualizados!'
            })
        },
        clean() {
            this.form.reset();
        },
        updatePeoples() {
            this.form.put('peoples/' + this.form.id)
                .then(() => {
                    $('#editmodal').modal('hide')
                    this.getPeoples();
                    Toast.fire({
                        type: 'success',
                        title: 'Cambio realizado!'
                    })

                }).catch(() => {
                    swal("WOW!", "Algo ha ocurrido.", "warning");
                })
        }
    }
}
</script>