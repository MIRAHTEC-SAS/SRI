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
            urlGetBatimentsServices: "API/api_sri.php?action=getBatimentsServices",
            urlGetServices: "API/api_sri.php?action=getServices",
            urlGetEtages: "API/api_sri.php?action=getEtages",
            urlGetRoles: "API/api_sri.php?action=getRoles",
            urlGetGestionnaires: "API/api_sri.php?action=getGestionnaires",
            urlGetResponsables: "API/api_sri.php?action=getResponsables",
            batiments: [],
            batiments_services: [],
            etages: [],
            services: [],
            roles:[],
            gestionnaires:[],
            responsables:[],
            choixSms:[],
            newBatiment:{},
            newParam:{},
            newUser:{},
            newEtage:{},
            newPiece:{}
        },
        computed: {
            selectedEtages() {
                return this.etages.filter(etage => etage.code_batiment === this.newPiece.code_batiment);
            },
            selectedBatiments() {
                return this.batiments_services.filter(bat=> bat.code_service === this.newParam.code_service);
            },
            selectedEtages() {
                return this.etages.filter(etage => etage.code_batiment === this.newParam.code_batiment);
            }
        },
        mounted() {
            this.getAllBatiments();
            this.getAllBatimentsServices();
            this.getAllServices();
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
            getAllBatimentsServices() {
                axios.get(this.urlGetBatimentsServices)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.batiments_services = resultat.batiments_services;

                        }

                    })
            },
            getAllServices() {
                axios.get(this.urlGetServices)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.services = resultat.services;

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