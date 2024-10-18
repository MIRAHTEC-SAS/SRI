<!--  Script Referentiel  -->
<script>
    const vue = new Vue({
        data: {
            errorMsg: false,
            successMsg: false,
            showAddModal: false,
            showUpdateModal: false,
            showDeleteModal: false,
            urlGetBatiments: "API/api_sri.php?action=getBatiments",
            urlGetEtages: "API/api_sri.php?action=getEtages",
            urlGetRoles: "API/api_sri.php?action=getRoles",
            urlGetGestionnaires: "API/api_sri.php?action=getGestionnaires",
            urlGetResponsables: "API/api_sri.php?action=getResponsables",
            urlGetIntervenants: "API/api_sri.php?action=getIntervenants",
            batiments: [],
            etages: [],
            roles:[],
            intervenants:[],
            gestionnaires:[],
            responsables:[],
            choixSms: [],
            newBatiment:{},
            newUser:{},
            newEtage:{},
            newPiece:{}
        },
        computed: {
            selectedEtages() {
                return this.etages.filter(etage => etage.code_batiment === this.newPiece.code_batiment);
            }
        },
        mounted() {
            this.getAllIntervenants();
            this.getAllBatiments();
            this.getAllEtages();
            this.getAllRoles();
            this.getAllGestionnaires();
            this.getAllResponsables();

        },
        methods: {
            getAllBatiments() {
                axios.get(this.urlGetBatiments)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.batiments = resultat.batiments;

                        }

                    })
            },
            getAllIntervenants() {
                axios.get(this.urlGetIntervenants)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.intervenants = resultat.intervenants;

                        }

                    })
            },
            getAllEtages() {
                axios.get(this.urlGetEtages)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.etages = resultat.etages;

                        }

                    })
            },
            getAllRoles() {
                axios.get(this.urlGetRoles)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } 
                        else {
                            this.roles = resultat.roles;

                        }

                    })
            },
            getAllGestionnaires() {
                axios.get(this.urlGetGestionnaires)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } 
                        else {
                            this.gestionnaires = resultat.gestionnaires;

                        }

                    })
            },
            getAllResponsables() {
                axios.get(this.urlGetResponsables)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } 
                        else {
                            this.responsables = resultat.responsables;

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
            }


        }


    }).$mount('#app')
</script>