<!--  Script Referentiel Metiers  -->
<script>
    const vue = new Vue({
        data: {
            errorMsg: false,
            successMsg: false,
            showAddModal: false,
            showUpdateModal: false,
            showDeleteModal: false,
            urlGetNotesCandidats: "API/api_cfj.php?action=getNotesCandidats",
            urlGetSessionsNotees: "API/api_cfj.php?action=getSessionNoteesDesano",
            urlGetEpreuvesNotees: "API/api_cfj.php?action=getEpreuvesNoteesDesano",



            notesCandidats: [],
            sessionsNotees:[],
            epreuvesNotees:[],
            numerosTable:[],

            
            // secteurs:[],
            newDesano: {},
            // currentCorps: {}
        },
        computed: {
            SelectedNotesCandidats() {
                return this.notesCandidats.filter(note => note.codeSession === this.newDesano.codeSession && note.epreuve === this.newDesano.epreuve);
            },
            // doublonsNumerosTable() {
            //    return this.SelectednotesCandidats.numero_table;
            // }
        
        },
        mounted() {
            this.getAllNotesCandidats();
            this.getAllSessionNotees();
            this.getAllEpreuvesNotees();


        },
        methods: {
            getAllNotesCandidats() {
                axios.get(this.urlGetNotesCandidats)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.notesCandidats = resultat.notesCandidats;

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