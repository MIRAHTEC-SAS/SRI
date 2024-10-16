<!--  Script Referentiel Directions s  -->
<script>
    const vue = new Vue({
        data: {
            errorMsg: false,
            successMsg: false,
            showAddModal: false,
            showUpdateModal: false,
            showDeleteModal: false,
            urlGETDirections: "API/api_pgav.php?action=getDirections",
            urlGETAgents: "API/api_pgav.php?action=getAgents",
            urlGETRoles: "API/api_pgav.php?action=getRoles",
            urlGETSecteurs: "API/api_pgav.php?action=getSecteurs",
            urlGETMinisteres: "API/api_pgav.php?action=getMinistere",
            urlGETCorps: "API/api_pgav.php?action=getCorps",
            urlGETBanques: "API/api_pgav.php?action=getBanques",
            urlGETAgences: "API/api_pgav.php?action=getAgences",
            urlGETFonctions: "API/api_pgav.php?action=getFonctions",
            urlGETHierarchies: "API/api_pgav.php?action=getHierarchies",
            urlGETDirectionsGenerales: "API/api_pgav.php?action=getDirectionsGenerales",
            urlpostUser: "API/api_pgav.php?action=postUser",
            urlUPDATE: "API/api_pgav.php?action=updateDirection",
            urlDELETE: "API/api_pgav.php?action=deleteDirection",
            directions: [],
            banques:[],
            agences:[],
            secteurs:[],
            fonctions: [],
            roles:[],
            corps:[],
            hierarchies:[],
            directionsGenerales: [], 
            ministeres: [],
            newUser: {},
            listeAgent: {},
            currentAgent: {}
        },
        computed: {
            directionsGeneralesParMinistere() {
                return this.directionsGenerales.filter(dg => dg.codeMinistere === this.newUser.codeMinistere);
            },
            directionsParDg() {
                return this.directions.filter(direction => direction.codeDirectionGenerale === this.newUser.codeDirectionGenerale);
            },
            corpsParSecteur() {
                return this.corps.filter(metier => metier.codeSecteur === this.newUser.codeSecteur);
            },
            agencesParBanque() {
                return this.agences.filter(agence => agence.codeBanque === this.newUser.codeBanque);
            },
            listeDirectionsParDg() {
                return this.directions.filter(direction => direction.codeDirectionGenerale === this.listeAgent.codeDirectionGenerale);
            },
            
        },
        mounted() {
            this.getAllAgents();
            this.getAllRoles();
            this.getAllDirections();
            this.getAllMinisteres();
            this.getAllDirectionsGenerales();
            this.getAllAgences();
            this.getAllBanques();
            this.getAllCorps();
            this.getAllSecteurs();
            this.getAllHierarchies();
            this.getAllFonctions();

        },
        methods: {
            getAllAgents() {
                axios.get(this.urlGETAgents)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.agents = resultat.agents;

                        }

                    })
            },
            getAllRoles() {
                axios.get(this.urlGETRoles)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.roles = resultat.roles;

                        }

                    })
            },
           
           
            getAllDirections() {
                axios.get(this.urlGETDirections)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.directions = resultat.directions;

                        }

                    })
            },
            getAllDirectionsGenerales() {
                axios.get(this.urlGETDirectionsGenerales)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.directionsGenerales = resultat.directionsGenerales;

                        }

                    })
            },
            getAllFonctions() {
                axios.get(this.urlGETFonctions)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.fonctions = resultat.fonctions;

                        }

                    })
            },
            getAllMinisteres() {
                axios.get(this.urlGETMinisteres)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.ministeres = resultat.ministeres;

                        }

                    })
            },
            getAllAgences() {
                axios.get(this.urlGETAgences)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.agences = resultat.agences;

                        }

                    })
            },
            getAllBanques() {
                axios.get(this.urlGETBanques)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.banques = resultat.banques;

                        }

                    })
            },

            getAllCorps() {
                axios.get(this.urlGETCorps)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.corps = resultat.corps;

                        }

                    })
            },
            getAllSecteurs() {
                axios.get(this.urlGETSecteurs)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.secteurs = resultat.secteurs;

                        }

                    })
            },

            getAllHierarchies() {
                axios.get(this.urlGETHierarchies)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        if (resultat.error) {
                            this.errorMsg = resultat.error
                        } else {
                            this.hierarchies = resultat.hierarchies;

                        }

                    })
            },
          
            addAUser() {

                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.newUser);

                //On lance la requete GET (Create)
                axios.post(this.urlpostUser, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.newUser = {
                        }
                        if (resultat.error) {
                            this.errorMsg = resultat.error;
                        } else {
                            this.hideMsg();
                            this.successMsg = resultat.message;
                            // this.getAllDirections();
                            location.reload();
                           
                        }
                    })


            },
            updateDirection() {
                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.currentDirection);

                //On lance la requete GET (Create)
                axios.post(this.urlUPDATE, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.currentDirection = {};
                        if (resultat.error) {
                            this.errorMsg = resultat.error;
                        } else {
                            this.successMsg = resultat.message;
                            this.getAllDirections();
                        }
                    })


            },

            deleteDirection() {
                // On prepare le form pour insertion les champs dans le variable global POST
                var formData = this.toFormData(this.currentDirection);

                //On lance la requete GET (Create)
                axios.post(this.urlDELETE, formData)
                    .then((resultat) => resultat.data)
                    .then((resultat) => {
                        this.currentDirection = {};
                        if (resultat.error) {
                            this.errorMsg = resultat.message
                        } else {
                            this.successMsg = resultat.message;
                            this.getAllDirections();
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
                this.currentDirection = direction;
            }


        }


    }).$mount('#app')
</script>