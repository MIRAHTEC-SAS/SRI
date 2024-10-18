<!--  Script Referentiel Metiers  -->
<script>
    const vue = new Vue({
        data: {
            errorMsg: false,
            successMsg: false,
            showAddModal: false,
            showUpdateModal: false,
            showDeleteModal: false,
            urlGetNotesAno: "API/api_cfj.php?action=getNotesAno",
            urlGetSessionsNotees: "API/api_cfj.php?action=getSessionNotees",
            urlGetEpreuvesNotees: "API/api_cfj.php?action=getEpreuvesNotees",

            notesAno: [],
            sessionsNotees:[],
            epreuvesNotees:[],
            numerosTable:[],

            // secteurs:[],
            newDesano: {},
            // currentCorps: {}
        },
        computed: {
            SelectedNotesAno() {
                return this.notesAno.filter(note => note.codeSession === this.newDesano.codeSession && note.epreuve === this.newDesano.epreuve);
            },
            doublonsNumerosTable() {
               return this.SelectedNotesAno.numero_table;
            }
        
        },
        mounted() {
            this.getAllNotesAno();
            this.getAllSessionNotees();
            this.getAllEpreuvesNotees();


        },
        methods: {
            getAllNotesAno() {
                axios.get(this.urlGetNotesAno)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.notesAno = resultat.notesAno;

                        }

                    })
            },
            getAllSessionNotees() {
                axios.get(this.urlGetSessionsNotees)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.sessionsNotees = resultat.sessionsNotees;

                        }

                    })
            },
            getAllEpreuvesNotees() {
                axios.get(this.urlGetEpreuvesNotees)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.epreuvesNotees = resultat.epreuvesNotees;

                        }

                    })
            },

            hideMsg() {
                this.errorMsg = false,
                    this.successMsg = false
            },

            toFormData(obj) {
                var fd = new FormData();
                for (var i in obj) {
                    fd.append(i, obj[i]);
                }

                return fd;
            },
            // Methode pour recuperer le periodes selectionné 
            selectedCorps(sms) {
                this.currentSms = sms;
            }


        }


    }).$mount('#app')
</script>