<!--  Script Referentiel services s  -->
<script>
    const vue = new Vue({
        data: {
            errorMsg: false,
            successMsg: false,
            showAddModal: false,
            showUpdateModal: false,
            showDeleteModal: false,
            urlGetServices: "API/api_dage.php?action=getServices",
            urlGetBatimentsServices: "API/api_dage.php?action=getBatimentsServices",
            urlGetBatiments: "API/api_dage.php?action=getBatiments",
            urlGetEtages: "API/api_dage.php?action=getEtages",
            urlGetTypesLocalisation: "API/api_dage.php?action=typesLocalisation",
            urlGetTypesIncident: "API/api_dage.php?action=typesIncident",

            newSignalement: {},
            services:[],  
            typesLocalisation:[],
            typesIncident:[],
            etages:[],
            batiments:[],  
            batiments_services:[],  
            currentDirection: {},
            resume : {}
        },
        computed: {
            batiments_service() {
                return this.batiments_services.filter(batiment => batiment.code_service === this.newSignalement.code_service);
            },
            etages_batiment() {
                return this.etages.filter(etage => etage.code_service === this.newSignalement.code_service && etage.code_batiment === this.newSignalement.code_batiment);
            },
            selected_service() {
                return this.services.filter(service => service.code_service === this.newSignalement.code_service);
            },
            selected_batiment() {
                return this.batiments.filter(batiment => batiment.code_batiment === this.newSignalement.code_batiment);
            },
            selected_etage() {
                return this.etages.filter(etage => etage.code_service === this.newSignalement.code_service && etage.code_batiment === this.newSignalement.code_batiment && etage.code_etage === this.newSignalement.code_etage);
            },
            selected_type_incident() {
                return this.typesIncident.filter(typeIncident => typeIncident.code_incident === this.newSignalement.code_incident);
            },
            selected_type_localisation() {
                return this.typesLocalisation.filter(typeLocalisation => typeLocalisation.code_localisation === this.newSignalement.code_localisation);
            },
            resume_service_name() {
                return this.resume.nom_service=this.selected_service[0].nom_service;
            }
            
        },
        mounted() {
            this.getAllServices();
            this.getAllBatiments();
            this.getAllBatimentsServices();
            this.getAllEtages();
            this.getAllTypesLocalisation();
            this.getAllTypesIncident();



        },
        methods: {
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
            getAllTypesLocalisation() {
                axios.get(this.urlGetTypesLocalisation)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.typesLocalisation = resultat.typesLocalisation;
                        }

                    })
            },
            getAllTypesIncident() {
                axios.get(this.urlGetTypesIncident)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.typesIncident = resultat.typesIncident;
                        }

                    })
            },
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
            selectedDirection(direction) {
                this.currentService = direction;
            }


        }


    }).$mount('#app')
</script>